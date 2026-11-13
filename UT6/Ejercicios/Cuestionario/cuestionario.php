<?php

require_once(__DIR__.'/src/functions.php');

session_start();

$conexion = conectar([
    'dns' => 'mysql:dbname=cuestionario_sesiones_dwes;host=localhost',
    'username' => 'root',
    'password' => '',
]);

$preguntas = getPreguntasFromDB($conexion);
dump($preguntas);

include(__DIR__.'/src/templates/cuestionario.tpl.php');

?>