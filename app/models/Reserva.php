<?php

class Reserva {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function create(array $data): int {
        $sql = "INSERT INTO reservas 
            (codigo_reserva, user_id, estabelecimento_id, data_reserva, hora_inicio, hora_fim, estado)
            VALUES (?, ?, ?, ?, ?, ?, 'pendente')";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['codigo_reserva'],
            $data['user_id'],
            $data['estabelecimento_id'],
            $data['data_reserva'],
            $data['hora_inicio'],
            $data['hora_fim']
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findByCodigo(string $codigo) {
        $stmt = $this->pdo->prepare("
            SELECT r.*, e.nome AS estabelecimento
            FROM reservas r
            JOIN estabelecimentos e ON e.id = r.estabelecimento_id
            WHERE r.codigo_reserva = ?
        ");
        $stmt->execute([$codigo]);
        return $stmt->fetch();
    }

    public function all(): array {
        return $this->pdo->query("
            SELECT r.*, e.nome 
            FROM reservas r
            JOIN estabelecimentos e ON e.id = r.estabelecimento_id
            ORDER BY r.created_at DESC
        ")->fetchAll();
    }

    public function updateEstado(int $id, string $estado): bool {
        $stmt = $this->pdo->prepare("
            UPDATE reservas SET estado = ? WHERE id = ?
        ");
        return $stmt->execute([$estado, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM reservas WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
