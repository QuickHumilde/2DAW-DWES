<?php

function dump($var){
    echo '<pre>'; var_dump($var); echo '</pre>';
}

function conectar(){
    $DB_DSN  = 'mysql:host=localhost;dbname=login_dwes;charset=utf8mb4';
    $DB_USER = 'login_dwes';
    $DB_PASS = 'Login2026.';

    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}

function getDataFromForm(){

    $nombre = filter_input(INPUT_POST, "nombre_usuario");
    $contraseña = filter_input(INPUT_POST, "contraseña");
    $contraseña_confirmacion = filter_input(INPUT_POST, "contraseña_confirmacion");
    $email = filter_input(INPUT_POST, "email");
    $boton = filter_input(INPUT_POST, "boton_enviar");

    return [
        "nombre_usuario" => trim($nombre ?? ''),
        "contraseña" => trim($contraseña ?? ''),
        "email" => trim($email ?? ''),
        "boton_enviar" => $boton,
        "contraseña_confirmacion" => trim($contraseña_confirmacion ?? ''),
    ];
}

function validateDatos($datos){

    $errores = [];

    $errorPassword = _validatePassword($datos["contraseña"],$datos["contraseña_confirmacion"]);

    if($errorPassword !== true){
        $errores["contraseña"] = $errorPassword;
    }

    $errorEmail = _validateEmail($datos["email"]);

    if($errorEmail !== true){
        $errores["email"] = $errorEmail;
    }

    return $errores;
}
function _validatePassword($contraseña, $contraseña_confirmacion){
    if(strlen($contraseña) < 8){
        return "La contraseña debe de tener mas de 7 caracteres";
    }

    if($contraseña !== $contraseña_confirmacion){
        return "Ambas contraseñas deben coincidir";
    }

    return true;
}

function _validateEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "El email enviado es incorrecto";
    }

    return true;
}

function registerUser($datos){

}