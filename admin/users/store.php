<?php
$pdo = require '../../config/database.php';
require '../../app/models/User.php';

$model = new User($pdo);
$model->create($_POST);

header('Location: index.php');
