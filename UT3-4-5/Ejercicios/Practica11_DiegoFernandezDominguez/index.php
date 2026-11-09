<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/src/functions.php');

define("PISTAS", ["Pádel 1","Pádel 2","Tenis","Baloncesto"]);

$array_datos = getArrayFromCSV(__DIR__.'/data_source/reservas.csv');

$filtros  = getFilters();

if ($filtros["fecha"] !== NULL && $filtros["pista"] !== NULL){
    $array_datos = getDataFiltered($array_datos,$filtros);
}

$markup_datos = getMarkupsFromArrayWithData($array_datos);

include(__DIR__.'/templates/index.tpl.php');

?>