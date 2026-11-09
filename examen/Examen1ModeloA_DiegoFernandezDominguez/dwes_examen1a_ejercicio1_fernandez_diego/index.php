<?php

//Startup errors (dev mode)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/src/functions.php');

$conexion = getDatabaseConnection(
    "mysql:host=localhost;dbname=dwes_examen1",
    "root",
    ""
    /*"dwes_examen1",
    "dwes_examen1"*/
);

//Script principal
$videoGamesShops = getVideoGamesFromDB($conexion);

removeDuplicationFromArray($videoGamesShops);

include(__DIR__.'/src/templates/index.tpl.php');