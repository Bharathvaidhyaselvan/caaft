<?php
declare(strict_types=1);

if (!function_exists('caaft_rich_copy')) {
    /**
     * Escape body copy, keep strong/em/br, and render safe anchors as internal links.
     */
    function caaft_rich_copy(string $text): string
    {
        $slots = [];
        $index = 0;
        $masked = preg_replace_callback(
            '/<a\b[^>]*>.*?<\/a>|<\/?(?:strong|em)\b[^>]*>|<br\b[^>]*\/?>/is',
            static function (array $match) use (&$slots, &$index): string {
                $key = 'CAAFTSLOT' . $index . 'END';
                $index++;
                $slots[$key] = caaft_rich_copy_piece($match[0]);
                return $key;
            },
            $text
        );
        if (!is_string($masked)) {
            $masked = $text;
        }
        $escaped = htmlspecialchars(strip_tags($masked), ENT_QUOTES, 'UTF-8');

        return strtr($escaped, $slots);
    }
}

if (!function_exists('caaft_rich_copy_piece')) {
    function caaft_rich_copy_piece(string $tag): string
    {
        if (preg_match('/^<br\b[^>]*\/?>$/i', $tag) === 1) {
            return '<br>';
        }
        if (preg_match('/^<(\/?)(strong|em)\b[^>]*>$/i', $tag, $match) === 1) {
            return '<' . $match[1] . strtolower($match[2]) . '>';
        }
        if (preg_match('/^<a\b([^>]*)>(.*)<\/a>$/is', $tag, $match) === 1) {
            $href = caaft_rich_copy_href($match[1]);
            $label = caaft_rich_copy($match[2]);
            if ($href === null) {
                return $label;
            }

            return '<a class="internal-link" href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '">' . $label . '</a>';
        }

        return htmlspecialchars($tag, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('caaft_rich_copy_href')) {
    function caaft_rich_copy_href(string $attributes): ?string
    {
        if (preg_match('/\bhref\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|([^\s"\'=<>`]+))/i', $attributes, $match) !== 1) {
            return null;
        }
        $href = html_entity_decode($match[1] !== '' ? $match[1] : ($match[2] !== '' ? $match[2] : $match[3]), ENT_QUOTES, 'UTF-8');
        $href = trim($href);
        if ($href === '' || preg_match('/[\s"\'<>\\\\]/', $href) === 1) {
            return null;
        }
        if (preg_match('#^(?:/(?!/)|https?://)#i', $href) !== 1) {
            return null;
        }

        return $href;
    }
}
