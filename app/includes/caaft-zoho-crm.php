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
            if (!is_array($decoded)) {
                return ['_http_code' => $httpCode, 'error' => 'invalid_response', 'message' => trim((string) $response)];
            }

            $decoded['_http_code'] = $httpCode;

            return $decoded;
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

if (!function_exists('caaft_zoho_log')) {
    function caaft_zoho_log(string $message): void
    {
        $path = caaft_zoho_storage_dir() . '/zoho.log';
        @file_put_contents($path, gmdate('c') . ' ' . $message . "\n", FILE_APPEND | LOCK_EX);
    }
}

if (!function_exists('caaft_zoho_response_error')) {
    /**
     * @param array<string, mixed>|null $response
     */
    function caaft_zoho_response_error(?array $response): string
    {
        if (!is_array($response)) {
            return 'empty response (check PHP curl extension and outbound HTTPS)';
        }

        if (!empty($response['error'])) {
            $error = (string) $response['error'];
            if (!empty($response['error_description'])) {
                $error .= ': ' . (string) $response['error_description'];
            }

            return $error;
        }

        if (!empty($response['message'])) {
            return (string) $response['message'];
        }

        $row = $response['data'][0] ?? null;
        if (is_array($row)) {
            $parts = array_filter([
                isset($row['code']) ? (string) $row['code'] : '',
                isset($row['message']) ? (string) $row['message'] : '',
                isset($row['details']['api_name']) ? 'field=' . (string) $row['details']['api_name'] : '',
            ]);

            if ($parts !== []) {
                return implode(' | ', $parts);
            }
        }

        $httpCode = (int) ($response['_http_code'] ?? 0);

        return $httpCode > 0 ? 'HTTP ' . $httpCode : 'unknown error';
    }
}

if (!function_exists('caaft_zoho_lead_created')) {
    /**
     * @param array<string, mixed>|null $response
     */
    function caaft_zoho_lead_created(?array $response): bool
    {
        if (!is_array($response)) {
            return false;
        }

        $row = $response['data'][0] ?? null;
        if (!is_array($row)) {
            return false;
        }

        if (($row['status'] ?? '') === 'error') {
            return false;
        }

        return !empty($row['details']['id']);
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
            caaft_zoho_log('Token refresh failed: ' . caaft_zoho_response_error($response));

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

        return is_array($decoded) ? $decoded : null;
    }
}

if (!function_exists('caaft_zoho_http_get')) {
    function caaft_zoho_http_get(string $url, string $accessToken): ?array
    {
        $headers = [
            'Authorization: Zoho-oauthtoken ' . $accessToken,
        ];

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
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
                'method' => 'GET',
                'header' => implode("\r\n", $headers) . "\r\n",
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

if (!function_exists('caaft_zoho_owner_cache_path')) {
    function caaft_zoho_owner_cache_path(): string
    {
        return caaft_zoho_storage_dir() . '/zoho-owner-cache.json';
    }
}

if (!function_exists('caaft_zoho_find_user_id_by_name')) {
    function caaft_zoho_find_user_id_by_name(string $name, string $accessToken): string
    {
        $name = trim($name);
        if ($name === '') {
            return '';
        }

        $cachePath = caaft_zoho_owner_cache_path();
        if (is_file($cachePath)) {
            $cache = json_decode((string) file_get_contents($cachePath), true);
            if (is_array($cache) && !empty($cache[$name])) {
                return (string) $cache[$name];
            }
        }

        $config = caaft_zoho_config();
        $apiDomain = trim((string) ($config['api_domain'] ?? 'www.zohoapis.in'));
        $url = 'https://' . $apiDomain . '/crm/v2/users?type=ActiveUsers';
        $response = caaft_zoho_http_get($url, $accessToken);
        $users = is_array($response) ? ($response['users'] ?? []) : [];

        if (!is_array($users)) {
            caaft_zoho_log('Lead owner lookup failed: ' . caaft_zoho_response_error($response));

            return '';
        }

        $target = strtolower($name);
        foreach ($users as $user) {
            if (!is_array($user) || empty($user['id'])) {
                continue;
            }

            $fullName = strtolower(trim((string) ($user['full_name'] ?? '')));
            $firstLast = strtolower(trim((string) ($user['first_name'] ?? '') . ' ' . (string) ($user['last_name'] ?? '')));
            if ($fullName === $target || trim($firstLast) === $target) {
                $id = (string) $user['id'];
                $cache = is_file($cachePath) ? json_decode((string) file_get_contents($cachePath), true) : [];
                if (!is_array($cache)) {
                    $cache = [];
                }
                $cache[$name] = $id;
                @file_put_contents($cachePath, json_encode($cache, JSON_PRETTY_PRINT), LOCK_EX);

                return $id;
            }
        }

        caaft_zoho_log('Lead owner not found in Zoho users: ' . $name);

        return '';
    }
}

if (!function_exists('caaft_zoho_lead_owner_payload')) {
    /**
     * @return array<string, string>|null
     */
    function caaft_zoho_lead_owner_payload(?string $accessToken = null): ?array
    {
        $config = caaft_zoho_config();
        $ownerId = trim((string) ($config['lead_owner_id'] ?? ''));
        if ($ownerId !== '') {
            return ['id' => $ownerId];
        }

        $ownerEmail = trim(str_replace(["\r", "\n"], '', (string) ($config['lead_owner_email'] ?? '')));
        $ownerEmail = filter_var($ownerEmail, FILTER_VALIDATE_EMAIL);
        if (is_string($ownerEmail)) {
            return ['email' => $ownerEmail];
        }

        $ownerName = trim((string) ($config['lead_owner_name'] ?? ''));
        if ($ownerName !== '' && $accessToken !== null && $accessToken !== '') {
            $resolvedId = caaft_zoho_find_user_id_by_name($ownerName, $accessToken);
            if ($resolvedId !== '') {
                return ['id' => $resolvedId];
            }
        }

        return null;
    }
}

if (!function_exists('caaft_zoho_apply_lead_owner')) {
    /**
     * @param array<string, mixed> $record
     */
    function caaft_zoho_apply_lead_owner(array &$record, string $accessToken): void
    {
        $owner = caaft_zoho_lead_owner_payload($accessToken);
        if ($owner !== null) {
            $record['Owner'] = $owner;
        }
    }
}

if (!function_exists('caaft_zoho_build_lead_record')) {
    /**
     * @param array<string, string> $lead
     * @return array<string, mixed>
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
        $company = trim((string) ($lead['company'] ?? ''));
        if ($company !== '') {
            $record['Company'] = $company;
        }

        return array_filter($record, static function ($value): bool {
            if (is_array($value)) {
                return $value !== [];
            }

            return $value !== '';
        });
    }
}

if (!function_exists('caaft_zoho_create_lead')) {
    /**
     * @param array<string, mixed> $record
     */
    function caaft_zoho_create_lead(array $record, string $accessToken): ?array
    {
        $config = caaft_zoho_config();
        $apiDomain = trim((string) ($config['api_domain'] ?? 'www.zohoapis.in'));
        $module = trim((string) ($config['lead_module'] ?? 'Leads'));
        $url = 'https://' . $apiDomain . '/crm/v2/' . rawurlencode($module);

        return caaft_zoho_http_json('POST', $url, ['data' => [$record]], $accessToken);
    }
}

if (!function_exists('caaft_zoho_push_lead')) {
    /**
     * @param array<string, string> $lead
     */
    function caaft_zoho_push_lead(array $lead): bool
    {
        if (!caaft_zoho_is_configured()) {
            caaft_zoho_log('Push skipped: missing client_id, client_secret, or refresh_token in zoho.local.php');

            return false;
        }

        $accessToken = caaft_zoho_refresh_access_token();
        if ($accessToken === null) {
            return false;
        }

        $config = caaft_zoho_config();
        $record = caaft_zoho_build_lead_record($lead);
        caaft_zoho_apply_lead_owner($record, $accessToken);
        $response = caaft_zoho_create_lead($record, $accessToken);

        if (caaft_zoho_lead_created($response)) {
            return true;
        }

        if (is_array($response) && (int) ($response['_http_code'] ?? 0) === 401) {
            $accessToken = caaft_zoho_refresh_access_token(true);
            if ($accessToken === null) {
                caaft_zoho_log('Lead create failed after 401: could not refresh access token');

                return false;
            }

            $response = caaft_zoho_create_lead($record, $accessToken);
            if (caaft_zoho_lead_created($response)) {
                return true;
            }
        }

        $serviceField = trim((string) ($config['service_field'] ?? 'Required_Service'));
        if ($serviceField !== '' && isset($record[$serviceField])) {
            $serviceValue = (string) $record[$serviceField];
            unset($record[$serviceField]);
            $prefix = 'Required Service: ' . $serviceValue;
            $record['Description'] = ($record['Description'] ?? '') !== ''
                ? $prefix . "\n" . (string) $record['Description']
                : $prefix;

            caaft_zoho_apply_lead_owner($record, $accessToken);
            $response = caaft_zoho_create_lead($record, $accessToken);
            if (caaft_zoho_lead_created($response)) {
                caaft_zoho_log('Lead created after retry without ' . $serviceField . ' (value moved to Description)');

                return true;
            }
        }

        caaft_zoho_log(
            'Lead create failed for '
            . ($lead['email'] ?? 'unknown')
            . ': '
            . caaft_zoho_response_error($response),
        );

        return false;
    }
}

if (!function_exists('caaft_zoho_authorization_url')) {
    function caaft_zoho_authorization_url(): string
    {
        $config = caaft_zoho_config();
        $accountsDomain = trim((string) ($config['accounts_domain'] ?? 'accounts.zoho.in'));
        $redirectUri = trim((string) ($config['redirect_uri'] ?? ''));
        if ($redirectUri === '') {
            return '';
        }

        $params = [
            'scope' => (string) ($config['oauth_scopes'] ?? 'ZohoCRM.modules.leads.CREATE'),
            'client_id' => (string) ($config['client_id'] ?? ''),
            'response_type' => 'code',
            'access_type' => 'offline',
            'prompt' => 'consent',
            'redirect_uri' => $redirectUri,
        ];

        return 'https://' . $accountsDomain . '/oauth/v2/auth?' . http_build_query($params);
    }
}

if (!function_exists('caaft_zoho_exchange_code')) {
    /**
     * Exchange authorization code (browser OAuth or Self Client grant code).
     *
     * @return array<string, mixed>|null
     */
    function caaft_zoho_exchange_code(string $code, bool $useRedirectUri = true): ?array
    {
        $config = caaft_zoho_config();
        $clientId = trim((string) ($config['client_id'] ?? ''));
        $clientSecret = trim((string) ($config['client_secret'] ?? ''));
        if ($clientId === '' || $clientSecret === '' || trim($code) === '') {
            return null;
        }

        $accountsDomain = trim((string) ($config['accounts_domain'] ?? 'accounts.zoho.in'));
        $fields = [
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'code' => trim($code),
        ];

        $redirectUri = trim((string) ($config['redirect_uri'] ?? ''));
        if ($useRedirectUri && $redirectUri !== '') {
            $fields['redirect_uri'] = $redirectUri;
        }

        return caaft_zoho_http_post('https://' . $accountsDomain . '/oauth/v2/token', $fields);
    }
}

if (!function_exists('caaft_zoho_save_refresh_token')) {
    function caaft_zoho_save_refresh_token(string $refreshToken, ?array $tokens = null): bool
    {
        $localPath = (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__)) . '/config/zoho.local.php';
        $local = is_file($localPath) ? require $localPath : [];
        if (!is_array($local)) {
            $local = [];
        }

        $local['refresh_token'] = $refreshToken;
        $written = file_put_contents(
            $localPath,
            "<?php\ndeclare(strict_types=1);\n\nreturn " . var_export($local, true) . ";\n",
        );

        if ($written === false) {
            return false;
        }

        if (is_array($tokens) && !empty($tokens['access_token'])) {
            caaft_zoho_write_token_cache([
                'access_token' => (string) $tokens['access_token'],
                'expires_at' => time() + max(300, (int) ($tokens['expires_in'] ?? 3600) - 120),
            ]);
        }

        return true;
    }
}
