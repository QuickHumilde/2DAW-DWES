<?php

require_once(__DIR__ . '/src/functions.php');

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    $user = buscarUsuarioPorNombre($nombre);

    if ($user && password_verify($contrasena, $user['password'])) {

        iniciarSesionUsuario($user);

        header('Location: cuestionario.php');
        exit();

    } else {

        $error = 'Nombre o contraseña incorrectos.';

    }
}

include(__DIR__ . '/src/templates/login.tpl.php');

?>