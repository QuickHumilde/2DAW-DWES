<?php

require_once(__DIR__.'/src/functions.php');

session_start();

$conexion = conectar(['dns' => 'mysql:dbname=cuestionario_sesiones_dwes;host=localhost','username' => 'root','password' => '',]);

$cuestionarioCompleto = getPreguntasFromDB($conexion);
$preguntasId = [];

foreach ($cuestionarioCompleto as $pregunta) {
    $preguntasPorId[$pregunta['id']] = $pregunta;
}

if (!isset($_SESSION['cuestionaro'])){
    $ids = array_keys($preguntasPorId);
    shuffle($ids);

    $_SESSION["cuestionario"] = [
        "preguntas" => $ids,
        "indice" => 0,
        "respuestas" => [],
        "flash" => null
    ];

}



include(__DIR__.'/src/templates/cuestionario.tpl.php');

?>