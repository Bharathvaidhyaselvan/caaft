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

if (!function_exists('caaft_mail_config')) {
    function caaft_mail_config(): array
    {
        static $config = null;
        if ($config !== null) {
            return $config;
        }

        $configDir = (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__, 2)) . '/config';
        $config = is_file($configDir . '/mail.php') ? require $configDir . '/mail.php' : [];
        if (!is_array($config)) {
            $config = [];
        }

        if (is_file($configDir . '/mail.local.php')) {
            $local = require $configDir . '/mail.local.php';
            if (is_array($local)) {
                $config = array_merge($config, $local);
            }
        }

        return $config;
    }
}

if (!function_exists('caaft_form_recipient_email')) {
    function caaft_form_recipient_email(): string
    {
        $configured = filter_var(
            (string) (caaft_mail_config()['form_recipient'] ?? 'services@caaft.com'),
            FILTER_VALIDATE_EMAIL,
        );

        return is_string($configured) ? $configured : 'services@caaft.com';
    }
}

if (!function_exists('caaft_form_cc_emails')) {
    function caaft_form_cc_emails(): array
    {
        $cc = caaft_mail_config()['form_cc'] ?? [];

        return array_values(array_filter(array_map(static function ($email) {
            $valid = filter_var(trim((string) $email), FILTER_VALIDATE_EMAIL);

            return is_string($valid) ? $valid : null;
        }, is_array($cc) ? $cc : [$cc])));
    }
}

if (!function_exists('caaft_form_cc_header')) {
    function caaft_form_cc_header(): string
    {
        $emails = caaft_form_cc_emails();

        return $emails !== [] ? 'Cc: ' . implode(', ', $emails) . "\r\n" : '';
    }
}

if (!function_exists('caaft_sanitize_mail_address')) {
    function caaft_sanitize_mail_address(string $email): string
    {
        $email = str_replace(["\r", "\n"], '', trim($email));
        $valid = filter_var($email, FILTER_VALIDATE_EMAIL);

        return is_string($valid) ? $valid : '';
    }
}

if (!function_exists('caaft_sanitize_mail_name')) {
    function caaft_sanitize_mail_name(string $name): string
    {
        return trim(str_replace(["\r", "\n"], '', $name));
    }
}

if (!function_exists('caaft_try_send_mail')) {
    /**
     * Prefer Microsoft 365 SMTP when configured; otherwise fall back to Hostinger PHP mail().
     */
    function caaft_try_send_mail(
        string $to,
        string $subject,
        string $htmlBody,
        string $fromName,
        string $fromEmail,
    ): bool {
        $to = caaft_sanitize_mail_address($to);
        $fromEmail = caaft_sanitize_mail_address($fromEmail);
        if ($to === '' || $fromEmail === '') {
            return false;
        }

        $fromName = caaft_sanitize_mail_name($fromName);

        if (!function_exists('caaft_smtp_is_configured')) {
            require_once (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__, 2)) . '/includes/caaft-smtp-mail.php';
        }

        if (caaft_smtp_is_configured()) {
            return caaft_smtp_send_mail(
                $to,
                $subject,
                $htmlBody,
                $fromEmail,
                $fromName,
                caaft_form_cc_emails(),
            );
        }
        $ccHeader = caaft_form_cc_header();
        $contentHeaders = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";

        // Try without CC first — Hostinger often rejects Cc to external Gmail.
        $headerSets = [
            "From: {$fromName} <{$fromEmail}>\r\nReply-To: {$fromEmail}\r\n{$contentHeaders}",
            "From: {$fromEmail}\r\nReply-To: {$fromEmail}\r\n{$contentHeaders}",
            "From: {$fromName} <{$fromEmail}>\r\nReply-To: {$fromEmail}\r\n{$ccHeader}{$contentHeaders}",
            "From: {$fromEmail}\r\nReply-To: {$fromEmail}\r\n{$ccHeader}{$contentHeaders}",
        ];

        foreach ($headerSets as $headers) {
            if (@mail($to, $subject, $htmlBody, $headers)) {
                caaft_send_cc_copy_if_needed($to, $subject, $htmlBody, $fromName, $fromEmail, $headers);

                return true;
            }

            if (@mail($to, $subject, $htmlBody, $headers, '-f' . $fromEmail)) {
                caaft_send_cc_copy_if_needed($to, $subject, $htmlBody, $fromName, $fromEmail, $headers);

                return true;
            }
        }

        return false;
    }
}

if (!function_exists('caaft_send_cc_copy_if_needed')) {
    function caaft_send_cc_copy_if_needed(
        string $primaryTo,
        string $subject,
        string $htmlBody,
        string $fromName,
        string $fromEmail,
        string $usedHeaders,
    ): void {
        if (str_contains($usedHeaders, "Cc:")) {
            return;
        }

        $contentHeaders = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";

        foreach (caaft_form_cc_emails() as $ccEmail) {
            if (strcasecmp($ccEmail, $primaryTo) === 0) {
                continue;
            }

            $copySubject = '[CC] ' . $subject;
            $copyBody = '<p><em>CC copy of a form sent to '
                . htmlspecialchars($primaryTo, ENT_QUOTES, 'UTF-8') . '.</em></p>' . $htmlBody;
            $headers = "From: {$fromEmail}\r\nReply-To: {$fromEmail}\r\n{$contentHeaders}";
            @mail($ccEmail, $copySubject, $copyBody, $headers);
        }
    }
}
