<?php
declare(strict_types=1);

return [
    /**
     * Zoho CRM OAuth (India data center — matches ZeptoMail).
     * Put client_secret and refresh_token in app/config/zoho.local.php on the server.
     *
     * @see https://www.zoho.com/crm/developer/docs/api/v2/
     */
    'client_id' => '1000.JB3ATNPSK930RN2SM2NSVBYJ8PW1RO',
    'client_secret' => '',
    'refresh_token' => '',

    'accounts_domain' => 'accounts.zoho.in',
    'api_domain' => 'www.zohoapis.in',

    /** CRM module to create records in */
    'lead_module' => 'Leads',

    /** Default Lead_Source when the form has no "about" field */
    'lead_source' => 'Website',

    /** Zoho Leads API name for the form "service" field (Setup → Modules → Leads → Fields) */
    'service_field' => 'Required_Service',
];
