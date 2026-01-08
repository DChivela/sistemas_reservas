<?php
session_start();
require '../app/helpers/auth.php';

requireAdmin();
?>

<?php
$title = 'Dashboard';
ob_start();
?>
<p>Bem-vindo ao painel administrativo.</p>
<?php
$content = ob_get_clean();
require 'layout.php';
