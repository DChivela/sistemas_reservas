<?php
session_start();
$pdo = require 'config/database.php';
require 'app/controllers/AuthController.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController($pdo);

    if ($auth->login($_POST['email'], $_POST['password'])) {
        $destino = $_SESSION['user']['tipo'] === 'admin'
            ? 'admin/dashboard.php'
            : 'index.php';

        header("Location: $destino");
        exit;
    } else {
        $error = 'Credenciais inválidas';
    }
}
?>

<?php
$error = $error ?? null;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/auth.css">
</head>
<body>

<div class="auth-container">
    <form method="post" class="auth-card">
        <h2>Entrar</h2>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>

        <a href="index.php" class="back">← Voltar</a>
    </form>
</div>

</body>
</html>


