<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/src/functions.php');
define('PISTAS', ['Pádel 1', 'Pádel 2', 'Tenis', 'Baloncesto']);

$data = getCSVData(__DIR__.'/src/data_source/reservas.csv');

$filtros = getFiltersFromQueryString();

if(isset($filtros['fecha']) && isset($filtros['pista']) && empty($filtros['fecha']) && empty(isset($filtros['pista']))) {
    $filtros = validateFilters($filtros);
}

if($filtros['fecha']!==NULL && $filtros['pista']!==NULL) {
    $data = getDataFiltered($data, $filtros);
}

include(__DIR__.'/src/templates/index.tpl.php');

?>