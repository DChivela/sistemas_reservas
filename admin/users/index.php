<?php
session_start();

$pdo = require '../../config/database.php';
require '../../app/models/User.php';

$model = new User($pdo);
$users = $model->all();
?>

<h2>Utilizadores</h2>
<a href="create.php">Novo</a>

<table border="1">
<tr>
    <th>Nome</th>
    <th>Email</th>
    <th>Tipo</th>
    <th>Ações</th>
</tr>

<?php foreach ($users as $u): ?>
<tr>
    <td><?= htmlspecialchars($u['nome']) ?></td>
    <td><?= $u['email'] ?></td>
    <td><?= $u['tipo'] ?></td>
    <td>
        <a href="delete.php?id=<?= $u['id'] ?>" onclick="return confirm('Eliminar?')">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
