<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/src/functions.php');

session_start();

if (estaLogueado()) {
    header('Location: bienvenida.php');
    exit();
}

$error = null;
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email      = trim($_POST['email'] ?? '');
    $contrasena = $_POST['contraseña'] ?? '';

    $usuario = buscarUsuarioPorEmail($email);

    if ($usuario !== false && password_verify($contrasena, $usuario['contrasena'])) {
        iniciarSesionUsuario($usuario);
        header('Location: bienvenida.php');
        exit();
    }

    // mismo mensaje si falla el email o la contraseña
    $error = 'Email o contraseña incorrectos.';
}

$flash = getFlash();

include(__DIR__ . '/src/templates/login.tpl.php');
