<?php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$full = __DIR__ . '/public' . $requestUri;

if (is_file($full)) {
    return false;
}

$routes = [
    '/' => 'index.php',
];

$targetFile = $routes[$requestUri] ?? null;

if ($targetFile !== null && file_exists(__DIR__ . '/public/' . $targetFile)) {
    require __DIR__ . '/public/' . $targetFile;
} else {

    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>The requested resource ($requestUri) was not found on this server.</p>";
}
