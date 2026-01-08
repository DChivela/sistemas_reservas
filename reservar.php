<?php
session_start();
require 'helpers/auth.php';
requireLogin();

$pdo = require 'config/database.php';
require 'app/controllers/ReservaController.php';
require 'app/models/Estabelecimento.php';

$estModel = new Estabelecimento($pdo);
$estabelecimentos = $estModel->all();

$controller = new ReservaController($pdo);
$codigo = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $controller->store($_POST, $_SESSION['user']['id']);
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Nova Reserva</title>
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/layout.css">
    <link rel="stylesheet" href="public/assets/css/reserva.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="container" style="margin-top:2rem">
    <div class="form-card">
        <h2>Nova Reserva</h2>

        <?php if ($codigo): ?>
            <div class="alert-success">
                Reserva criada com sucesso.<br>
                <strong>Código:</strong> <?= $codigo ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>Estabelecimento</label>
                <select name="estabelecimento_id" required>
                    <option value="">Selecionar</option>
                    <?php foreach ($estabelecimentos as $e): ?>
                        <option value="<?= $e['id'] ?>">
                            <?= htmlspecialchars($e['nome']) ?> (<?= $e['tipo'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Data</label>
                <input type="date" name="data_reserva" required>
            </div>

            <div class="form-group">
                <label>Hora início</label>
                <input type="time" name="hora_inicio" required>
            </div>

            <div class="form-group">
                <label>Hora fim</label>
                <input type="time" name="hora_fim" required>
            </div>

            <div class="form-actions">
                <a href="index.php" class="btn secondary">Cancelar</a>
                <button class="btn primary">Reservar</button>
            </div>
        </form>
    </div>
</main>

</body>
</html>
