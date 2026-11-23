<?php
/* ***** INICIALIZACIÓN DEL ENTORNO ***** */
require_once __DIR__ . '/lib/init.php';

/* ***** LÓGICA DE NEGOCIO ***** */
exigirInvitado();

$datos   = ['nombre' => '', 'email' => ''];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre'     => trim($_POST['nombre'] ?? ''),
        'email'      => trim($_POST['email'] ?? ''),
        'contrasena' => $_POST['contrasena'] ?? '',
        'repetir'    => $_POST['repetir'] ?? '',
    ];

    $pdo     = conectar();
    $errores = validarRegistro($pdo, $datos);

    if (!$errores) {
        if (crearUsuario($pdo, $datos['nombre'], $datos['email'], $datos['contrasena'])) {
            guardarFlash('Registro completado. Ya puedes iniciar sesión.');
            redirigir('login.php');                       // PRG
        }
        $errores['email'] = 'Ya hay una cuenta con ese email.';
    }
}

/* ***** LÓGICA DE PRESENTACIÓN ***** */
$titulo = 'Crear cuenta';
require __DIR__ . '/templates/registro.tpl.php';
