<?php
declare(strict_types=1);

if (!function_exists('require_post_request')) {
    function require_post_request(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            exit('Invalid request method.');
        }
    }
}

if (!function_exists('post_clean')) {
    function post_clean(string $key, string $default = ''): string
    {
        $value = $_POST[$key] ?? $default;
        return htmlspecialchars(trim((string) $value), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('has_honeypot_value')) {
    function has_honeypot_value(array $keys): bool
    {
        foreach ($keys as $key) {
            if (!empty($_POST[$key])) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('caaft_form_recipient_email')) {
    function caaft_form_recipient_email(): string
    {
        static $recipient = null;
        if ($recipient !== null) {
            return $recipient;
        }

        $configPath = (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__, 2)) . '/config/mail.php';
        $config = is_file($configPath) ? require $configPath : [];
        $recipient = filter_var(
            (string) ($config['form_recipient'] ?? 'services@caaft.com'),
            FILTER_VALIDATE_EMAIL,
        );

        return is_string($recipient) ? $recipient : 'services@caaft.com';
    }
}

if (!function_exists('caaft_form_sanitize_source_url')) {
    function caaft_form_sanitize_source_url(string $url): string
    {
        $url = trim($url);
        if ($url === '') {
            return '';
        }

        if (preg_match('~/(?:contact_mail|homecontact_mail|[a-z0-9-]+-mail)\.php(?:\?|$)~i', $url)) {
            return '';
        }

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }

        if ($url[0] === '/') {
            $host = trim((string) ($_SERVER['HTTP_HOST'] ?? ''));
            if ($host === '') {
                return '';
            }
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

            return $scheme . '://' . $host . $url;
        }

        return '';
    }
}

if (!function_exists('caaft_form_source_url')) {
    function caaft_form_source_url(): string
    {
        $candidates = [
            $_POST['page_url'] ?? '',
            $_POST['site_url'] ?? '',
            $_GET['page_url'] ?? '',
            $_SERVER['HTTP_REFERER'] ?? '',
        ];

        foreach ($candidates as $candidate) {
            $normalized = caaft_form_sanitize_source_url((string) $candidate);
            if ($normalized !== '') {
                return $normalized;
            }
        }

        return 'Unknown';
    }
}

if (!function_exists('caaft_form_source_url_html')) {
    function caaft_form_source_url_html(): string
    {
        $url = caaft_form_source_url();
        if ($url === 'Unknown') {
            return '<p><strong>Site URL:</strong> Unknown</p>';
        }

        $safe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

        return '<p><strong>Site URL:</strong> <a href="' . $safe . '">' . $safe . '</a></p>';
    }
}

if (!function_exists('caaft_mail_config')) {
    function caaft_mail_config(): array
    {
        static $config = null;
        if ($config !== null) {
            return $config;
        }

        $configPath = (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__, 2)) . '/config/mail.php';
        $config = is_file($configPath) ? require $configPath : [];

        return is_array($config) ? $config : [];
    }
}

if (!function_exists('caaft_form_sender_email')) {
    function caaft_form_sender_email(): string
    {
        $configured = filter_var(
            (string) (caaft_mail_config()['form_sender'] ?? ''),
            FILTER_VALIDATE_EMAIL,
        );

        return is_string($configured) ? $configured : caaft_form_recipient_email();
    }
}

if (!function_exists('caaft_encode_mail_header_value')) {
    function caaft_encode_mail_header_value(string $value): string
    {
        $value = trim(str_replace(["\r", "\n"], '', $value));
        if ($value === '') {
            return '';
        }

        if (function_exists('mb_encode_mimeheader')) {
            return mb_encode_mimeheader($value, 'UTF-8', 'B', "\r\n");
        }

        return $value;
    }
}

if (!function_exists('caaft_format_mail_address')) {
    function caaft_format_mail_address(string $email, string $name = ''): string
    {
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        if (!is_string($email)) {
            return '';
        }

        $name = caaft_encode_mail_header_value($name);

        return $name !== '' ? $name . ' <' . $email . '>' : $email;
    }
}

if (!function_exists('caaft_send_form_mail')) {
    function caaft_send_form_mail(
        string $to,
        string $subject,
        string $htmlBody,
        string $replyToEmail,
        string $replyToName = '',
    ): bool {
        $to = filter_var(trim($to), FILTER_VALIDATE_EMAIL);
        if (!is_string($to)) {
            return false;
        }

        $fromEmail = caaft_form_sender_email();
        $fromName = trim((string) (caaft_mail_config()['form_sender_name'] ?? 'CAAFT Website'));
        $fromHeader = caaft_format_mail_address($fromEmail, $fromName);
        $replyHeader = caaft_format_mail_address($replyToEmail, $replyToName);

        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $fromHeader,
        ];
        if ($replyHeader !== '') {
            $headers[] = 'Reply-To: ' . $replyHeader;
        }

        $encodedSubject = caaft_encode_mail_header_value($subject);
        $additionalParams = '-f' . $fromEmail;

        return mail($to, $encodedSubject, $htmlBody, implode("\r\n", $headers), $additionalParams);
    }
}

if (!function_exists('caaft_verify_recaptcha')) {
    function caaft_verify_recaptcha(string $responseKey, string $secret): bool
    {
        $responseKey = trim($responseKey);
        if ($responseKey === '' || $secret === '') {
            return false;
        }

        $payload = http_build_query([
            'secret' => $secret,
            'response' => $responseKey,
            'remoteip' => (string) ($_SERVER['REMOTE_ADDR'] ?? ''),
        ]);

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $payload,
                'timeout' => 10,
            ],
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true,
            ],
        ]);

        $verify = @file_get_contents(
            'https://www.google.com/recaptcha/api/siteverify',
            false,
            $context,
        );
        if ($verify === false) {
            return false;
        }

        $captcha = json_decode($verify);

        return !empty($captcha) && !empty($captcha->success);
    }
}
