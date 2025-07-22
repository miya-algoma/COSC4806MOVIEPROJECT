<?php
session_start();
require_once 'config/database.php';


$url = $_SERVER['REQUEST_URI'];
if (preg_match('#^/movies(?:/(\d+))?$#', $url, $matches)) {
    require 'app/controllers/movies.php';
    $controller = new Movies();
    if (isset($matches[1])) {
        $controller->show($matches[1]);
    } else {
        $controller->index();
    }
} else if ($url === '/movies/rate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'app/controllers/movies.php';
    $controller = new Movies();
    $controller->rate();
} else {
    echo "Page not found.";
}
