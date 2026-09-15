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

if (!function_exists('caaft_careers_recipient_email')) {
    function caaft_careers_recipient_email(): string
    {
        $configured = filter_var(
            (string) (caaft_mail_config()['careers_recipient'] ?? 'hr@caaft.com'),
            FILTER_VALIDATE_EMAIL,
        );

        return is_string($configured) ? $configured : 'hr@caaft.com';
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

if (!function_exists('caaft_form_sanitize_source_url')) {
    function caaft_form_sanitize_source_url(string $url): string
    {
        $url = trim($url);
        if ($url === '') {
            return '';
        }

        if (preg_match('~/(?:contact_mail|homecontact_mail|careers_mail|careers-apply|[a-z0-9-]+-mail)\.php(?:\?|$)~i', $url)) {
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
            return '<p><strong>Page URL:</strong> Unknown</p>';
        }

        $safe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

        return '<p><strong>Page URL:</strong> <a href="' . $safe . '">' . $safe . '</a></p>';
    }
}

if (!function_exists('caaft_form_enquiry_categories')) {
    function caaft_form_enquiry_categories(): array
    {
        return [
            'Business Setup & Registration',
            'Compliance & Regulatory',
            'Taxation',
            'Accounting & Reporting',
            'Advisory & CFO Services',
            'Startup & Funding Advisory',
            'Payroll',
        ];
    }
}

if (!function_exists('caaft_form_enquiry_category')) {
    function caaft_form_enquiry_category(string $handlerDefault): string
    {
        $allowed = caaft_form_enquiry_categories();
        $posted = trim((string) ($_POST['enquiry_category'] ?? ''));
        if (in_array($posted, $allowed, true)) {
            return $posted;
        }

        $service = strtolower((string) ($_POST['service'] ?? ''));
        $pageUrl = strtolower(caaft_form_source_url());

        if (preg_match('~/payroll-management|/payroll(?:/|$|[?#])~', $pageUrl)
            || (strpos($service, 'payroll') !== false && strpos($service, 'registration') === false)) {
            return 'Payroll';
        }

        if (preg_match(
            '~/startup-funding|/seed-funding|/government-grant|/pitch-deck|/business-loan|/startup-india|/credit-monitoring|/detailed-project-report|/cma~',
            $pageUrl,
        ) || preg_match('/startup|funding|grant|pitch deck|seed|business loan|cma/i', $service)) {
            return 'Startup & Funding Advisory';
        }

        if (preg_match('~/advisory-and-cfo|/feasibility-study|/business-valuation|/budgeting|/cfo-financial~', $pageUrl)
            || preg_match('/cfo|feasibility|valuation|budgeting|financial assessment/i', $service)) {
            return 'Advisory & CFO Services';
        }

        if (preg_match(
            '~/compliance-and-regulatory|(?:^|/)[^/]*-compliance(?:/|$|[?#])|/roc-compliance|/winding-up|/din-kyc|/add-remove-director|/registered-office-change|/increase-authorised-share-capital|/epf-esi-registration-compliance~',
            $pageUrl,
        ) || preg_match(
            '/annual compliance|roc (?:compliance|filing)|winding up|director kyc|din kyc|add.?remove director|registered office change|authorised share capital|epf.*esi/i',
            $service,
        )) {
            return 'Compliance & Regulatory';
        }

        if (preg_match('~/professional-tax|/income-tax|/gst-|/tax-|/tds-return~', $pageUrl)
            || preg_match('/income tax|gst |tds |tax (audit|planning)|professional tax/i', $service)) {
            return 'Taxation';
        }

        if (preg_match('~/accounting-reporting|/bookkeeping|receivable|financial-analysis-mis|financial-statement~', $pageUrl)
            || preg_match('/bookkeeping|accounting|receivable|payable|financial (analysis|statement)/i', $service)) {
            return 'Accounting & Reporting';
        }

        return in_array($handlerDefault, $allowed, true) ? $handlerDefault : $handlerDefault;
    }
}

if (!function_exists('caaft_form_enquiry_subject')) {
    function caaft_form_enquiry_subject(string $category, string $name): string
    {
        return $category . ' Enquiry from ' . $name;
    }
}

if (!function_exists('caaft_form_enquiry_heading_html')) {
    function caaft_form_enquiry_heading_html(string $category): string
    {
        $safe = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');

        return '<h3>' . $safe . ' Enquiry</h3>';
    }
}

if (!function_exists('caaft_try_send_mail')) {
    /**
     * Prefer Microsoft 365 SMTP when configured; otherwise fall back to Hostinger PHP mail().
     */
    /**
     * @param list<array{path:string,name?:string,type?:string}> $attachments
     */
    function caaft_try_send_mail(
        string $to,
        string $subject,
        string $htmlBody,
        string $fromName,
        string $fromEmail,
        array $attachments = []
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
            $smtpOk = caaft_smtp_send_mail(
                $to,
                $subject,
                $htmlBody,
                $fromEmail,
                $fromName,
                caaft_form_cc_emails(),
                $attachments,
            );
            if ($smtpOk) {
                return true;
            }
            if (function_exists('caaft_mail_log')) {
                caaft_mail_log('SMTP send failed; trying PHP mail() fallback for ' . $to);
            }
        }

        if (!function_exists('caaft_build_multipart_mail')) {
            require_once (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__, 2)) . '/includes/caaft-smtp-mail.php';
        }

        [$headers, $body] = caaft_build_multipart_mail(
            $htmlBody,
            caaft_form_sender_email(),
            trim((string) (caaft_mail_config()['form_sender_name'] ?? 'CAAFT Website')),
            $fromEmail,
            $fromName,
            $attachments,
        );

        $sender = caaft_form_sender_email();
        if (@mail($to, $subject, $body, $headers)) {
            return true;
        }
        if ($sender !== '' && @mail($to, $subject, $body, $headers, '-f' . $sender)) {
            return true;
        }

        if (function_exists('caaft_mail_log')) {
            caaft_mail_log('PHP mail() fallback failed for ' . $to . ' subject=' . $subject);
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
        string $usedHeaders
    ): void {
        if (strpos($usedHeaders, 'Cc:') !== false) {
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
            $headers = "From: {$fromEmail}\r\n{$contentHeaders}";
            @mail($ccEmail, $copySubject, $copyBody, $headers);
        }
    }
}

if (!function_exists('caaft_form_company_html')) {
    function caaft_form_company_html(string $company): string
    {
        if ($company === '') {
            return '';
        }

        return '<p><strong>Company:</strong> ' . $company . '</p>';
    }
}

if (!function_exists('caaft_form_message_html')) {
    function caaft_form_message_html(string $message): string
    {
        if ($message === '') {
            return '';
        }

        return '<p><strong>Message:</strong><br>' . nl2br($message) . '</p>';
    }
}

if (!function_exists('caaft_form_validate_enquiry_post')) {
    function caaft_form_validate_enquiry_post(bool $requireService = true): ?string
    {
        $name = post_clean('name');
        $email = caaft_sanitize_mail_address((string) ($_POST['email'] ?? ''));
        $phone = post_clean('phone');
        $service = post_clean('service');

        if ($name === '' || $email === '' || $phone === '' || ($requireService && $service === '')) {
            return 'Please fill all required fields.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email format.';
        }

        return null;
    }
}

if (!function_exists('caaft_form_build_lead_data')) {
    /**
     * @return array<string, string>
     */
    function caaft_form_build_lead_data(string $formType = 'enquiry', string $enquiryCategory = ''): array
    {
        $about = trim((string) ($_POST['about'] ?? ''));
        $aboutOther = trim((string) ($_POST['about_other'] ?? ''));
        if ($about === 'Others' && $aboutOther !== '') {
            $about = $aboutOther;
        }

        return [
            'name' => trim((string) ($_POST['name'] ?? '')),
            'company' => trim((string) ($_POST['company'] ?? '')),
            'email' => caaft_sanitize_mail_address((string) ($_POST['email'] ?? '')),
            'phone' => trim((string) ($_POST['phone'] ?? '')),
            'service' => trim((string) ($_POST['service'] ?? '')),
            'message' => trim((string) ($_POST['message'] ?? $_POST['msg'] ?? '')),
            'about' => $about,
            'about_other' => $aboutOther,
            'title' => trim((string) ($_POST['title'] ?? '')),
            'page_url' => caaft_form_source_url(),
            'form_type' => $formType,
            'enquiry_category' => $enquiryCategory !== ''
                ? $enquiryCategory
                : trim((string) ($_POST['enquiry_category'] ?? '')),
        ];
    }
}

if (!function_exists('caaft_form_is_ajax_request')) {
    function caaft_form_is_ajax_request(): bool
    {
        $requestedWith = strtolower((string) ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? ''));
        if ($requestedWith === 'xmlhttprequest') {
            return true;
        }

        $accept = strtolower((string) ($_SERVER['HTTP_ACCEPT'] ?? ''));

        return str_contains($accept, 'application/json');
    }
}

if (!function_exists('caaft_form_json_response')) {
    function caaft_form_json_response(bool $ok, string $message, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(
            ['ok' => $ok, 'message' => $message],
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
        exit;
    }
}

if (!function_exists('caaft_form_abort')) {
    function caaft_form_abort(string $message, int $status = 400): void
    {
        if (caaft_form_is_ajax_request()) {
            caaft_form_json_response(false, $message, $status);
        }

        exit($message);
    }
}

if (!function_exists('caaft_form_redirect_thankyou')) {
    function caaft_form_redirect_thankyou(
        ?string $message = null,
        bool $useHistoryBackOnFailure = false
    ): void {
        $defaultMessage = 'Thanks for reaching us. You will get notified by our advisory team shortly.';
        if (caaft_form_is_ajax_request()) {
            caaft_form_json_response(true, $message ?? $defaultMessage);
        }

        $alertMessage = json_encode(
            $message ?? $defaultMessage,
            JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE,
        );

        if ($useHistoryBackOnFailure) {
            echo "<script>alert({$alertMessage}); window.location.href='thankyou.php';</script>";
        } else {
            echo "<script>alert({$alertMessage}); window.location.href='thankyou.php';</script>";
        }
        exit;
    }
}

if (!function_exists('caaft_form_complete_submission')) {
    /**
     * Push lead to Zoho CRM, send notification email, then redirect to thank-you page.
     *
     * @param array<string, string> $leadData
     */
    /**
     * @param array<string, string> $leadData
     * @param list<array{path:string,name?:string,type?:string}> $attachments
     */
    function caaft_form_complete_submission(
        array $leadData,
        string $to,
        string $subject,
        string $body,
        string $fromName,
        string $fromEmail,
        ?string $successMessage = null,
        bool $useHistoryBackOnFailure = false,
        array $attachments = []
    ): void {
        $zohoConfigured = false;
        $zohoOk = false;

        try {
            if (!function_exists('caaft_zoho_push_lead')) {
                require_once (defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__, 2)) . '/includes/caaft-zoho-crm.php';
            }

            $zohoConfigured = caaft_zoho_is_configured();
            if ($zohoConfigured) {
                $zohoOk = caaft_zoho_push_lead($leadData);
            } elseif (function_exists('caaft_zoho_log')) {
                caaft_zoho_log('Form submission skipped Zoho: refresh_token missing in zoho.local.php');
            }
        } catch (Throwable $e) {
            if (function_exists('caaft_zoho_log')) {
                caaft_zoho_log('Form Zoho exception: ' . $e->getMessage());
            }
        }

        $mailOk = caaft_try_send_mail($to, $subject, $body, $fromName, $fromEmail, $attachments);

        if ($zohoConfigured && !$zohoOk && $mailOk && function_exists('caaft_zoho_log')) {
            caaft_zoho_log('Form saved via email only; Zoho push failed for ' . ($leadData['email'] ?? 'unknown'));
        }

        $success = $zohoConfigured ? ($zohoOk || $mailOk) : $mailOk;
        $errorMessage = 'There was an error sending your message. Please try again later.';

        if ($success) {
            caaft_form_redirect_thankyou($successMessage, $useHistoryBackOnFailure);
        }

        if (caaft_form_is_ajax_request()) {
            caaft_form_json_response(false, $errorMessage, 500);
        }

        if ($useHistoryBackOnFailure) {
            $encodedError = json_encode(
                $errorMessage,
                JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE,
            );
            echo "<script>alert({$encodedError}); history.back();</script>";
            exit;
        }

        echo 'Something went wrong. Please try again later.';
        exit;
    }
}
