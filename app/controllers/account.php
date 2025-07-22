<?php
class Account {
    public function login() {
        // For demo: just show a login form or process login
        require 'app/views/account/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}
