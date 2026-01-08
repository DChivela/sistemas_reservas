<?php
session_start();
require 'helpers/auth.php';
requireLogin();

$pdo = require 'config/database.php';
require 'app/controllers/ReservaController.php';

$controller = new ReservaController($pdo);
$reservas = $controller->minhasReservas($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Minhas Reservas</title>
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/layout.css">
    <link rel="stylesheet" href="public/assets/css/table.css">
</head>
<body>

<header>
    <div class="container nav">
        <div class="logo">Reservas+</div>
        <nav>
            <a href="index.php">Início</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</header>

<main class="container" style="margin-top:2rem">
    <h2>Minhas Reservas</h2>

    <?php if (!$reservas): ?>
        <p>Sem reservas registadas.</p>
    <?php else: ?>
    <table class="table">
        <tr>
            <th>Código</th>
            <th>Estabelecimento</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Estado</th>
        </tr>

        <?php foreach ($reservas as $r): ?>
        <tr>
            <td><?= $r['codigo_reserva'] ?></td>
            <td><?= htmlspecialchars($r['estabelecimento']) ?></td>
            <td><?= $r['data_reserva'] ?></td>
            <td><?= $r['hora_inicio'] ?> - <?= $r['hora_fim'] ?></td>
            <td>
                <span class="badge <?= $r['estado'] ?>">
                    <?= ucfirst($r['estado']) ?>
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</main>

</body>
</html>
