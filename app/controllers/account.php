<?php
require_once 'config/database.php';

class Account {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function loginForm() {
        require 'app/views/account/login.php';
    }

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['auth'] = ['username' => $user['username'], 'id' => $user['id']];
            header('Location: /account');
            exit;
        } else {
            $error = "Invalid credentials";
            require 'app/views/account/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }

    public function profile() {
        if (!isset($_SESSION['auth'])) {
            header('Location: /account/login');
            exit;
        }
        require 'app/views/account/profile.php';
    }

    public function editForm() {
        if (!isset($_SESSION['auth'])) {
            header('Location: /account/login');
            exit;
        }
        require 'app/views/account/edit.php';
    }

    public function edit() {
        if (!isset($_SESSION['auth'])) {
            header('Location: /account/login');
            exit;
        }

        $name = $_POST['name'] ?? '';
        $userId = $_SESSION['auth']['id'];

        $stmt = $this->db->prepare('UPDATE users SET name = :name WHERE id = :id');
        $stmt->execute(['name' => $name, 'id' => $userId]);

        header('Location: /account');
        exit;
    }
}
