<?php
function db_connect() {
    static $pdo;

    if ($pdo === null) {
        $host = '7rduj.h.filess.io';
        $db = 'COSC4806_steeplabor';
        $user = 'COSC4806_steeplabor';
        $pass = '97c9057c43a24d5c2939a8f0e12c3d84a763ca73';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            exit('Database connection failed: ' . $e->getMessage());
        }
    }

    return $pdo;
}
