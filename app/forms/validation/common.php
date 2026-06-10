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
