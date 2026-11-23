<?php
/* ***** INICIALIZACIÓN DEL ENTORNO ***** */
require_once __DIR__ . '/lib/init.php';

/* ***** LÓGICA DE NEGOCIO ***** */
exigirInvitado();

$email = '';
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email      = trim($_POST['email'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    $usuario = buscarUsuarioPorEmail(conectar(), $email);

    if ($usuario !== false && password_verify($contrasena, $usuario['contrasena'])) {
        iniciarSesionUsuario($usuario);
        redirigir('bienvenida.php');
    }

    // El mismo mensaje tanto si el email no existe como si falla la contraseña
    $error = 'Email o contraseña incorrectos.';
}

/* ***** LÓGICA DE PRESENTACIÓN ***** */
$titulo = 'Iniciar sesión';
$flash  = leerFlash();
require __DIR__ . '/templates/login.tpl.php';
