<?php
declare(strict_types=1);

/**
 * Router for PHP's built-in server:
 *   php -S 127.0.0.1:8080 router.php
 *
 * Serves clean URLs without the .php extension and redirects direct
 * .php requests to their clean equivalent.
 */

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$uri = rawurldecode($uri);
$query = $_SERVER['QUERY_STRING'] ?? '';

// One canonical URL per page: strip trailing slashes (except the home page).
if ($uri !== '/' && substr($uri, -1) === '/') {
    $target = rtrim($uri, '/');
    if ($query !== '') {
        $target .= '?' . $query;
    }
    header('Location: ' . $target, true, 301);
    exit;
}

$uri = rtrim($uri, '/');

if ($uri === '') {
    $uri = '/';
}

// Redirect /page.php to /page so the extension never appears in the browser.
if (preg_match('#^/([a-z0-9-]+)\.php$#i', $uri, $matches)) {
    $name = strtolower($matches[1]);
    if (is_file(__DIR__ . '/' . $name . '.php')) {
        $target = $name === 'index' ? '/' : '/' . $name;
        if ($query !== '') {
            $target .= '?' . $query;
        }
        header('Location: ' . $target, true, 301);
        exit;
    }
}

// Let the built-in server handle real files (CSS, images, fonts).
if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false;
}

// Existing directories: use their index file when present.
if ($uri !== '/' && is_dir(__DIR__ . $uri) && is_file(__DIR__ . $uri . '/index.php')) {
    require __DIR__ . $uri . '/index.php';
    return true;
}

$routes = [
    '/'        => 'index.php',
    '/index'   => 'index.php',
    '/about'   => 'about.php',
    '/services' => 'services.php',
    '/contact' => 'contact.php',
];

if (isset($routes[$uri])) {
    if ($uri === '/index') {
        header('Location: /', true, 301);
        exit;
    }

    require __DIR__ . '/' . $routes[$uri];
    return true;
}

http_response_code(404);
require __DIR__ . '/404.php';
return true;
