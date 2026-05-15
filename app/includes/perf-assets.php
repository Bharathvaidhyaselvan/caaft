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
