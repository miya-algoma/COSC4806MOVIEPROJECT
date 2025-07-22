<?php
session_start();  // Start the session once here

require_once __DIR__ . '/../config/database.php';  // Load your DB connection

// Get current URL path (without query string)
$url = $_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);

// Routing logic
if ($path === '/') {
    require __DIR__ . '/../app/controllers/home.php';
    $controller = new Home();
    $controller->index();

} else if (preg_match('#^/movies(?:/([a-zA-Z0-9]+))?$#', $path, $matches)) {

    require __DIR__ . '/../app/controllers/movies.php';
    $controller = new Movies();

    if (isset($matches[1])) {
        $controller->show($matches[1]);
    } else {
        $controller->index();
    }

} else if ($path === '/movies/rate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/../app/controllers/movies.php';
    $controller = new Movies();
    $controller->rate();

} else if (strpos($path, '/account') === 0) {
    require __DIR__ . '/../app/controllers/account.php';
    $controller = new Account();

    if ($path === '/account/login') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->loginForm();
        }

    } else if ($path === '/account/logout') {
        $controller->logout();

    } else if ($path === '/account/edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->edit();
        } else {
            $controller->editForm();
        }

    } else if ($path === '/account/register') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->registerForm();
        }

    } else {
        $controller->profile();
    }

} else {
    // 404 fallback
    http_response_code(404);
    echo "Page not found.";
}
