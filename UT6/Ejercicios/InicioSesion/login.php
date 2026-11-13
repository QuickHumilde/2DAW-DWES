<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once(__DIR__ . '/src/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email      = trim($_POST['email'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    

    $error = 'Email o contraseña incorrectos.';
}


include(__DIR__ . '/src/templates/login.tpl.php');

?>