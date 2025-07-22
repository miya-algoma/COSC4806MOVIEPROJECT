<?php
function db_connect() {
    static $pdo;

    if ($pdo === null) {
        $host = '7rduj.h.filess.io';
        $port = '3305';  // adjust if necessary
        $db = 'COSC4806_steeplabor';
        $user = 'COSC4806_steeplabor';
        $pass = getenv('DB_PASS'); 
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

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
