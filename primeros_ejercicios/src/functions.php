<?php

function dump($var){
  echo '<pre>'.print_r($var,1).'</pre>';
}

function getCSVContentInArray(String $rutaCSV, String $nombreClave){

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
          $arrayResultados[trim($elemento[$nombreClave])] = $elemento;
        }
    }

    return $arrayResultados;
}

function getCochesMarkupFromData(array $data){
  $output = '';
   
  $output .= '<ul>'; 
  
  foreach($data as $clave => $valor){
    $output.='<li>';
    $output.=$valor['MATRICULA'];
    $output.='</li>';
  }

  $output .= '</ul>'; 
  
  return $output;
}

function getImagenCoche($coche)
{
    if (trim($coche["IMAGEN"]) !== "null") {
        return trim($coche["IMAGEN"]);
    }

    return "https://img.magnific.com/vector-premium/silueta-negra-automovil_606479-557.jpg?semt=ais_hybrid&w=740&q=80";
}

function getCochesMarkup($coches)
{
    $output = '<ul>';
    
    foreach ($coches as $coche) {
        $output .= getCocheMarkup($coche);
    }

    $output .= '</ul>';
    return $output;
}

function getCocheMarkup($coche)
{
    $imagen = getImagenCoche($coche);

    $output = '';
    $output .= '<li>';
    $output .= '<p>';
    $output .= $coche["MARCA"] . ' ' . $coche["MODELO"];
    $output .= '</p>';

    $output .= '<img ';
    $output .= 'src="' . $imagen . '" ';
    $output .= 'alt="' . $coche["MODELO"] . '" ';
    $output .= 'width="300" ';
    $output .= 'height="150"';
    $output .= '>';

    $output .= '</li>';

    return $output;
}
