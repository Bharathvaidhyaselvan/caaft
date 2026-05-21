<?php
/**
 * URL helpers for CAAFT components (works with <base href="/"> in header-top.php).
 */
declare(strict_types=1);

/** Contact page form anchor (id="contact_us" on contact.php). */
function caaft_contact_form_url(): string
{
    return '/contact#contact_us';
}

/**
 * Same-page fragment link; required because bare #id resolves to site root with <base href="/">.
 */
function caaft_same_page_anchor(string $fragment = 'quote-content'): string
{
    $fragment = ltrim(trim($fragment), '#');
    if ($fragment === '') {
        $fragment = 'quote-content';
    }

    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = strtok((string) $uri, '?') ?: '/';
    if ($path === '' || $path[0] !== '/') {
        $path = '/' . ltrim($path, '/');
    }

    return $path . '#' . $fragment;
}

/**
 * Bottom CTA / in-page scroll targets (#quote-content, etc.).
 */
function caaft_resolve_page_anchor_href(string $href): string
{
    $href = trim($href);
    if ($href === '' || $href === '#quote-content') {
        return caaft_same_page_anchor('quote-content');
    }

    if ($href[0] === '#' && strpos($href, '//') === false) {
        return caaft_same_page_anchor(substr($href, 1));
    }

    return $href;
}

/**
 * Hero primary CTA: contact page + form (not same-page #quote-content).
 */
function caaft_normalize_hero_contact_href(string $href): string
{
    $href = trim($href);
    if ($href === '' || $href === '#quote-content') {
        return caaft_contact_form_url();
    }

    if ($href[0] === '#' && strpos($href, '//') === false) {
        return caaft_contact_form_url();
    }

    if (preg_match('#^/contact\.php#i', $href)) {
        $hash = '';
        if (($pos = strpos($href, '#')) !== false) {
            $hash = substr($href, $pos);
        }

        return '/contact' . ($hash !== '' ? $hash : '#contact_us');
    }

    if (preg_match('#^/contact/?$#i', $href) || preg_match('#^/contact\?#i', $href)) {
        return caaft_contact_form_url();
    }

    return $href;
}
