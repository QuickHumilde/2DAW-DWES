<?php
/* ***** FUNCIONES DE APOYO ***** */

/** Escapa un texto para mostrarlo en HTML. */
function e(?string $texto): string
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

/** Redirige y termina el script. */
function redirigir(string $url): never
{
    header('Location: ' . $url);
    exit;
}

/* ***** MENSAJES FLASH ***** */

function guardarFlash(string $mensaje): void
{
    $_SESSION['flash'] = $mensaje;
}

/** Devuelve el mensaje pendiente (o null) y lo borra para que salga una sola vez. */
function leerFlash(): ?string
{
    $mensaje = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $mensaje;
}

/* ***** CONTROL DE ACCESO ***** */

/** Datos del usuario de la sesión (id y nombre) o null si no ha iniciado sesión. */
function usuarioActual(): ?array
{
    return $_SESSION['usuario'] ?? null;
}

/** Para páginas privadas: sin sesión, al login. */
function exigirLogin(): void
{
    if (usuarioActual() === null) {
        redirigir('login.php');
    }
}

/** Para login y registro: con sesión, a la bienvenida. */
function exigirInvitado(): void
{
    if (usuarioActual() !== null) {
        redirigir('bienvenida.php');
    }
}

/* ***** USUARIOS (BASE DE DATOS) ***** */

function buscarUsuarioPorEmail(PDO $pdo, string $email): array|false
{
    $sql = 'SELECT id, nombre, contrasena FROM usuarios WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    return $stmt->fetch();
}

/**
 * Da de alta al usuario. Devuelve false si el email ya existe
 * (lo detecta la restricción UNIQUE, también si dos altas llegan a la vez).
 */
function crearUsuario(PDO $pdo, string $nombre, string $email, string $contrasena): bool
{
    $sql = 'INSERT INTO usuarios (email, nombre, contrasena) VALUES (:email, :nombre, :contrasena)';
    try {
        $pdo->prepare($sql)->execute([
            ':email'      => $email,
            ':nombre'     => $nombre,
            ':contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
        ]);
        return true;
    } catch (PDOException $ex) {
        if (($ex->errorInfo[1] ?? null) === 1062) {   // entrada duplicada
            return false;
        }
        throw $ex;
    }
}

/* ***** REGISTRO ***** */

/** Valida el formulario de registro. Devuelve los errores indexados por campo. */
function validarRegistro(PDO $pdo, array $datos): array
{
    $errores = [];

    if ($datos['nombre'] === '') {
        $errores['nombre'] = 'Escribe tu nombre.';
    } elseif (mb_strlen($datos['nombre']) > 100) {
        $errores['nombre'] = 'El nombre no puede pasar de 100 caracteres.';
    }

    if ($datos['email'] === '') {
        $errores['email'] = 'Escribe tu email.';
    } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($datos['email']) > 100) {
        $errores['email'] = 'El email no es válido.';
    } elseif (buscarUsuarioPorEmail($pdo, $datos['email']) !== false) {
        $errores['email'] = 'Ya hay una cuenta con ese email.';
    }

    if (mb_strlen($datos['contrasena']) < 8) {
        $errores['contrasena'] = 'La contraseña debe tener al menos 8 caracteres.';
    } elseif ($datos['contrasena'] !== $datos['repetir']) {
        $errores['repetir'] = 'Las contraseñas no coinciden.';
    }

    return $errores;
}

/* ***** SESIÓN ***** */

/** Deja al usuario identificado en la sesión. */
function iniciarSesionUsuario(array $usuario): void
{
    session_regenerate_id(true);            // evita la fijación de sesión
    $_SESSION['usuario'] = [
        'id'     => (int) $usuario['id'],
        'nombre' => $usuario['nombre'],     // ni contraseña ni hash
    ];
}

/** Cierra la sesión del todo: datos, cookie y fichero del servidor. */
function cerrarSesion(): void
{
    $_SESSION = [];          // también se va el cuestionario a medias
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    session_destroy();
}
