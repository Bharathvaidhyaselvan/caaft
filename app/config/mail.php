<?php
declare(strict_types=1);

return [
    /**
     * Lead capture only — notify your team. Customers do not receive email.
     */
    'form_recipient' => 'services@caaft.com',
    'form_sender' => 'enquiry@caaft.com',
    'form_sender_name' => 'CAAFT Website',
    'form_cc' => [],

    /**
     * ZeptoMail SMTP (https://zeptomail.zoho.in/)
     * Put the Send Mail token in app/config/mail.local.php on the server.
     * From address (enquiry@caaft.com) must be verified in your ZeptoMail Mail Agent.
     *
     * @see https://www.zoho.com/zeptomail/help/smtp-home.html
     */
    'smtp_host' => 'smtp.zeptomail.in',
    'smtp_port' => 587,
    'smtp_encryption' => 'tls',
    'smtp_user' => 'emailapikey',
    'smtp_password' => '',
];
