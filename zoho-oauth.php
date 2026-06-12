<?php
declare(strict_types=1);

/**
 * One-time Zoho CRM setup — obtain refresh_token via Self Client grant code (no redirect URI).
 */
require_once __DIR__ . '/app/bootstrap.php';
require_once APP_ROOT . '/includes/caaft-zoho-crm.php';

header('Content-Type: text/html; charset=UTF-8');

$config = caaft_zoho_config();
$scopes = (string) ($config['oauth_scopes'] ?? 'ZohoCRM.modules.leads.CREATE,ZohoCRM.modules.leads.UPDATE');
$redirectUri = (string) ($config['redirect_uri'] ?? 'https://caaft.com/zoho-oauth.php');

$grantCode = trim((string) ($_POST['grant_code'] ?? ''));
$oauthCode = trim((string) ($_GET['code'] ?? ''));

if ($grantCode !== '') {
    $tokens = caaft_zoho_exchange_grant_code($grantCode);
    if (!is_array($tokens) || empty($tokens['refresh_token'])) {
        render_zoho_setup_page($scopes, $redirectUri, $tokens, 'Grant code invalid or expired. Generate a new code in Zoho API Console (valid ~3 minutes).');
        exit;
    }

    if (!caaft_zoho_save_refresh_token((string) $tokens['refresh_token'], $tokens)) {
        render_zoho_setup_page($scopes, $redirectUri, null, 'Could not write refresh token. Make app/config/zoho.local.php writable on the server.');
        exit;
    }

    render_zoho_connected_page();
    exit;
}

if ($oauthCode !== '') {
    $tokens = caaft_zoho_exchange_auth_code($oauthCode);
    if (!is_array($tokens) || empty($tokens['refresh_token'])) {
        $error = is_array($tokens) && !empty($tokens['error'])
            ? (string) $tokens['error']
            : 'Redirect OAuth failed. Use the Self Client method below (no redirect URI needed).';
        render_zoho_setup_page($scopes, $redirectUri, $tokens, $error);
        exit;
    }

    if (!caaft_zoho_save_refresh_token((string) $tokens['refresh_token'], $tokens)) {
        render_zoho_setup_page($scopes, $redirectUri, null, 'Could not write refresh token. Make app/config/zoho.local.php writable on the server.');
        exit;
    }

    render_zoho_connected_page();
    exit;
}

render_zoho_setup_page($scopes, $redirectUri);

/**
 * @param array<string, mixed>|null $tokenResponse
 */
function render_zoho_setup_page(string $scopes, string $redirectUri, ?array $tokenResponse = null, ?string $error = null): void
{
    $configured = caaft_zoho_is_configured();
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
    echo '<title>Zoho CRM setup</title>';
    echo '<style>body{font-family:system-ui,sans-serif;max-width:640px;margin:2rem auto;padding:0 1rem;line-height:1.5}';
    echo 'code,pre{background:#f4f4f4;padding:.2rem .4rem;border-radius:4px}pre{padding:1rem;overflow:auto}';
    echo '.ok{color:#0a7}.err{color:#c00;background:#fee;padding:.75rem;border-radius:6px}';
    echo 'input[type=text]{width:100%;padding:.6rem;font-size:1rem;box-sizing:border-box}';
    echo 'button{padding:.6rem 1.2rem;font-size:1rem;cursor:pointer}</style></head><body>';

    echo '<h1>Zoho CRM setup</h1>';

    if ($configured) {
        echo '<p class="ok"><strong>Status:</strong> Connected. Forms will create Leads in Zoho CRM.</p>';
    }

    if ($error !== null && $error !== '') {
        echo '<p class="err">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
    }

    if (is_array($tokenResponse) && !empty($tokenResponse['error'])) {
        echo '<pre>' . htmlspecialchars((string) $tokenResponse['error'], ENT_QUOTES, 'UTF-8') . '</pre>';
    }

    echo '<h2>Recommended: Self Client (no redirect URI)</h2>';
    echo '<ol>';
    echo '<li>Open <a href="https://api-console.zoho.in/" target="_blank" rel="noopener">Zoho API Console (India)</a>.</li>';
    echo '<li>Add client → <strong>Self Client</strong>.</li>';
    echo '<li>Copy that Self Client\'s <strong>Client ID</strong> and <strong>Client Secret</strong> into <code>app/config/zoho.php</code> and <code>app/config/zoho.local.php</code> (your current app is Server-based — that is why redirect URI failed).</li>';
    echo '<li>Click <strong>Generate Code</strong>, select scopes:<br><code>' . htmlspecialchars($scopes, ENT_QUOTES, 'UTF-8') . '</code></li>';
    echo '<li>Copy the code immediately (expires in ~3 minutes).</li>';
    echo '<li>Paste it below and submit.</li>';
    echo '</ol>';

    echo '<form method="post" action="">';
    echo '<p><label for="grant_code"><strong>Grant code from Zoho</strong></label></p>';
    echo '<p><input type="text" id="grant_code" name="grant_code" placeholder="Paste grant code here" required autocomplete="off"></p>';
    echo '<p><button type="submit">Connect Zoho CRM</button></p>';
    echo '</form>';

    echo '<h2>Alternative: browser OAuth (needs redirect URI)</h2>';
    echo '<p>Only if you use a <strong>Server-based</strong> client. In API Console, add this redirect URI exactly:</p>';
    echo '<pre>' . htmlspecialchars($redirectUri, ENT_QUOTES, 'UTF-8') . '</pre>';
    echo '<p><a href="' . htmlspecialchars(caaft_zoho_authorization_url(), ENT_QUOTES, 'UTF-8') . '">Authorize with Zoho</a></p>';

    echo '</body></html>';
}

function render_zoho_connected_page(): void
{
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Zoho CRM connected</title></head><body>';
    echo '<h1>Zoho CRM connected</h1>';
    echo '<p class="ok">Refresh token saved. Website forms will now create Leads in Zoho CRM.</p>';
    echo '<p>Submit a test form, then check <strong>Zoho CRM → Leads</strong>.</p>';
    echo '<p>You can restrict access to this setup page after testing.</p>';
    echo '</body></html>';
}
