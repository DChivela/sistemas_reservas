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
    <td><?= htmlspecialchars($e['Nome']) ?></td>
    <td><?= $e['Tipo'] ?></td>
    <td><?= $e['Email'] ?></td>
    <td>
        <a href="edit.php?ID=<?= $e['ID'] ?>">Editar</a>
        <a href="delete.php?ID=<?= $e['ID'] ?>" onclick="return confirm('Eliminar?')">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php
$title = 'Estabelecimentos';
$content = ob_get_clean();
require '../layout.php';
