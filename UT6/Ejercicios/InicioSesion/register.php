
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/src/functions.php');

session_start();

$errores = [];

$datos = getDataFromForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($datos['boton_enviar']) && $datos['boton_enviar'] === "boton_enviar") {

    if (empty($datos['nombre_usuario'])) {
        $errores[] = "El nombre es obligatorio";
    }

    $errores = array_merge($errores, validateDatos($datos));

    if (empty($errores)) {
        registerUser($datos);
        header("Location: login.php");
        exit();
    }

}

include(__DIR__ . '/src/templates/register.tpl.php');

?>
