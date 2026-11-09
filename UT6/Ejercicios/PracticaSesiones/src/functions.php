<?php

function dump($var){
    echo '<pre>'; var_dump($var); echo '</pre>';
}

function getDataFromForm(){
    $nombre = filter_input(INPUT_POST, "nombre_usuario");
    $contraseña = filter_input(INPUT_POST, "contraseña");
    $contraseña_confirmacion = filter_input(INPUT_POST, "contraseña_confirmacion");
    $email = filter_input(INPUT_POST, "email");
    $boton = filter_input(INPUT_POST, "boton_enviar");

    return [
        "nombre_usuario" => $nombre,
        "contraseña" => $contraseña,
        "email" => $email,
        "boton_enviar" =>  $boton,
        "contraseña_confirmacion" => $contraseña_confirmacion,
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
    if(strlen($contraseña) <= 8){
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