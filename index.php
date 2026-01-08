<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas</title>
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/layout.css">
    <link rel="stylesheet" href="public/assets/css/home.css">
</head>
<body>

<header>
    <div class="container nav">
        <div class="logo">Reservas+</div>
        <nav>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="minhas-reservas.php">Minhas Reservas</a>
                <a href="admin/users/create.php">Painel</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="container hero-content">
        <h1>Reserve com simplicidade</h1>
        <p>Hotéis e restaurantes num único sistema moderno e rápido.</p>

        <a href="reservar.php" class="btn-primary">Fazer Reserva</a>
    </div>
</section>

<footer>
    © <?= date('Y') ?> Reservas+ DCA · Todos os direitos reservados
</footer>

</body>
</html>
