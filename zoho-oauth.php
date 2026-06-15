<?php
declare(strict_types=1);

/**
 * Re-authorize Zoho CRM (CAAFT Server-based client).
 * Delete or block this file after use.
 */
require_once __DIR__ . '/app/bootstrap.php';
require_once APP_ROOT . '/includes/caaft-zoho-crm.php';

header('Content-Type: text/html; charset=UTF-8');

$config = caaft_zoho_config();
$authUrl = caaft_zoho_authorization_url();
$grantCode = trim((string) ($_POST['grant_code'] ?? ''));
$oauthCode = trim((string) ($_GET['code'] ?? ''));

if ($grantCode !== '') {
    $tokens = caaft_zoho_exchange_code($grantCode, false);
    render_zoho_result($tokens);
    exit;
}

if ($oauthCode !== '') {
    $tokens = caaft_zoho_exchange_code($oauthCode, true);
    render_zoho_result($tokens);
    exit;
}

echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
echo '<title>Reconnect Zoho CRM</title>';
echo '<style>body{font-family:system-ui,sans-serif;max-width:560px;margin:2rem auto;padding:0 1rem;line-height:1.6}';
echo 'a.btn{display:inline-block;padding:.75rem 1.25rem;background:#2563eb;color:#fff;text-decoration:none;border-radius:6px;font-weight:600}';
echo 'code{background:#f4f4f4;padding:.15rem .35rem;border-radius:4px}hr{margin:2rem 0}</style></head><body>';

echo '<h1>Reconnect Zoho CRM</h1>';

if (caaft_zoho_is_configured()) {
    echo '<p><strong>Status:</strong> Already connected. Re-authorize only if leads stopped syncing.</p>';
}

echo '<h2>Recommended: Authorize with Zoho</h2>';
echo '<p>Uses your <strong>CAAFT</strong> Server-based client and redirect URI:</p>';
echo '<p><code>' . htmlspecialchars((string) ($config['redirect_uri'] ?? ''), ENT_QUOTES, 'UTF-8') . '</code></p>';

if ($authUrl !== '') {
    echo '<p><a class="btn" href="' . htmlspecialchars($authUrl, ENT_QUOTES, 'UTF-8') . '">Authorize with Zoho</a></p>';
    echo '<p>Sign in, accept permissions, and you will return here automatically.</p>';
} else {
    echo '<p>Missing redirect_uri in app/config/zoho.php</p>';
}

echo '<hr><h2>Alternative: Self Client grant code</h2>';
echo '<p>Only if you use a separate Self Client (not CAAFT). Paste a generated code within 3 minutes.</p>';
echo '<form method="post"><input type="text" name="grant_code" placeholder="Paste grant code" style="width:100%;padding:8px;box-sizing:border-box"><br><br>';
echo '<button type="submit">Save refresh token</button></form>';
echo '</body></html>';

/**
 * @param array<string, mixed>|null $tokens
 */
function render_zoho_result(?array $tokens): void
{
    if (!is_array($tokens) || empty($tokens['refresh_token'])) {
        echo '<h1>Authorization failed</h1>';
        echo '<p>' . htmlspecialchars(caaft_zoho_response_error($tokens), ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Check that app/config/zoho.local.php has the <strong>CAAFT</strong> client secret.</p>';
        echo '<p><a href="">Try again</a></p>';
        exit;
    }

    if (!caaft_zoho_save_refresh_token((string) $tokens['refresh_token'], $tokens)) {
        echo '<h1>Could not save token</h1>';
        echo '<p>Make app/config/zoho.local.php writable on the server.</p>';
        exit;
    }

    echo '<h1>Zoho CRM connected</h1>';
    echo '<p>Refresh token saved. Submit a test form, then remove zoho-oauth.php from the server.</p>';
}
