<?php
declare(strict_types=1);

/**
 * Re-authorize Zoho CRM if refresh_token was lost after deploy.
 * Delete or block this file after use.
 */
require_once __DIR__ . '/app/bootstrap.php';
require_once APP_ROOT . '/includes/caaft-zoho-crm.php';

header('Content-Type: text/html; charset=UTF-8');

$grantCode = trim((string) ($_POST['grant_code'] ?? ''));

if ($grantCode !== '') {
    $config = caaft_zoho_config();
    $accountsDomain = trim((string) ($config['accounts_domain'] ?? 'accounts.zoho.in'));
    $tokens = caaft_zoho_http_post('https://' . $accountsDomain . '/oauth/v2/token', [
        'grant_type' => 'authorization_code',
        'client_id' => (string) ($config['client_id'] ?? ''),
        'client_secret' => (string) ($config['client_secret'] ?? ''),
        'code' => $grantCode,
    ]);

    if (!is_array($tokens) || empty($tokens['refresh_token'])) {
        echo '<h1>Failed</h1><p>' . htmlspecialchars(caaft_zoho_response_error($tokens), ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p><a href="">Try again</a></p>';
        exit;
    }

    $localPath = APP_ROOT . '/config/zoho.local.php';
    $local = is_file($localPath) ? require $localPath : [];
    if (!is_array($local)) {
        $local = [];
    }
    $local['refresh_token'] = (string) $tokens['refresh_token'];
    file_put_contents($localPath, "<?php\ndeclare(strict_types=1);\n\nreturn " . var_export($local, true) . ";\n");

    if (!empty($tokens['access_token'])) {
        caaft_zoho_write_token_cache([
            'access_token' => (string) $tokens['access_token'],
            'expires_at' => time() + max(300, (int) ($tokens['expires_in'] ?? 3600) - 120),
        ]);
    }

    echo '<h1>Zoho CRM reconnected</h1><p>Refresh token saved. Submit a test form, then remove this file.</p>';
    exit;
}

$scopes = 'ZohoCRM.modules.leads.CREATE,ZohoCRM.modules.leads.UPDATE,ZohoCRM.settings.ALL';
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Zoho reconnect</title></head><body>';
echo '<h1>Reconnect Zoho CRM</h1>';
echo '<ol>';
echo '<li><a href="https://api-console.zoho.in/" target="_blank">Zoho API Console</a> → Self Client → Generate Code</li>';
echo '<li>Scopes: <code>' . htmlspecialchars($scopes, ENT_QUOTES, 'UTF-8') . '</code></li>';
echo '<li>Paste code below within 3 minutes</li>';
echo '</ol>';
echo '<form method="post"><input type="text" name="grant_code" required style="width:100%;padding:8px"><br><br>';
echo '<button type="submit">Save refresh token</button></form></body></html>';
