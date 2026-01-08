<form method="post" action="store.php">
    <input name="nome" placeholder="Nome" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>

    <select name="tipo">
        <option value="cliente">Cliente</option>
        <option value="admin">Admin</option>
    </select>

    <button>Criar</button>
</form>
