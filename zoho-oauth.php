<?php
/**
 * One-time Zoho CRM reconnect (CAAFT Server-based client).
 * Self-contained — does not load app/bootstrap.php or caaft-zoho-crm.php.
 * Delete this file from production after refresh_token is saved.
 */
header('Content-Type: text/html; charset=UTF-8');

$projectRoot = __DIR__;
$appRoot = $projectRoot . '/app';
$configDir = $appRoot . '/config';
$zohoPhp = $configDir . '/zoho.php';
$zohoLocalPhp = $configDir . '/zoho.local.php';
$storageDir = $projectRoot . '/storage';

/**
 * @return array<string, mixed>
 */
function zoho_oauth_load_config(string $configDir): array
{
    $config = [];
    $zohoPhp = $configDir . '/zoho.php';
    $zohoLocalPhp = $configDir . '/zoho.local.php';

    if (!is_file($zohoPhp)) {
        zoho_oauth_die('Missing <code>app/config/zoho.php</code>. Upload the full site zip.');
    }

    $base = require $zohoPhp;
    if (!is_array($base)) {
        zoho_oauth_die('<code>app/config/zoho.php</code> must return an array. Check for PHP syntax errors in that file.');
    }
    $config = $base;

    if (is_file($zohoLocalPhp)) {
        $local = require $zohoLocalPhp;
        if (!is_array($local)) {
            zoho_oauth_die('<code>app/config/zoho.local.php</code> must return an array. Check for PHP syntax errors (missing semicolon, smart quotes, etc.).');
        }
        $config = array_merge($config, $local);
    }

    return $config;
}

/**
 * @param array<string, string> $fields
 * @return array<string, mixed>|null
 */
function zoho_oauth_http_post(string $url, array $fields): ?array
{
    $body = http_build_query($fields);

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        if ($response === false) {
            return null;
        }

        $decoded = json_decode((string) $response, true);

        return is_array($decoded) ? $decoded : null;
    }

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $body,
            'timeout' => 30,
            'ignore_errors' => true,
        ],
    ]);
    $response = @file_get_contents($url, false, $context);
    if ($response === false) {
        return null;
    }

    $decoded = json_decode($response, true);

    return is_array($decoded) ? $decoded : null;
}

/**
 * @param array<string, mixed> $config
 */
function zoho_oauth_authorization_url(array $config): string
{
    $accountsDomain = trim((string) ($config['accounts_domain'] ?? 'accounts.zoho.in'));
    $redirectUri = trim((string) ($config['redirect_uri'] ?? ''));
    $clientId = trim((string) ($config['client_id'] ?? ''));
    if ($redirectUri === '' || $clientId === '') {
        return '';
    }

    $params = [
        'scope' => (string) ($config['oauth_scopes'] ?? 'ZohoCRM.modules.leads.CREATE'),
        'client_id' => $clientId,
        'response_type' => 'code',
        'access_type' => 'offline',
        'prompt' => 'consent',
        'redirect_uri' => $redirectUri,
    ];

    return 'https://' . $accountsDomain . '/oauth/v2/auth?' . http_build_query($params);
}

/**
 * @param array<string, mixed> $config
 * @return array<string, mixed>|null
 */
function zoho_oauth_exchange_code(array $config, string $code, bool $withRedirectUri): ?array
{
    $clientId = trim((string) ($config['client_id'] ?? ''));
    $clientSecret = trim((string) ($config['client_secret'] ?? ''));
    $code = trim($code);
    if ($clientId === '' || $clientSecret === '' || $code === '') {
        return null;
    }

    $accountsDomain = trim((string) ($config['accounts_domain'] ?? 'accounts.zoho.in'));
    $fields = [
        'grant_type' => 'authorization_code',
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'code' => $code,
    ];

    $redirectUri = trim((string) ($config['redirect_uri'] ?? ''));
    if ($withRedirectUri && $redirectUri !== '') {
        $fields['redirect_uri'] = $redirectUri;
    }

    return zoho_oauth_http_post('https://' . $accountsDomain . '/oauth/v2/token', $fields);
}

function zoho_oauth_save_refresh_token(string $localPath, string $refreshToken): bool
{
    $local = is_file($localPath) ? require $localPath : [];
    if (!is_array($local)) {
        $local = [];
    }

    $local['refresh_token'] = $refreshToken;
    $php = "<?php\ndeclare(strict_types=1);\n\nreturn " . var_export($local, true) . ";\n";

    return file_put_contents($localPath, $php) !== false;
}

/**
 * @param array<string, mixed>|null $response
 */
function zoho_oauth_error_message(?array $response): string
{
    if (!is_array($response)) {
        return 'No response from Zoho (network or server blocked outbound HTTPS).';
    }
    if (!empty($response['error'])) {
        $msg = (string) $response['error'];
        if (!empty($response['error_description'])) {
            $msg .= ': ' . (string) $response['error_description'];
        }

        return $msg;
    }

    return !empty($response['message']) ? (string) $response['message'] : 'unknown error';
}

function zoho_oauth_die(string $html): void
{
    http_response_code(500);
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Zoho setup error</title>';
    echo '<style>body{font-family:system-ui,sans-serif;max-width:640px;margin:2rem auto;padding:0 1rem;line-height:1.6}code{background:#f4f4f4;padding:.15rem .35rem;border-radius:4px}</style></head><body>';
    echo '<h1>Zoho setup error</h1><p>' . $html . '</p></body></html>';
    exit;
}

register_shutdown_function(static function (): void {
    $err = error_get_last();
    if ($err === null) {
        return;
    }
    $fatal = [E_ERROR, E_PARSE, E_COMPILE_ERROR, E_CORE_ERROR];
    if (!in_array($err['type'], $fatal, true)) {
        return;
    }
    if (headers_sent()) {
        echo '<hr><p><strong>PHP fatal:</strong> ' . htmlspecialchars($err['message'], ENT_QUOTES, 'UTF-8');
        echo ' in <code>' . htmlspecialchars($err['file'], ENT_QUOTES, 'UTF-8') . ':' . (int) $err['line'] . '</code></p>';
        return;
    }
    zoho_oauth_die(
        '<strong>PHP fatal:</strong> ' . htmlspecialchars($err['message'], ENT_QUOTES, 'UTF-8')
        . ' in <code>' . htmlspecialchars(basename((string) $err['file']), ENT_QUOTES, 'UTF-8') . ':' . (int) $err['line'] . '</code>'
    );
});

if (!is_dir($appRoot)) {
    zoho_oauth_die('Missing <code>app/</code> folder. Upload the full site next to <code>index.php</code>.');
}

$config = zoho_oauth_load_config($configDir);
$oauthCode = trim((string) ($_GET['code'] ?? ''));

if ($oauthCode !== '') {
    $tokens = zoho_oauth_exchange_code($config, $oauthCode, true);
    if (!is_array($tokens) || empty($tokens['refresh_token'])) {
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Authorization failed</title></head><body>';
        echo '<h1>Authorization failed</h1>';
        echo '<p><strong>Zoho says:</strong> ' . htmlspecialchars(zoho_oauth_error_message($tokens), ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Confirm <code>client_secret</code> in <code>app/config/zoho.local.php</code> is from the <strong>CAAFT</strong> Server-based app.</p>';
        echo '<p><a href="zoho-oauth.php">Try again</a></p></body></html>';
        exit;
    }

    if (!is_file($zohoLocalPhp)) {
        zoho_oauth_die('Create <code>app/config/zoho.local.php</code> on the server first (with <code>client_secret</code>).');
    }
    if (!is_writable($zohoLocalPhp) && !is_writable($configDir)) {
        zoho_oauth_die('Make <code>app/config/zoho.local.php</code> or <code>app/config/</code> writable so the refresh token can be saved.');
    }
    if (!zoho_oauth_save_refresh_token($zohoLocalPhp, (string) $tokens['refresh_token'])) {
        zoho_oauth_die('Could not write <code>app/config/zoho.local.php</code>. Check file permissions.');
    }

    if (!is_dir($storageDir)) {
        @mkdir($storageDir, 0755, true);
    }
    if (is_dir($storageDir) && !empty($tokens['access_token'])) {
        @file_put_contents(
            $storageDir . '/zoho-token.json',
            json_encode([
                'access_token' => (string) $tokens['access_token'],
                'expires_at' => time() + max(300, (int) ($tokens['expires_in'] ?? 3600) - 120),
            ], JSON_PRETTY_PRINT),
            LOCK_EX
        );
    }

    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Connected</title></head><body>';
    echo '<h1>Zoho CRM connected</h1>';
    echo '<p>Refresh token saved. Submit a test form, then delete <code>zoho-oauth.php</code> from the server.</p>';
    echo '</body></html>';
    exit;
}

$authUrl = zoho_oauth_authorization_url($config);
$hasSecret = trim((string) ($config['client_secret'] ?? '')) !== '';
$hasToken = trim((string) ($config['refresh_token'] ?? '')) !== '';

echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
echo '<title>Reconnect Zoho CRM</title>';
echo '<style>body{font-family:system-ui,sans-serif;max-width:560px;margin:2rem auto;padding:0 1rem;line-height:1.6}';
echo 'a.btn{display:inline-block;padding:.75rem 1.25rem;background:#2563eb;color:#fff;text-decoration:none;border-radius:6px;font-weight:600}';
echo 'code{background:#f4f4f4;padding:.15rem .35rem;border-radius:4px}</style></head><body>';

echo '<h1>Reconnect Zoho CRM</h1>';

if ($hasToken) {
    echo '<p><strong>Status:</strong> Refresh token is already saved. Re-authorize only if leads stopped syncing.</p>';
}

if (!$hasSecret) {
    echo '<p><strong>Action needed:</strong> Add <code>client_secret</code> to <code>app/config/zoho.local.php</code> on the server before clicking Authorize.</p>';
}

echo '<h2>Authorize with Zoho</h2>';
echo '<p>Click below → sign in to Zoho → accept permissions → you return here and the refresh token is saved automatically.</p>';
echo '<p>Redirect URI (must match Zoho API Console):</p>';
echo '<p><code>' . htmlspecialchars((string) ($config['redirect_uri'] ?? ''), ENT_QUOTES, 'UTF-8') . '</code></p>';

if ($authUrl !== '' && $hasSecret) {
    echo '<p><a class="btn" href="' . htmlspecialchars($authUrl, ENT_QUOTES, 'UTF-8') . '">Authorize with Zoho</a></p>';
} elseif ($authUrl !== '') {
    echo '<p>Add <code>client_secret</code> to <code>zoho.local.php</code>, then reload this page.</p>';
} else {
    echo '<p>Missing <code>client_id</code> or <code>redirect_uri</code> in <code>app/config/zoho.php</code>.</p>';
}

echo '</body></html>';
