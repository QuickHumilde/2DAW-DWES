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
        "contraseña" => $contraseña ?? '',
        "email" => trim($email ?? ''),
        "boton_enviar" => $boton,
        "contraseña_confirmacion" => $contraseña_confirmacion ?? '',
    ];
}

function validateDatos($datos){

    $errores = [];

    if($datos["nombre_usuario"] === ''){
        $errores["nombre_usuario"] = "El nombre es obligatorio";
    }

    $errorPassword = _validatePassword($datos["contraseña"],$datos["contraseña_confirmacion"]);

    if($errorPassword !== true){
        $errores["contraseña"] = $errorPassword;
    }

    $errorEmail = _validateEmail($datos["email"]);

    if($errorEmail !== true){
        $errores["email"] = $errorEmail;
    } elseif(emailExiste($datos["email"])){
        $errores["email"] = "Ese email ya está registrado";
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

function emailExiste($email){
    $stmt = conectar()->prepare('SELECT 1 FROM usuarios WHERE email = :email');
    $stmt->execute([':email' => $email]);
    return $stmt->fetchColumn() !== false;
}

function registerUser($datos){
    $stmt = conectar()->prepare(
        'INSERT INTO usuarios (email, nombre, contrasena) VALUES (:email, :nombre, :contrasena)'
    );
    $stmt->execute([
        ':email'      => $datos['email'],
        ':nombre'     => $datos['nombre_usuario'],
        ':contrasena' => password_hash($datos['contraseña'], PASSWORD_DEFAULT),
    ]);
}

function buscarUsuarioPorEmail($email){
    $stmt = conectar()->prepare('SELECT id, nombre, contrasena FROM usuarios WHERE email = :email');
    $stmt->execute([':email' => $email]);
    return $stmt->fetch();   // false si no existe
}

function estaLogueado(){
    return isset($_SESSION['usuario_id']);
}

function iniciarSesionUsuario($usuario){
    session_regenerate_id(true); 
    $_SESSION['usuario_id']     = $usuario['id'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];
}

function cerrarSesion(){
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

function setFlash($mensaje){
    $_SESSION['flash'] = $mensaje;
}

function getFlash(){
    $mensaje = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $mensaje;
}
