<?php
declare(strict_types=1);

if (!function_exists('caaft_smtp_is_configured')) {
    function caaft_smtp_is_configured(): bool
    {
        return caaft_zeptomail_raw_token() !== '';
    }
}

if (!function_exists('caaft_zeptomail_raw_token')) {
    /**
     * Send Mail Token / API key from mail.local.php (never logged in full).
     */
    function caaft_zeptomail_raw_token(): string
    {
        $config = caaft_mail_config();
        $token = trim((string) ($config['smtp_password'] ?? ''));
        if ($token === '') {
            $token = trim((string) ($config['zeptomail_api_key'] ?? ''));
        }

        // Strip accidental wrapping quotes from pasted .php values.
        if (strlen($token) >= 2) {
            $first = $token[0];
            $last = $token[strlen($token) - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $token = trim(substr($token, 1, -1));
            }
        }

        return $token;
    }
}

if (!function_exists('caaft_zeptomail_smtp_password')) {
    /**
     * SMTP AUTH password is the raw token without the HTTP "Zoho-enczapikey" prefix.
     */
    function caaft_zeptomail_smtp_password(): string
    {
        $token = caaft_zeptomail_raw_token();
        if (preg_match('/^Zoho-enczapikey\s+/i', $token)) {
            $token = trim((string) preg_replace('/^Zoho-enczapikey\s+/i', '', $token));
        }

        return $token;
    }
}

if (!function_exists('caaft_zeptomail_api_authorization')) {
    function caaft_zeptomail_api_authorization(): string
    {
        $token = caaft_zeptomail_raw_token();
        if ($token === '') {
            return '';
        }
        if (preg_match('/^Zoho-enczapikey\s+/i', $token)) {
            return $token;
        }

        return 'Zoho-enczapikey ' . $token;
    }
}

if (!function_exists('caaft_zeptomail_api_endpoint')) {
    function caaft_zeptomail_api_endpoint(): string
    {
        $host = strtolower(trim((string) (caaft_mail_config()['smtp_host'] ?? '')));
        if (strpos($host, 'zeptomail.in') !== false || strpos($host, 'zoho.in') !== false) {
            return 'https://api.zeptomail.in/v1.1/email';
        }

        return 'https://api.zeptomail.com/v1.1/email';
    }
}

if (!function_exists('caaft_mail_log')) {
    function caaft_mail_log(string $message): void
    {
        $dir = (defined('PROJECT_ROOT') ? PROJECT_ROOT : dirname(__DIR__, 2)) . '/storage';
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        if (!is_dir($dir) || !is_writable($dir)) {
            return;
        }

        @file_put_contents(
            $dir . '/mail.log',
            '[' . date('c') . '] ' . $message . "\n",
            FILE_APPEND
        );
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
    function caaft_smtp_expect($socket, array $codes, string $context = ''): bool
    {
        [$code, $text] = caaft_smtp_read_response($socket);
        if (in_array($code, $codes, true)) {
            return true;
        }

        caaft_mail_log(
            'SMTP unexpected ' . $code
            . ($context !== '' ? ' at ' . $context : '')
            . ($text !== '' ? ': ' . $text : '')
        );

        return false;
    }
}

if (!function_exists('caaft_smtp_command')) {
    function caaft_smtp_command($socket, string $command, array $codes, string $context = ''): bool
    {
        if (!is_resource($socket)) {
            return false;
        }

        fwrite($socket, $command . "\r\n");

        return caaft_smtp_expect($socket, $codes, $context !== '' ? $context : strtok($command, ' '));
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
    /**
     * @param list<array{path:string,name?:string,type?:string}> $attachments
     */
    function caaft_smtp_send_mail(
        string $to,
        string $subject,
        string $htmlBody,
        string $replyToEmail,
        string $replyToName = '',
        array $cc = [],
        array $attachments = [],
    ): bool {
        $config = caaft_mail_config();
        $host = trim((string) ($config['smtp_host'] ?? ''));
        $port = (int) ($config['smtp_port'] ?? 587);
        $encryption = strtolower(trim((string) ($config['smtp_encryption'] ?? 'tls')));
        $user = trim((string) ($config['smtp_user'] ?? 'emailapikey'));
        $password = caaft_zeptomail_smtp_password();

        if ($host === '' || $user === '' || $password === '') {
            caaft_mail_log('SMTP skipped: missing host/user/password');
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

        if (!caaft_smtp_expect($socket, [220], 'banner')) {
            fclose($socket);

            return false;
        }

        $ehloDomain = caaft_smtp_ehlo_domain();
        if (!caaft_smtp_command($socket, 'EHLO ' . $ehloDomain, [250], 'EHLO')) {
            fclose($socket);

            return false;
        }

        if ($encryption === 'tls') {
            if (!caaft_smtp_command($socket, 'STARTTLS', [220], 'STARTTLS')) {
                fclose($socket);

                return false;
            }

            $cryptoMethod = STREAM_CRYPTO_METHOD_TLS_CLIENT;
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
                $cryptoMethod |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            }

            if (!@stream_socket_enable_crypto($socket, true, $cryptoMethod)) {
                caaft_mail_log('SMTP TLS handshake failed for ' . $host);
                fclose($socket);

                return false;
            }

            if (!caaft_smtp_command($socket, 'EHLO ' . $ehloDomain, [250], 'EHLO-TLS')) {
                fclose($socket);

                return false;
            }
        }

        if (!caaft_smtp_command($socket, 'AUTH LOGIN', [334], 'AUTH LOGIN')
            || !caaft_smtp_command($socket, base64_encode($user), [334], 'AUTH user')
            || !caaft_smtp_command($socket, base64_encode($password), [235], 'AUTH pass')) {
            // Reconnect for AUTH PLAIN — connection is often unusable after a failed LOGIN.
            fclose($socket);
            $socket = @stream_socket_client($remote, $errno, $errstr, 25, STREAM_CLIENT_CONNECT);
            if (!is_resource($socket)) {
                caaft_mail_log('SMTP auth failed for ' . $host . ' as ' . $user);
                return false;
            }
            stream_set_timeout($socket, 25);
            if (!caaft_smtp_expect($socket, [220], 'banner-plain')
                || !caaft_smtp_command($socket, 'EHLO ' . $ehloDomain, [250], 'EHLO-plain')) {
                fclose($socket);
                return false;
            }
            if ($encryption === 'tls') {
                if (!caaft_smtp_command($socket, 'STARTTLS', [220], 'STARTTLS-plain')
                    || !@stream_socket_enable_crypto($socket, true, $cryptoMethod)
                    || !caaft_smtp_command($socket, 'EHLO ' . $ehloDomain, [250], 'EHLO-TLS-plain')) {
                    fclose($socket);
                    return false;
                }
            }
            $plain = base64_encode("\0" . $user . "\0" . $password);
            if (!caaft_smtp_command($socket, 'AUTH PLAIN ' . $plain, [235], 'AUTH PLAIN')) {
                caaft_mail_log('SMTP auth failed for ' . $host . ' as ' . $user);
                fclose($socket);

                return false;
            }
        }

        if (!caaft_smtp_command($socket, 'MAIL FROM:<' . $fromEmail . '>', [250], 'MAIL FROM')) {
            fclose($socket);

            return false;
        }

        $recipients = array_values(array_unique(array_merge([$to], $cc)));
        foreach ($recipients as $recipient) {
            $recipient = caaft_sanitize_mail_address($recipient);
            if ($recipient === '') {
                continue;
            }

            if (!caaft_smtp_command($socket, 'RCPT TO:<' . $recipient . '>', [250, 251], 'RCPT ' . $recipient)) {
                fclose($socket);

                return false;
            }
        }

        if (!caaft_smtp_command($socket, 'DATA', [354], 'DATA')) {
            fclose($socket);

            return false;
        }

        $fromHeader = caaft_format_mail_address($fromEmail, $fromName);
        $replyHeader = caaft_format_mail_address($replyToEmail, $replyToName);
        $encodedSubject = caaft_encode_mail_header_value($subject);
        $cc = array_values(array_filter(array_map('caaft_sanitize_mail_address', $cc)));

        $message = 'From: ' . $fromHeader . "\r\n";
        $message .= 'To: ' . $to . "\r\n";
        if ($replyHeader !== '') {
            $message .= 'Reply-To: ' . $replyHeader . "\r\n";
        }
        if ($cc !== []) {
            $message .= 'Cc: ' . implode(', ', $cc) . "\r\n";
        }
        $message .= 'MIME-Version: 1.0' . "\r\n";
        $message .= 'Subject: ' . $encodedSubject . "\r\n";

        $safeAttachments = [];
        foreach ($attachments as $attachment) {
            $path = (string) ($attachment['path'] ?? '');
            if ($path === '' || !is_file($path) || !is_readable($path)) {
                continue;
            }
            $safeAttachments[] = $attachment;
        }

        if ($safeAttachments === []) {
            $message .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $message .= "\r\n";
            $message .= str_replace(["\r\n", "\r"], "\n", $htmlBody);
        } else {
            $boundary = 'caaft_' . bin2hex(random_bytes(12));
            $message .= 'Content-Type: multipart/mixed; boundary="' . $boundary . '"' . "\r\n";
            $message .= "\r\n";
            $message .= '--' . $boundary . "\r\n";
            $message .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $message .= 'Content-Transfer-Encoding: 8bit' . "\r\n\r\n";
            $message .= str_replace(["\r\n", "\r"], "\n", $htmlBody) . "\r\n";

            foreach ($safeAttachments as $attachment) {
                $path = (string) $attachment['path'];
                $filename = (string) ($attachment['name'] ?? basename($path));
                $filename = preg_replace('/[\r\n"]+/', '', $filename) ?: 'resume';
                $mime = (string) ($attachment['type'] ?? 'application/octet-stream');
                $mime = preg_replace('/[\r\n]+/', '', $mime) ?: 'application/octet-stream';
                $binary = file_get_contents($path);
                if ($binary === false) {
                    continue;
                }

                $message .= '--' . $boundary . "\r\n";
                $message .= 'Content-Type: ' . $mime . '; name="' . $filename . '"' . "\r\n";
                $message .= 'Content-Transfer-Encoding: base64' . "\r\n";
                $message .= 'Content-Disposition: attachment; filename="' . $filename . '"' . "\r\n\r\n";
                $message .= chunk_split(base64_encode($binary)) . "\r\n";
            }

            $message .= '--' . $boundary . '--';
        }

        $message = str_replace("\n.", "\n..", str_replace(["\r\n", "\r"], "\n", $message));
        $message = str_replace("\n", "\r\n", $message);
        $message .= "\r\n.\r\n";

        if (!caaft_smtp_write_all($socket, $message)) {
            caaft_mail_log('SMTP write failed for subject: ' . $subject);
            fclose($socket);

            return false;
        }

        if (!caaft_smtp_expect($socket, [250], 'DATA body')) {
            caaft_mail_log('SMTP DATA rejected for subject: ' . $subject);
            fclose($socket);

            return false;
        }

        caaft_smtp_command($socket, 'QUIT', [221]);
        fclose($socket);

        return true;
    }
}

if (!function_exists('caaft_zeptomail_api_send_mail')) {
    /**
     * HTTP API fallback (same Send Mail Token). Supports attachments.
     *
     * @param list<array{path:string,name?:string,type?:string}> $attachments
     */
    function caaft_zeptomail_api_send_mail(
        string $to,
        string $subject,
        string $htmlBody,
        string $replyToEmail,
        string $replyToName = '',
        array $cc = [],
        array $attachments = [],
    ): bool {
        $auth = caaft_zeptomail_api_authorization();
        if ($auth === '' || !function_exists('curl_init')) {
            return false;
        }

        $fromEmail = caaft_form_sender_email();
        $fromName = trim((string) (caaft_mail_config()['form_sender_name'] ?? 'CAAFT Website'));
        $to = caaft_sanitize_mail_address($to);
        $replyToEmail = caaft_sanitize_mail_address($replyToEmail);
        if ($fromEmail === '' || $to === '') {
            return false;
        }

        $payload = [
            'from' => [
                'address' => $fromEmail,
                'name' => $fromName,
            ],
            'to' => [
                [
                    'email_address' => [
                        'address' => $to,
                    ],
                ],
            ],
            'subject' => $subject,
            'htmlbody' => $htmlBody,
        ];

        if ($replyToEmail !== '') {
            $payload['reply_to'] = [
                [
                    'address' => $replyToEmail,
                    'name' => caaft_sanitize_mail_name($replyToName),
                ],
            ];
        }

        $ccList = [];
        foreach ($cc as $ccEmail) {
            $ccEmail = caaft_sanitize_mail_address((string) $ccEmail);
            if ($ccEmail === '' || strcasecmp($ccEmail, $to) === 0) {
                continue;
            }
            $ccList[] = ['email_address' => ['address' => $ccEmail]];
        }
        if ($ccList !== []) {
            $payload['cc'] = $ccList;
        }

        $apiAttachments = [];
        foreach ($attachments as $attachment) {
            $path = (string) ($attachment['path'] ?? '');
            if ($path === '' || !is_file($path) || !is_readable($path)) {
                continue;
            }
            $binary = file_get_contents($path);
            if ($binary === false) {
                continue;
            }
            $filename = preg_replace('/[\r\n"]+/', '', (string) ($attachment['name'] ?? basename($path))) ?: 'resume';
            $mime = preg_replace('/[\r\n]+/', '', (string) ($attachment['type'] ?? 'application/octet-stream')) ?: 'application/octet-stream';
            $apiAttachments[] = [
                'name' => $filename,
                'mime_type' => $mime,
                'content' => base64_encode($binary),
            ];
        }
        if ($apiAttachments !== []) {
            $payload['attachments'] = $apiAttachments;
        }

        $json = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if (!is_string($json)) {
            return false;
        }

        $curl = curl_init(caaft_zeptomail_api_endpoint());
        if ($curl === false) {
            return false;
        }

        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 45,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: ' . $auth,
            ],
            CURLOPT_POSTFIELDS => $json,
        ]);

        $response = curl_exec($curl);
        $httpCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        curl_close($curl);

        if ($response === false || $httpCode < 200 || $httpCode >= 300) {
            $snippet = is_string($response) ? substr(preg_replace('/\s+/', ' ', $response) ?? '', 0, 240) : '';
            if ($httpCode === 429 || stripos($snippet, 'Credit exhausted') !== false || stripos($snippet, 'LE_102') !== false) {
                caaft_mail_log('ZeptoMail credits exhausted (HTTP 429). Top up credits in ZeptoMail dashboard.');
            } else {
                caaft_mail_log(
                    'ZeptoMail API failed HTTP ' . $httpCode
                    . ($curlError !== '' ? ' curl=' . $curlError : '')
                    . ($snippet !== '' ? ' body=' . $snippet : '')
                );
            }

            return false;
        }

        return true;
    }
}

if (!function_exists('caaft_smtp_write_all')) {
    /**
     * @param resource $socket
     */
    function caaft_smtp_write_all($socket, string $message): bool
    {
        $length = strlen($message);
        $written = 0;

        while ($written < $length) {
            $chunk = fwrite($socket, substr($message, $written));
            if ($chunk === false || $chunk === 0) {
                return false;
            }
            $written += $chunk;
        }

        return true;
    }
}

if (!function_exists('caaft_build_multipart_mail')) {
    /**
     * Build a multipart/mixed MIME body for PHP mail() with optional attachments.
     *
     * @param list<array{path:string,name?:string,type?:string}> $attachments
     * @return array{0:string,1:string} [headersWithoutTo, body]
     */
    function caaft_build_multipart_mail(
        string $htmlBody,
        string $fromEmail,
        string $fromName,
        string $replyToEmail = '',
        string $replyToName = '',
        array $attachments = []
    ): array {
        $fromHeader = function_exists('caaft_format_mail_address')
            ? caaft_format_mail_address($fromEmail, $fromName)
            : $fromEmail;
        $replyHeader = ($replyToEmail !== '' && function_exists('caaft_format_mail_address'))
            ? caaft_format_mail_address($replyToEmail, $replyToName)
            : $replyToEmail;

        $headers = 'From: ' . $fromHeader . "\r\n";
        if ($replyHeader !== '') {
            $headers .= 'Reply-To: ' . $replyHeader . "\r\n";
        }
        $headers .= "MIME-Version: 1.0\r\n";

        $safeAttachments = [];
        foreach ($attachments as $attachment) {
            $path = (string) ($attachment['path'] ?? '');
            if ($path === '' || !is_file($path) || !is_readable($path)) {
                continue;
            }
            $safeAttachments[] = $attachment;
        }

        if ($safeAttachments === []) {
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            return [$headers, $htmlBody];
        }

        $boundary = 'caaft_' . bin2hex(random_bytes(12));
        $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . '"' . "\r\n";

        $body = '--' . $boundary . "\r\n";
        $body .= "Content-Type: text/html; charset=UTF-8\r\n";
        $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $body .= $htmlBody . "\r\n";

        foreach ($safeAttachments as $attachment) {
            $path = (string) $attachment['path'];
            $filename = preg_replace('/[\r\n"]+/', '', (string) ($attachment['name'] ?? basename($path))) ?: 'resume';
            $mime = preg_replace('/[\r\n]+/', '', (string) ($attachment['type'] ?? 'application/octet-stream')) ?: 'application/octet-stream';
            $binary = file_get_contents($path);
            if ($binary === false) {
                continue;
            }

            $body .= '--' . $boundary . "\r\n";
            $body .= 'Content-Type: ' . $mime . '; name="' . $filename . '"' . "\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= 'Content-Disposition: attachment; filename="' . $filename . '"' . "\r\n\r\n";
            $body .= chunk_split(base64_encode($binary)) . "\r\n";
        }

        $body .= '--' . $boundary . "--\r\n";

        return [$headers, $body];
    }
}
