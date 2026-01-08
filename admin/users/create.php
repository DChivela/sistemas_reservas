<?php
$title = 'Novo Utilizador';
ob_start();
?>
<div class="form-card">
    <h2>Novo Utilizador</h2>

    <form method="post" action="store.php">
        <div class="form-group">
            <label>Nome</label>
            <input name="nome" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" required>
        </div>

        <div class="form-group">
            <label>Tipo</label>
            <select name="tipo">
                <option value="cliente">Cliente</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <div class="form-actions">
            <a href="index.php" class="btn secondary">Voltar</a>
            <button class="btn primary">Criar</button>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
require '../layout.php';
