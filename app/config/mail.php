<?php
declare(strict_types=1);

return [
    /** All website form submissions (CTA, Contact us, enquiries) */
    'form_recipient' => 'services@caaft.com',
    /** Authenticated sender for Microsoft 365 SMTP */
    'form_sender' => 'services@caaft.com',
    'form_sender_name' => 'CAAFT Website',
    /** CC on every form submission */
    'form_cc' => [
        'bharathvaidhyaselvan@gmail.com',
    ],

    /**
     * Microsoft 365 SMTP — set smtp_password in app/config/mail.local.php on the server.
     * Admin: enable "Authenticated SMTP" for services@caaft.com.
     * If MFA is on, use an app password from https://account.microsoft.com/security
     */
    'smtp_host' => 'smtp.office365.com',
    'smtp_port' => 587,
    'smtp_encryption' => 'tls',
    'smtp_user' => 'services@caaft.com',
    'smtp_password' => '',
];
