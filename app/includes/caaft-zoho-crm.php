<?php
declare(strict_types=1);

if (!function_exists('caaft_zoho_config')) {
    function caaft_zoho_config(): array
    {
        static $config = null;
        if ($config !== null) {
            return $config;
        }

        $configDir = (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__)) . '/config';
        $config = is_file($configDir . '/zoho.php') ? require $configDir . '/zoho.php' : [];
        if (!is_array($config)) {
            $config = [];
        }

        if (is_file($configDir . '/zoho.local.php')) {
            $local = require $configDir . '/zoho.local.php';
            if (is_array($local)) {
                $config = array_merge($config, $local);
            }
        }

        return $config;
    }
}

if (!function_exists('caaft_zoho_is_configured')) {
    function caaft_zoho_is_configured(): bool
    {
        $config = caaft_zoho_config();

        return trim((string) ($config['client_id'] ?? '')) !== ''
            && trim((string) ($config['client_secret'] ?? '')) !== ''
            && trim((string) ($config['refresh_token'] ?? '')) !== '';
    }
}

if (!function_exists('caaft_zoho_storage_dir')) {
    function caaft_zoho_storage_dir(): string
    {
        $dir = (defined('PROJECT_ROOT') ? PROJECT_ROOT : dirname(__DIR__, 2)) . '/storage';
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        return $dir;
    }
}

if (!function_exists('caaft_zoho_token_cache_path')) {
    function caaft_zoho_token_cache_path(): string
    {
        return caaft_zoho_storage_dir() . '/zoho-token.json';
    }
}

if (!function_exists('caaft_zoho_http_post')) {
    /**
     * @param array<string, string> $fields
     */
    function caaft_zoho_http_post(string $url, array $fields, array $headers = []): ?array
    {
        $body = http_build_query($fields);

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTPHEADER => array_merge(['Content-Type: application/x-www-form-urlencoded'], $headers),
            ]);
            $response = curl_exec($ch);
            $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($response === false || $httpCode >= 500) {
                return null;
            }

            $decoded = json_decode((string) $response, true);

            return is_array($decoded) ? $decoded : null;
        }

        $headerLines = "Content-Type: application/x-www-form-urlencoded\r\n";
        foreach ($headers as $header) {
            $headerLines .= $header . "\r\n";
        }

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => $headerLines,
                'content' => $body,
                'timeout' => 30,
                'ignore_errors' => true,
            ],
        ]);

        $response = @file_get_contents($url, false, $context);
        if ($response === false) {
            return null;
        }

        $decoded = json_decode($response, true);

        return is_array($decoded) ? $decoded : null;
    }
}

if (!function_exists('caaft_zoho_http_json')) {
    /**
     * @param array<string, mixed> $payload
     */
    function caaft_zoho_http_json(string $method, string $url, array $payload, string $accessToken): ?array
    {
        $json = json_encode($payload, JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            return null;
        }

        $headers = [
            'Authorization: Zoho-oauthtoken ' . $accessToken,
            'Content-Type: application/json',
        ];

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_CUSTOMREQUEST => strtoupper($method),
                CURLOPT_POSTFIELDS => $json,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTPHEADER => $headers,
            ]);
            $response = curl_exec($ch);
            $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($response === false) {
                return null;
            }

            $decoded = json_decode((string) $response, true);
            if (!is_array($decoded)) {
                return null;
            }

            $decoded['_http_code'] = $httpCode;

            return $decoded;
        }

        $context = stream_context_create([
            'http' => [
                'method' => strtoupper($method),
                'header' => implode("\r\n", $headers) . "\r\n",
                'content' => $json,
                'timeout' => 30,
                'ignore_errors' => true,
            ],
        ]);

        $response = @file_get_contents($url, false, $context);
        if ($response === false) {
            return null;
        }

        $decoded = json_decode($response, true);

        return is_array($decoded) ? $decoded : null;
    }
}

if (!function_exists('caaft_zoho_read_token_cache')) {
    function caaft_zoho_read_token_cache(): ?array
    {
        $path = caaft_zoho_token_cache_path();
        if (!is_file($path)) {
            return null;
        }

        $raw = @file_get_contents($path);
        if ($raw === false) {
            return null;
        }

        $data = json_decode($raw, true);

        return is_array($data) ? $data : null;
    }
}

if (!function_exists('caaft_zoho_write_token_cache')) {
    /**
     * @param array<string, mixed> $data
     */
    function caaft_zoho_write_token_cache(array $data): void
    {
        $path = caaft_zoho_token_cache_path();
        @file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);
    }
}

if (!function_exists('caaft_zoho_refresh_access_token')) {
    function caaft_zoho_refresh_access_token(bool $force = false): ?string
    {
        if (!caaft_zoho_is_configured()) {
            return null;
        }

        $cache = caaft_zoho_read_token_cache();
        if (!$force && is_array($cache)) {
            $expiresAt = (int) ($cache['expires_at'] ?? 0);
            $token = trim((string) ($cache['access_token'] ?? ''));
            if ($token !== '' && $expiresAt > time() + 60) {
                return $token;
            }
        }

        $config = caaft_zoho_config();
        $accountsDomain = trim((string) ($config['accounts_domain'] ?? 'accounts.zoho.in'));
        $url = 'https://' . $accountsDomain . '/oauth/v2/token';

        $response = caaft_zoho_http_post($url, [
            'refresh_token' => (string) $config['refresh_token'],
            'client_id' => (string) $config['client_id'],
            'client_secret' => (string) $config['client_secret'],
            'grant_type' => 'refresh_token',
        ]);

        if (!is_array($response) || empty($response['access_token'])) {
            return null;
        }

        $accessToken = (string) $response['access_token'];
        $expiresIn = (int) ($response['expires_in'] ?? 3600);
        caaft_zoho_write_token_cache([
            'access_token' => $accessToken,
            'expires_at' => time() + max(300, $expiresIn - 120),
        ]);

        return $accessToken;
    }
}

if (!function_exists('caaft_zoho_split_name')) {
    /**
     * @return array{first: string, last: string}
     */
    function caaft_zoho_split_name(string $fullName): array
    {
        $fullName = trim(preg_replace('/\s+/u', ' ', $fullName) ?? $fullName);
        if ($fullName === '') {
            return ['first' => '', 'last' => 'Website Lead'];
        }

        $parts = preg_split('/\s+/u', $fullName, 2);
        if (!is_array($parts) || count($parts) === 1) {
            return ['first' => '', 'last' => $fullName];
        }

        return [
            'first' => trim((string) $parts[0]),
            'last' => trim((string) $parts[1]) !== '' ? trim((string) $parts[1]) : $fullName,
        ];
    }
}

if (!function_exists('caaft_zoho_build_lead_record')) {
    /**
     * @param array<string, string> $lead
     * @return array<string, string>
     */
    function caaft_zoho_build_lead_record(array $lead): array
    {
        $config = caaft_zoho_config();
        $nameParts = caaft_zoho_split_name((string) ($lead['name'] ?? ''));

        $descriptionLines = [];
        if (($lead['message'] ?? '') !== '') {
            $descriptionLines[] = 'Message: ' . (string) $lead['message'];
        }
        if (($lead['enquiry_category'] ?? '') !== '') {
            $descriptionLines[] = 'Category: ' . (string) $lead['enquiry_category'];
        }
        if (($lead['title'] ?? '') !== '') {
            $descriptionLines[] = 'Form: ' . (string) $lead['title'];
        }
        if (($lead['form_type'] ?? '') !== '') {
            $descriptionLines[] = 'Form type: ' . (string) $lead['form_type'];
        }
        if (($lead['page_url'] ?? '') !== '' && ($lead['page_url'] ?? '') !== 'Unknown') {
            $descriptionLines[] = 'Page URL: ' . (string) $lead['page_url'];
        }
        if (($lead['about'] ?? '') !== '') {
            $descriptionLines[] = 'How did you hear about us: ' . (string) $lead['about'];
        }

        $record = [
            'Last_Name' => $nameParts['last'],
            'Email' => (string) ($lead['email'] ?? ''),
            'Phone' => (string) ($lead['phone'] ?? ''),
            'Lead_Source' => (string) ($config['lead_source'] ?? 'Website'),
            'Description' => implode("\n", $descriptionLines),
        ];

        if ($nameParts['first'] !== '') {
            $record['First_Name'] = $nameParts['first'];
        }
        $service = trim((string) ($lead['service'] ?? ''));
        if ($service !== '') {
            $serviceField = trim((string) ($config['service_field'] ?? 'Required_Service'));
            if ($serviceField !== '') {
                $record[$serviceField] = $service;
            }
        }

        return array_filter($record, static fn ($value) => $value !== '');
    }
}

if (!function_exists('caaft_zoho_push_lead')) {
    /**
     * @param array<string, string> $lead
     */
    function caaft_zoho_push_lead(array $lead): bool
    {
        if (!caaft_zoho_is_configured()) {
            return false;
        }

        $accessToken = caaft_zoho_refresh_access_token();
        if ($accessToken === null) {
            return false;
        }

        $config = caaft_zoho_config();
        $apiDomain = trim((string) ($config['api_domain'] ?? 'www.zohoapis.in'));
        $module = trim((string) ($config['lead_module'] ?? 'Leads'));
        $url = 'https://' . $apiDomain . '/crm/v2/' . rawurlencode($module);

        $record = caaft_zoho_build_lead_record($lead);
        $response = caaft_zoho_http_json('POST', $url, ['data' => [$record]], $accessToken);

        if (is_array($response) && !empty($response['data'][0]['details']['id'])) {
            return true;
        }

        // Retry once if token expired.
        if (is_array($response) && (int) ($response['_http_code'] ?? 0) === 401) {
            $accessToken = caaft_zoho_refresh_access_token(true);
            if ($accessToken === null) {
                return false;
            }

            $response = caaft_zoho_http_json('POST', $url, ['data' => [$record]], $accessToken);

            return is_array($response) && !empty($response['data'][0]['details']['id']);
        }

        return false;
    }
}
