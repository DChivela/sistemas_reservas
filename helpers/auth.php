<?php

function auth() {
    return $_SESSION['user'] ?? null;
}

function isAdmin(): bool {
    return isset($_SESSION['user']) && $_SESSION['user']['Tipo'] === 'admin';
}

function requireLogin() {
    if (!auth()) {
        header('Location: login.php');
        exit;
    }
}

function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        http_response_code(403);
        exit('Acesso negado');
    }
}
