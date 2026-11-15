<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/src/functions.php');

session_start();

if (estaLogueado()) {
    header('Location: bienvenida.php');
    exit();
}

$errores = [];

$datos = getDataFromForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($datos['boton_enviar']) && $datos['boton_enviar'] === "boton_enviar") {

    $errores = validateDatos($datos);

    if (empty($errores)) {
        try {
            registerUser($datos);
        } catch (PDOException $e) {
            
            if ($e->getCode() === '23000') {
                $errores['email'] = "Ese email ya está registrado";
            } else {
                throw $e;
            }
        }

        if (empty($errores)) {
            setFlash('Registro completado. Ya puedes iniciar sesión.');
            header("Location: login.php");
            exit();
        }
    }

}

include(__DIR__ . '/src/templates/register.tpl.php');
