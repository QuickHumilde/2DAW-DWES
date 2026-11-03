<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/src/functions.php');
include(__DIR__.'/src/vars.php');

$conexion = conectar([
    'dns' => 'mysql:dbname=biblioteca;host=localhost',
    'username' => 'root',
    'password' => '',
]);

$filtros = [
    'genero' => ($_GET['genero'] ?? '') !== '' ? $_GET['genero'] : null,
];

$libros = listarLibros($conexion, $filtros['genero']);

$numDisponibles = contarDisponibles($conexion);

include(__DIR__.'/template/index.tpl.php');