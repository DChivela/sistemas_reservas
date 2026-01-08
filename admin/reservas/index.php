<?php
$pdo = require '../../config/database.php';
require '../../app/models/Reserva.php';

$model = new Reserva($pdo);
$reservas = $model->all();
?>

<h2>Reservas</h2>

<table border="1">
    <tr>
        <th>Código</th>
        <th>Estabelecimento</th>
        <th>Data</th>
        <th>Hora</th>
        <th>Estado</th>
    </tr>

<?php foreach ($reservas as $r): ?>
<tr>
    <td><?= htmlspecialchars($r['codigo_reserva']) ?></td>
    <td><?= htmlspecialchars($r['nome']) ?></td>
    <td><?= $r['data_reserva'] ?></td>
    <td><?= $r['hora_inicio'] ?> - <?= $r['hora_fim'] ?></td>
    <td><?= $r['estado'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php
$title = 'Estabelecimentos';
$content = ob_get_clean();
require '../layout.php';