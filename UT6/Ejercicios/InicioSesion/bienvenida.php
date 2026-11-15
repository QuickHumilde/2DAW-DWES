<?php

require_once(__DIR__ . '/src/functions.php');

session_start();

if (!estaLogueado()) {
    header('Location: login.php');
    exit();
}

header('Cache-Control: no-store');

$nombre = $_SESSION['usuario_nombre'];

include(__DIR__ . '/src/templates/bienvenida.tpl.php');
