<?php
$pdo = require '../../config/database.php';
require '../../app/models/Estabelecimento.php';

$model = new Estabelecimento($pdo);
$estabelecimentos = $model->all();
?>

<h2>Estabelecimentos</h2>
<a href="create.php">Novo</a>

<table border="1">
<tr>
    <th>Nome</th>
    <th>Tipo</th>
    <th>Email</th>
    <th>Ações</th>
</tr>

<?php foreach ($estabelecimentos as $e): ?>
<tr>
    <td><?= htmlspecialchars($e['nome']) ?></td>
    <td><?= $e['tipo'] ?></td>
    <td><?= $e['email'] ?></td>
    <td>
        <a href="edit.php?id=<?= $e['id'] ?>">Editar</a>
        <a href="delete.php?id=<?= $e['id'] ?>" onclick="return confirm('Eliminar?')">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
