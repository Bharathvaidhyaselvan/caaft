<?php
declare(strict_types=1);

if (!function_exists('caaft_smtp_is_configured')) {
    function caaft_smtp_is_configured(): bool
    {
        $config = caaft_mail_config();

        return trim((string) ($config['smtp_host'] ?? '')) !== ''
            && trim((string) ($config['smtp_user'] ?? '')) !== ''
            && (string) ($config['smtp_password'] ?? '') !== '';
    }
}

if (!function_exists('caaft_smtp_read_response')) {
    function caaft_smtp_read_response($socket): array
    {
        $lines = [];

        while (is_resource($socket) && !feof($socket)) {
            $line = fgets($socket, 515);
            if ($line === false) {
                break;
            }

            $lines[] = rtrim($line, "\r\n");
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }

        if ($lines === []) {
            return [0, ''];
        }

        return [(int) substr($lines[count($lines) - 1], 0, 3), implode("\n", $lines)];
    }
}

if (!function_exists('caaft_smtp_expect')) {
    function caaft_smtp_expect($socket, array $codes): bool
    {
        [$code] = caaft_smtp_read_response($socket);

        return in_array($code, $codes, true);
    }
}

if (!function_exists('caaft_smtp_command')) {
    function caaft_smtp_command($socket, string $command, array $codes): bool
    {
        if (!is_resource($socket)) {
            return false;
        }

        fwrite($socket, $command . "\r\n");

        return caaft_smtp_expect($socket, $codes);
    }
}

if (!function_exists('caaft_smtp_ehlo_domain')) {
    function caaft_smtp_ehlo_domain(): string
    {
        $host = trim((string) ($_SERVER['HTTP_HOST'] ?? ''));
        if ($host !== '') {
            return preg_replace('/:\d+$/', '', $host) ?: 'caaft.com';
        }

        return 'caaft.com';
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
        $email = caaft_sanitize_mail_address($email);
        if ($email === '') {
            return '';
        }

        $name = caaft_encode_mail_header_value($name);

        return $name !== '' ? $name . ' <' . $email . '>' : $email;
    }
}

if (!function_exists('caaft_form_sender_email')) {
    function caaft_form_sender_email(): string
    {
        $configured = caaft_sanitize_mail_address((string) (caaft_mail_config()['form_sender'] ?? ''));

        return $configured !== '' ? $configured : caaft_form_recipient_email();
    }
}

if (!function_exists('caaft_smtp_send_mail')) {
    function caaft_smtp_send_mail(
        string $to,
        string $subject,
        string $htmlBody,
        string $replyToEmail,
        string $replyToName = '',
        array $cc = [],
    ): bool {
        $config = caaft_mail_config();
        $host = trim((string) ($config['smtp_host'] ?? ''));
        $port = (int) ($config['smtp_port'] ?? 587);
        $encryption = strtolower(trim((string) ($config['smtp_encryption'] ?? 'tls')));
        $user = trim((string) ($config['smtp_user'] ?? ''));
        $password = (string) ($config['smtp_password'] ?? '');

        if ($host === '' || $user === '' || $password === '') {
            return false;
        }

        $fromEmail = caaft_form_sender_email();
        $fromName = trim((string) ($config['form_sender_name'] ?? 'CAAFT Website'));
        if ($fromEmail === '') {
            return false;
        }

        $remote = ($encryption === 'ssl' ? 'ssl://' : '') . $host . ':' . $port;
        $socket = @stream_socket_client($remote, $errno, $errstr, 25, STREAM_CLIENT_CONNECT);
        if (!is_resource($socket)) {
            return false;
        }

        stream_set_timeout($socket, 25);

        if (!caaft_smtp_expect($socket, [220])) {
            fclose($socket);

            return false;
        }

        $ehloDomain = caaft_smtp_ehlo_domain();
        if (!caaft_smtp_command($socket, 'EHLO ' . $ehloDomain, [250])) {
            fclose($socket);

            return false;
        }

        if ($encryption === 'tls') {
            if (!caaft_smtp_command($socket, 'STARTTLS', [220])) {
                fclose($socket);

                return false;
            }

            $cryptoMethod = STREAM_CRYPTO_METHOD_TLS_CLIENT;
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
                $cryptoMethod |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            }

            if (!@stream_socket_enable_crypto($socket, true, $cryptoMethod)) {
                fclose($socket);

                return false;
            }

            if (!caaft_smtp_command($socket, 'EHLO ' . $ehloDomain, [250])) {
                fclose($socket);

                return false;
            }
        }

        if (!caaft_smtp_command($socket, 'AUTH LOGIN', [334])
            || !caaft_smtp_command($socket, base64_encode($user), [334])
            || !caaft_smtp_command($socket, base64_encode($password), [235])) {
            fclose($socket);

            return false;
        }

        if (!caaft_smtp_command($socket, 'MAIL FROM:<' . $fromEmail . '>', [250])) {
            fclose($socket);

            return false;
        }

        $recipients = array_values(array_unique(array_merge([$to], $cc)));
        foreach ($recipients as $recipient) {
            $recipient = caaft_sanitize_mail_address($recipient);
            if ($recipient === '') {
                continue;
            }

            if (!caaft_smtp_command($socket, 'RCPT TO:<' . $recipient . '>', [250, 251])) {
                fclose($socket);

                return false;
            }
        }

        if (!caaft_smtp_command($socket, 'DATA', [354])) {
            fclose($socket);

            return false;
        }

        $fromHeader = caaft_format_mail_address($fromEmail, $fromName);
        $replyHeader = caaft_format_mail_address($replyToEmail, $replyToName);
        $encodedSubject = caaft_encode_mail_header_value($subject);
        $cc = array_values(array_filter(array_map('caaft_sanitize_mail_address', $cc)));

        $message = 'From: ' . $fromHeader . "\r\n";
        $message .= 'To: ' . $to . "\r\n";
        if ($cc !== []) {
            $message .= 'Cc: ' . implode(', ', $cc) . "\r\n";
        }
        if ($replyHeader !== '') {
            $message .= 'Reply-To: ' . $replyHeader . "\r\n";
        }
        $message .= 'MIME-Version: 1.0' . "\r\n";
        $message .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        $message .= 'Subject: ' . $encodedSubject . "\r\n";
        $message .= "\r\n";
        $message .= preg_replace('/\r\n\./', "\r\n..", str_replace(["\r\n", "\r"], "\n", $htmlBody));
        $message = str_replace("\n.", "\n..", $message);
        $message = str_replace("\n", "\r\n", $message);
        $message .= "\r\n.\r\n";

        fwrite($socket, $message);

        if (!caaft_smtp_expect($socket, [250])) {
            fclose($socket);

            return false;
        }

        caaft_smtp_command($socket, 'QUIT', [221]);
        fclose($socket);

        return true;
    }
}
