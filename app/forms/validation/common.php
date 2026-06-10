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

if (!function_exists('caaft_form_cc_header')) {
    function caaft_form_cc_header(): string
    {
        $configPath = (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__, 2)) . '/config/mail.php';
        $config = is_file($configPath) ? require $configPath : [];
        $cc = $config['form_cc'] ?? [];

        $emails = array_values(array_filter(array_map(static function ($email) {
            $valid = filter_var(trim((string) $email), FILTER_VALIDATE_EMAIL);

            return is_string($valid) ? $valid : null;
        }, is_array($cc) ? $cc : [$cc])));

        return $emails !== [] ? 'Cc: ' . implode(', ', $emails) . "\r\n" : '';
    }
}

if (!function_exists('caaft_form_cc_header')) {
    function caaft_form_cc_header(): string
    {
        $configPath = (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__, 2)) . '/config/mail.php';
        $config = is_file($configPath) ? require $configPath : [];
        $cc = $config['form_cc'] ?? [];

        $emails = array_values(array_filter(array_map(static function ($email) {
            $valid = filter_var(trim((string) $email), FILTER_VALIDATE_EMAIL);

            return is_string($valid) ? $valid : null;
        }, is_array($cc) ? $cc : [$cc])));

        return $emails !== [] ? 'Cc: ' . implode(', ', $emails) . "\r\n" : '';
    }
}
