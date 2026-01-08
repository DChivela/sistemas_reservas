<?php

require_once __DIR__ . '/../models/User.php';

class AuthController {
    private User $user;

    public function __construct(PDO $pdo) {
        $this->user = new User($pdo);
    }

    public function login(string $email, string $password): bool {
        $user = $this->user->findByEmail($email);

        if (!$user) return false;

        if (!password_verify($password, $user['Password'])) { // Escrevi (eu Domingos kkk) a palavra com o P maiúsculo
            //porque o PHP é uma linguagem case sensitive, por isso é que ficou 'Password'
            return false;
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id'    => $user['id'],
            'nome'  => $user['nome'],
            'email' => $user['email'],
            'tipo'  => $user['tipo']
        ];

        return true;
    }

    public function logout() {
        session_destroy();
        header('Location: ../login.php');
        exit;
    }
}
