<?php
session_start();
require_once 'config/database.php';

$url = $_SERVER['REQUEST_URI'];

// Clean query string if any, only path part
$path = parse_url($url, PHP_URL_PATH);

// Routes
if ($path === '/') {
    require 'app/controllers/home.php';
    $controller = new Home();
    $controller->index();

} else if (preg_match('#^/movies(?:/(\d+))?$#', $path, $matches)) {
    require 'app/controllers/movies.php';
    $controller = new Movies();

    if (isset($matches[1])) {
        $controller->show($matches[1]);
    } else {
        $controller->index();
    }

} else if ($path === '/movies/rate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'app/controllers/movies.php';
    $controller = new Movies();
    $controller->rate();

} else if (strpos($path, '/account') === 0) {
    require 'app/controllers/account.php';
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

    } else {
        $controller->profile();
    }

} else {
    echo "Page not found.";
}
