<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

/* ***** INICIALIZACION DEL ENTORNO ***** */
require_once(__DIR__.'/lib/funciones.php');

session_start();

if(!isset($_SESSION["tablero"])){
    $tablero = array();
    for ($i=0; $i < TAMANO; $i++) {
        for ($j=0; $j < TAMANO; $j++) { 
            $tablero[$i][$j] = "";
        }
    }
} else {
    $tablero = $_SESSION["tablero"];
}


/* ***** LOGICA DE NEGOCIO ***** */

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = getVariablesFromPost();
    $errores = verificarPost($datos);

    if(!empty($errores["accion"])){
        $_SESSION["flash_bad"] = "Accion no valida";
    } else {
        switch ($datos["accion"]) {
            case "pintar":
                if(empty($errores["fila"]) && empty($errores["columna"])&& empty($errores["color"]) && isset($errores["fila"]) && isset($errores["columna"])&& isset($errores["color"])){
                    $tablero[$datos["fila"]-1][$datos["columna"]-1] = $datos["color"];
                    $_SESSION["tablero"] = $tablero;
                    $_SESSION["flash_good"] = "Casilla pintada correctamente";
                } else {
                    $_SESSION["flash_bad"] = "No se ha podido realizar la accion";
                }
                break;

            case "borrar":
                if(empty($errores["fila"]) && empty($errores["columna"]) && isset($errores["fila"]) && isset($errores["columna"])){
                    $tablero[$datos["fila"]-1][$datos["columna"]-1] = "";
                    $_SESSION["tablero"] = $tablero;
                    $_SESSION["flash_good"] = "Casilla eliminada correctamente";
                } else {
                    $_SESSION["flash_bad"] = "No se ha podido realizar la accion";
                }
                break;

            case "reiniciar":
                $tablero = array();
                for ($i=0; $i < TAMANO; $i++) {
                    for ($j=0; $j < TAMANO; $j++) { 
                        $tablero[$i][$j] = "";
                    }
                }
                $_SESSION["tablero"] = $tablero;
                break;
            
            default:
                $_SESSION["flash_bad"] = "Accion no valida";
        }
    }

}


/* ***** LOGICA DE PRESENTACION ***** */

require_once(__DIR__.'/templates/index.tpl.php');


?>