<?php
session_start();
$pdo = require 'config/database.php';
require 'app/controllers/AuthController.php';

$auth = new AuthController($pdo);
$auth->logout();
