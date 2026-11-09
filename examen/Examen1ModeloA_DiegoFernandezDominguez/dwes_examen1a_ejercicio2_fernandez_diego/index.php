<?php

//Startup errors (dev mode)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/src/functions.php');

$conexion = getDatabaseConnection(
    "mysql:host=localhost;dbname=dwes_examen1",
    /*"root",
    ""*/
    "dwes_examen1",
    "dwes_examen1"
);

$filtros = obtenerFiltros();

$videoGamesShops = getVideoGamesFromDB($conexion);
switch ($filtros) {
    case $filtros[0] === 'lista_tiendas' && $filtros[1]==='':
        break;

    case $filtros[0] === 'borrar_tienda' && $filtros[1]>0:
        borrarTienda($conexion, $filtros[1]);
        $filtros[0] ="lista_tiendas";
        $filtros[1] =-1;

        header(__DIR__);
        break;
    
    case $filtros[0] === 'actualizar_stock' && $filtros[1]>0:
        actualizarStock($conexion, $filtros);

        $filtros[0] ="lista_tiendas";
        $filtros[1] =-1;

        header(__DIR__);
        break;
    
    default:
        break;
}

//removeDuplicationFromArray($videoGamesShops);

include(__DIR__.'/src/templates/index.tpl.php');