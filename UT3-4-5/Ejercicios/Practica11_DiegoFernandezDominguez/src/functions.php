<?php

function dump($var){
    echo '<pre>'; var_dump($var); echo '</pre>';
}

function getArrayFromCSV($rutaCSV){

    $contenidoArchivo = file_get_contents($rutaCSV);
    $contenidoArchivo = trim($contenidoArchivo);
    $lineasCSV =explode("\n",$contenidoArchivo);
    $encabezadoCadena = reset($lineasCSV);
    $encabezadoArray = explode(',', $encabezadoCadena);
    $encabezadoArrayNuevo = array_map('trim',$encabezadoArray);

    $arrayResultados = [];

    foreach($lineasCSV as $clave => $linea){
        if($clave != 0){
          $camposLinea = explode(',', $linea);
          $elemento = array_combine($encabezadoArrayNuevo,$camposLinea);
          $arrayResultados[] = $elemento;
        }
    }

    return $arrayResultados;
}

function getMarkupsFromArrayWithData(array $data) {
    $output = '<table>';
    $output .= '<thead>';
    $output .= '<td>ID</td>';
    $output .= '<td>Nombre</td>';
    $output .= '<td>Email</td>';
    $output .= '<td>Pista</td>';
    $output .= '<td>Fecha</td>';
    $output .= '<td>Hora</td>';
    $output .= '<td>Material</td>';
    $output .= '</thead>';

    foreach($data as $clave => $valor) { 
        $output .= '<tr>';
        $output .= '<td>'.$valor['id'].'</td>';
        $output .= '<td>'.$valor['nombre'].'</td>';
        $output .= '<td>'.$valor['email'].'</td>';
        $output .= '<td>'.$valor['pista'].'</td>';
        $output .= '<td>'.$valor['fecha'].'</td>';
        $output .= '<td>'.$valor['hora'].'</td>';
        $output .= '<td>'.$valor['material'].'</td>';
        $output .= '</tr>';
    }
    $output .= '<table>';

    return $output;

}

function getDataFiltered($array_datos, $filtros){
    $arrayResultados = [];
  
    foreach ($array_datos as $dato) {
        if (
            $dato['fecha'] == $filtros['fecha'] &&
            $dato['pista'] == $filtros['pista']
        ) {
            $arrayResultados[] = $dato;
        }
    }

    return $arrayResultados;
}

function getFilters(){

    $fecha = filter_input(INPUT_GET,'fecha');
    $pista = filter_input(INPUT_GET,'pista');

    return ["fecha"=>$fecha, "pista"=>$pista];

}

?>