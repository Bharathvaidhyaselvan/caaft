<?php
/**
 * Request context helpers (asset URLs for routed pages with <base href="/">).
 */
declare(strict_types=1);

if (!function_exists('caaft_public_asset_url')) {
    /**
     * Root-absolute, cache-busted URL for CSS/JS/images under /assets/.
     */
    function caaft_public_asset_url(string $relativePath): string
    {
        $relativePath = ltrim(str_replace('\\', '/', $relativePath), '/');

        return caaft_versioned_asset_url('/' . $relativePath);
    }
}
