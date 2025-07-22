<?php
require_once __DIR__ . '/../../config/database.php';

class Account {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function loginForm() {
        require __DIR__ . '/../views/account/login.php';
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
            require __DIR__ . '/../views/account/login.php';
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
        require __DIR__ . '/../views/account/profile.php';
    }

    public function editForm() {
        if (!isset($_SESSION['auth'])) {
            header('Location: /account/login');
            exit;
        }
        require __DIR__ . '/../views/account/edit.php';
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

    public function registerForm() {
        require __DIR__ . '/../views/account/register.php';
    }

    public function register() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm) {
            $error = "Passwords do not match";
            require __DIR__ . '/../views/account/register.php';
            return;
        }

        // Check if username exists
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        if ($stmt->fetch()) {
            $error = "Username already taken";
            require __DIR__ . '/../views/account/register.php';
            return;
        }

        // Insert new user with hashed password
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->execute([
            'username' => $username,
            'password' => $hashed,
        ]);

        // Redirect to login page after registration
        header('Location: /account/login');
        exit;
    }
}
