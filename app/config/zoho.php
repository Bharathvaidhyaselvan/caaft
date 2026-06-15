<?php
declare(strict_types=1);

return [
    /**
     * Zoho CRM OAuth (India data center — matches ZeptoMail).
     * Put client_secret and refresh_token in app/config/zoho.local.php on the server.
     *
     * @see https://www.zoho.com/crm/developer/docs/api/v2/
     */
    'client_id' => '1000.UEMXHSHQM2O4NMY02LR5UFBK4T694U',
    'client_secret' => '',
    'refresh_token' => '',

    'accounts_domain' => 'accounts.zoho.in',
    'api_domain' => 'www.zohoapis.in',

    /** Must match Authorized Redirect URI in Zoho API Console (CAAFT client). */
    'redirect_uri' => 'https://caaft.com/zoho-oauth.php',
    'oauth_scopes' => 'ZohoCRM.modules.leads.CREATE,ZohoCRM.modules.leads.UPDATE,ZohoCRM.settings.ALL,ZohoCRM.users.READ',

    /** CRM module to create records in */
    'lead_module' => 'Leads',

    /** Default Lead_Source when the form has no "about" field */
    'lead_source' => 'Website',

    /** Zoho Leads API name for the form "service" field (Setup → Modules → Leads → Fields) */
    'service_field' => 'Required_Service',

    /**
     * Default Lead Owner for website leads (otherwise Zoho uses the OAuth authorizer).
     * Set one of these in app/config/zoho.local.php — id is most reliable.
     * Find user id: Zoho CRM → Setup → Users → open user → id in the URL.
     */
    'lead_owner_id' => '',
    'lead_owner_email' => '',
    /** Resolved via Zoho Users API when id/email not set (website API leads). */
    'lead_owner_name' => 'Pooja K',
];
