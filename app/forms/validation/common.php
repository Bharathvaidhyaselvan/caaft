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
