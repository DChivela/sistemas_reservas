<?php

require_once __DIR__ . '/../models/Reserva.php';
require_once __DIR__ . '/../helpers/utils.php';

class ReservaController {

    private Reserva $reserva;
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->reserva = new Reserva($pdo);
    }

    public function store(array $request) {
        $this->pdo->beginTransaction();

        try {
            $codigo = gerarCodigoReserva($this->pdo);

            $id = $this->reserva->create([
                'codigo_reserva'      => $codigo,
                'user_id'             => $request['user_id'],
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

    public function show(string $codigo) {
        return $this->reserva->findByCodigo($codigo);
    }
}
