<?php

class Estabelecimento {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO estabelecimentos (nome, tipo, email)
            VALUES (?, ?, ?)
        ");

        return $stmt->execute([
            $data['nome'],
            $data['tipo'],
            $data['email']
        ]);
    }

    public function all(): array {
        return $this->pdo->query("
            SELECT * FROM estabelecimentos ORDER BY nome
        ")->fetchAll();
    }

    public function find(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM estabelecimentos WHERE ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare("
            UPDATE estabelecimentos 
            SET nome = ?, tipo = ?, email = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $data['nome'],
            $data['tipo'],
            $data['email'],
            $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM estabelecimentos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
