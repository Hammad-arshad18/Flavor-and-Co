<?php
declare(strict_types=1);

/** Escape output. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Current clean route, e.g. "./", "about", "services". */
function current_route(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
    $path = trim($path, '/');
    $path = preg_replace('/\.php$/', '', $path) ?? '';

    return $path === '' || $path === 'index' ? './' : $path;
}

/**
 * Inline SVG icons (24px, 1.5 stroke, consistent family).
 * Decorative by default; pass a title when the icon carries meaning alone.
 */
function icon(string $name, int $size = 24, string $class = ''): string
{
    $paths = [
        'arrow-right' => '<path d="M4 12h15"/><path d="m13 6 6 6-6 6"/>',
        'arrow-up-right' => '<path d="M7 17 17 7"/><path d="M8 7h9v9"/>',
        'phone' => '<path d="M6.6 3.5h-2A1.6 1.6 0 0 0 3 5.2c0 8.6 7.2 15.8 15.8 15.8a1.6 1.6 0 0 0 1.7-1.6v-2a1.5 1.5 0 0 0-1.2-1.5l-2.6-.6a1.5 1.5 0 0 0-1.5.6l-.8 1.1a13 13 0 0 1-5.4-5.4l1.1-.8a1.5 1.5 0 0 0 .6-1.5L9.8 4.7a1.5 1.5 0 0 0-1.4-1.2Z"/>',
        'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6.5 8.5 6 8.5-6"/>',
        'pin' => '<path d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z"/><circle cx="12" cy="10" r="2.6"/>',
        'check' => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
        'menu' => '<path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/>',
        'close' => '<path d="m6 6 12 12"/><path d="m18 6-12 12"/>',
        'sliders' => '<path d="M4 7h9"/><path d="M17 7h3"/><circle cx="15" cy="7" r="2"/><path d="M4 17h3"/><path d="M11 17h9"/><circle cx="9" cy="17" r="2"/>',
        'book' => '<path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v15.5H6.5A2.5 2.5 0 0 0 4 21V5.5Z"/><path d="M4 18.5A2.5 2.5 0 0 1 6.5 16H20"/>',
        'flame' => '<path d="M12 3c3.5 4 6 6.3 6 10a6 6 0 0 1-12 0c0-2.2 1.1-3.9 2.5-5.5.4 1.8 1.2 2.8 2.3 3.2C11.4 8.6 11.6 6 12 3Z"/>',
        'users' => '<circle cx="9" cy="8" r="3.2"/><path d="M3.5 20a5.5 5.5 0 0 1 11 0"/><path d="M16 5.2a3 3 0 0 1 0 5.6"/><path d="M17.5 14.4a5 5 0 0 1 3 4.6"/>',
        'sparkle' => '<path d="M12 3.5c.6 4.2 2.3 5.9 6.5 6.5-4.2.6-5.9 2.3-6.5 6.5-.6-4.2-2.3-5.9-6.5-6.5 4.2-.6 5.9-2.3 6.5-6.5Z"/><path d="M18.5 16.5c.2 1.5.8 2.1 2.3 2.3-1.5.2-2.1.8-2.3 2.3-.2-1.5-.8-2.1-2.3-2.3 1.5-.2 2.1-.8 2.3-2.3Z"/>',
        'chart' => '<path d="M4 19V5"/><path d="M4 19h16"/><path d="m7.5 15 3.5-4 3 2.5 4.5-6"/>',
    ];

    $body = $paths[$name] ?? $paths['sparkle'];

    return '<svg class="icon ' . e($class) . '" width="' . $size . '" height="' . $size
        . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"'
        . ' stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
        . $body . '</svg>';
}

/** Find a service by its slug. */
function service(string $slug): array
{
    foreach (SERVICES as $item) {
        if ($item['slug'] === $slug) {
            return $item;
        }
    }
    return SERVICES[0];
}
