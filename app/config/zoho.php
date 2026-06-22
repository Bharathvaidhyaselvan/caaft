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
     * Primary owner (Pooja K). Email is tried before id — ids are sometimes confused with assignment-rule ids.
     */
    'lead_owner_email' => 'pooja@caaft.com',
    'lead_owner_name' => 'Pooja K',
    'lead_owner_id' => '1186726000000927014',

    /**
     * Fallback owner if primary assignment makes Zoho reject the lead (Vasanth = OAuth user).
     * Omitting Owner on the last retry also defaults to the OAuth user.
     */
    'lead_owner_fallback_email' => '',
    'lead_owner_fallback_name' => 'Vasanth R',
    'lead_owner_fallback_id' => '',
];
