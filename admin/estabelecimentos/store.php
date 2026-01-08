<?php
$pdo = require '../../config/database.php';
require '../../app/models/Estabelecimento.php';

$model = new Estabelecimento($pdo);
$model->create($_POST);

header('Location: index.php');
