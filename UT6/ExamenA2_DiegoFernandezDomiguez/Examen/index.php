<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once(__DIR__."/lib/funciones.php");

session_start();

if (!isset($_SESSION["tablero"])){
    $tablero = array();
    for ($i=1; $i < FILAS+1; $i++) { 
        for ($j=1; $j < COLUMNAS+1; $j++) { 
            $tablero[$i][$j] = "";
        }
    }
    $_SESSION["tablero"] = $tablero;
} else {
    $tablero = $_SESSION["tablero"];
}

if (!isset($_SESSION["historial"])){
    $_SESSION["historial"]= array();
} 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = $_POST;

    $errores = verificarDatos($datos);

        switch ($datos["accion"]) {
            case 'colocar':
                if (empty($errores)){ 
                    $tablero[$datos["fila"]][$datos["columna"]] = "t-".$datos["tile"];
                    $_SESSION["historial"][] = $_SESSION["tablero"];
                    $_SESSION["tablero"] = $tablero;
                    $_SESSION["good_flash"] = "Se ha colocado la casilla correctamente";
                } else {
                    $_SESSION["error_flash"] = "No se pudo colocar la casilla";
                }
                break;
            
            case 'quitar':
                dump($errores);
                if (empty($errores["fila"]) && empty($errores["columna"])){ 
                    $tablero[$datos["fila"]][$datos["columna"]] = "";
                    $_SESSION["historial"][] = $_SESSION["tablero"];
                    $_SESSION["tablero"] = $tablero;
                    $_SESSION["good_flash"] = "Se ha quitado la casilla correctamente";
                } else {
                    $_SESSION["error_flash"] = "No se pudo quitar la casilla";
                }
                break;
            
            case 'reiniciar':
                for ($i=1; $i < FILAS+1; $i++) { 
                    for ($j=1; $j < COLUMNAS+1; $j++) { 
                        $tablero[$i][$j] = "";
                    }
                }
                unset($_SESSION["historial"]);
                $_SESSION["tablero"] = $tablero;
            
                break;

            case 'deshacer':
                unset($_SESSION["historial"][sizeof($_SESSION["historial"])]);
                $ultimoTablero = array_pop($_SESSION["historial"]);
                $_SESSION["tablero"]= $ultimoTablero;
            
                break;
    
            
            default:
                # code...
                break;
        }
    }

    $totalTiles = contarTiles($_SESSION["tablero"]);

require_once(__DIR__."/templates/index.tpl.php");

?>