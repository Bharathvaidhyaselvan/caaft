<?php
declare(strict_types=1);

if (!function_exists('caaft_asset_version')) {
    function caaft_asset_version(string $relativePath): string
    {
        $fullPath = PROJECT_ROOT . '/' . ltrim($relativePath, '/');
        $mtime = @filemtime($fullPath);
        return $mtime ? (string) $mtime : '1';
    }
}

if (!function_exists('caaft_versioned_asset_url')) {
    /** Site path or absolute URL with cache-busting query for local files under project root. */
    function caaft_versioned_asset_url(string $src): string
    {
        if (strncmp($src, 'http://', 7) === 0 || strncmp($src, 'https://', 8) === 0) {
            return $src;
        }

        $path = parse_url($src, PHP_URL_PATH);
        if (!is_string($path) || $path === '') {
            $path = $src;
        }

        $relative = rawurldecode(ltrim($path, '/'));

        // Removed tax placeholder — always serve Private Limited overview art instead.
        if (str_contains($relative, 'gst-registration-overview.jpg')) {
            $src = '/assets/img/services-images/Business%20Set%20up%20%26%20REgistration/Pvt%20ltd.jpg';
            $relative = 'assets/img/services-images/Business Set up & REgistration/Pvt ltd.jpg';
        }

        $version = caaft_asset_version($relative);
        $separator = str_contains($src, '?') ? '&' : '?';

        return $src . $separator . 'v=' . rawurlencode($version);
    }
}

if (!function_exists('caaft_defer_stylesheet')) {
    function caaft_defer_stylesheet(string $href): void
    {
        $safeHref = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');
        echo '<link rel="stylesheet" href="' . $safeHref . '" media="print" onload="this.media=\'all\'">' . "\n";
        echo '<noscript><link rel="stylesheet" href="' . $safeHref . '"></noscript>' . "\n";
    }
}

if (!function_exists('caaft_current_page_slug')) {
    function caaft_current_page_slug(): string
    {
        if (!empty($GLOBALS['caaft_active_page'])) {
            return (string) $GLOBALS['caaft_active_page'];
        }
        return basename($_SERVER['PHP_SELF'] ?? '', '.php');
    }
}

if (!function_exists('caaft_page_features')) {
    /** @return array{home: bool, carousel: bool, aos: bool, gallery: bool, tabs: bool} */
    function caaft_page_features(): array
    {
        static $features = null;
        if ($features !== null) {
            return $features;
        }

        $slug = caaft_current_page_slug();
        $home = $slug === 'index';
        $gallerySlugs = ['blog1', 'blog2', 'blog3'];

        $features = [
            'home' => $home,
            'carousel' => $home,
            'aos' => true,
            'gallery' => $home || in_array($slug, $gallerySlugs, true),
            'tabs' => true,
        ];

        return $features;
    }
}

if (!function_exists('caaft_defer_script')) {
    function caaft_defer_script(string $src): void
    {
        $safeSrc = htmlspecialchars($src, ENT_QUOTES, 'UTF-8');
        echo '<script src="' . $safeSrc . '" defer></script>' . "\n";
    }
}
