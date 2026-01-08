<?php

require_once __DIR__ . '/../models/Reserva.php';
require_once __DIR__ . '/../../helpers/utils.php';

class ReservaController {

    private Reserva $reserva;
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->reserva = new Reserva($pdo);
    }

    public function store(array $request, int $userId) {
        $this->pdo->beginTransaction();

        try {
            $codigo = gerarCodigoReserva($this->pdo);

            $this->reserva->create([
                'codigo_reserva'      => $codigo,
                'user_id'             => $userId, // vem da sessão
                'estabelecimento_id'  => $request['estabelecimento_id'],
                'data_reserva'        => $request['data_reserva'],
                'hora_inicio'         => $request['hora_inicio'],
                'hora_fim'            => $request['hora_fim'],
            ]);

            $this->pdo->commit();
            return $codigo;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function minhasReservas(int $userId): array {
        $stmt = $this->pdo->prepare("
            SELECT r.*, e.nome AS estabelecimento
            FROM reservas r
            JOIN estabelecimentos e ON e.id = r.estabelecimento_id
            WHERE r.user_id = ?
            ORDER BY r.created_at DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
