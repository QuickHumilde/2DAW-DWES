<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/src/functions.php');

$conexion = conectar([
    'dns' => 'mysql:dbname=biblioteca;host=localhost', 
    'username' => 'root', 
    'password' => '',
]);

$numDisponibles = contarDisponibles($conexion);

include(__DIR__.'/template/index.tpl.php');