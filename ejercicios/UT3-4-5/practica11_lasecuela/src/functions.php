<?php

function dump($var){
    echo '<pre>'; var_dump($var); echo'<pre>';
}

function getCSVData($path){
    $data = [];
    if (($filehandler = fopen($path, "r")) !== false) {
        $cabeceras = fgetcsv($filehandler);

        while (($fields = fgetcsv($filehandler)) !== false) {
            $data[]= array_combine($cabeceras,$fields);
        }
    
        fclose($filehandler);
        return $data;
    }
    return null;

}

function getFiltersFromQueryString(){
    $pista = filter_input(INPUT_GET, 'pista');
    $fecha = filter_input(INPUT_GET, 'fecha');

    return ["pista"=>$pista, "fecha"=>$fecha];
}

function validateFilters($filtros){
    if(!in_array($filtros['pista'], PISTAS)){
        $filtros['pista']=NULL;
    }

        list($anio, $mes, $dia) = explode("-", $filtros['fecha']);
        if(!checkdate($mes, $dia, $anio)){
            $filtros['fecha']=NULL;
    }

    return $filtros;
}

function getDataFiltered($data, $filtros){
    $array_filtrado = [];

    foreach($data as $valor){
        if ($valor['fecha']==$filtros['fecha'] 
        && $valor['pista']==$filtros['pista'])
        {
           $array_filtrado[] = $valor;
        };
    }

    return $array_filtrado;
}