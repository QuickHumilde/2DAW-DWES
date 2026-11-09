<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/src/functions.php');

session_start();

$datos = getDataFromForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($datos['boton_enviar']) && $datos['boton_enviar'] === "boton_enviar") {
    
    if (empty($errores)){
        header("Location: login.php");
        exit();
    } else {
        throw new Exception(implode(", ", $errores));    
    }

}

include(__DIR__ . '/src/templates/register.tpl.php');

?>