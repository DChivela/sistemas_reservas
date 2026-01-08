<?php

function gerarCodigoReserva(PDO $pdo): string {
    $data = date('Ymd');

    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM reservas 
        WHERE DATE(created_at) = CURDATE()
    ");
    $stmt->execute();

    $seq = $stmt->fetchColumn() + 1;

    return 'RE' . $data . str_pad($seq, 3, '0', STR_PAD_LEFT);
}
function calcularTotalReserva(PDO $pdo, int $reservaId): float {
    $stmt = $pdo->prepare("
        SELECT SUM(preco) as total 
        FROM itens_reserva 
        WHERE reserva_id = :reservaId
    ");
    $stmt->execute(['reservaId' => $reservaId]);

    return (float) $stmt->fetchColumn();
}