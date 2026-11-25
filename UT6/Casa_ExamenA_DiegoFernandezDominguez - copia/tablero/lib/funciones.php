<?php

const TAMANO = 6;
const MAX_HISTORIAL = 5;

const PALETA = [
    'rojo' => 'Rojo',
    'azul' => 'Azul',
    'verde' => 'Verde',
    'amarillo' => 'Amarillo',
    'morado' => 'Morado',
    'naranja' => 'Naranja',
];

function dump($var){
    echo "<pre>"; var_dump($var,1); echo "</pre>";
}

function guardarHistorial($tablero) {
    $_SESSION["historial"][] = $tablero;
    $_SESSION["historial"] = array_slice($_SESSION["historial"], -MAX_HISTORIAL);
}

function getVariablesFromPost() {
    $datos = array(
        'fila' => $_POST["fila"] ?? '',
        'columna' => $_POST["columna"] ?? '',
        'color' => $_POST["color"] ?? '',
        'accion' => $_POST["accion"] ?? '',
    );

    return $datos;
}

function verificarPost($datos) {
    $errores = [];
    $errores["fila"] = "";
    $errores["columna"] = "";
    $errores["color"] = "";
    $errores["accion"] = "";

    if($datos["fila"] > TAMANO || $datos["fila"] < 1 ) {
        $errores["fila"] = "Error Fila";
    }
    
    if($datos["columna"] > TAMANO || $datos["columna"] < 1 ) {
        $errores["columna"] = "Error Columna";
    }

    if(!in_array(ucfirst($datos["color"]),PALETA)) {
        $errores["color"] = "Error Color";
    }

    return $errores;
}

?>