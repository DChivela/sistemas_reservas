<?php

class User {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (nome, email, password, tipo)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['nome'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['tipo']
        ]);
    }

    public function findByEmail(string $email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function all(): array {
        return $this->pdo->query("
            SELECT id, nome, email, tipo, created_at 
            FROM users ORDER BY nome
        ")->fetchAll();
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
