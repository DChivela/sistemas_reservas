<?php
session_start();
require '../helpers/auth.php';
requireAdmin();
?>
<p>Bem-vindo ao painel administrativo.</p>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin' ?></title>
    <link rel="stylesheet" href="/public/assets/css/base.css">
    <link rel="stylesheet" href="/public/assets/css/admin.css">
    <link rel="stylesheet" href="/public/assets/css/table.css">
</head>

<body>

<div class="admin-layout">

    <aside class="admin-sidebar">
        <h2>Reservas+</h2>
        <a href="/admin/dashboard.php">Dashboard</a>
        <a href="/admin/reservas/index.php">Reservas</a>
        <a href="/admin/estabelecimentos/index.php">Estabelecimentos</a>
        <a href="/admin/users/index.php">Utilizadores</a>
        <a href="../../logout.php">Logout</a>
    </aside>

    <main class="admin-content">
        <div class="admin-header">
            <h1><?= $title ?? '' ?></h1>
            <div class="admin-user">
                <?= $_SESSION['user']['Nome'] ?>
            </div>
        </div>

        <?= $content ?>
    </main>

</div>

</body>

</html>