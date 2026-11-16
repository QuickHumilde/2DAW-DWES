
<?php

function dump($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function conectar() {
    $DB_DSN  = 'mysql:host=localhost;dbname=cuestionario_sesiones_dwes;charset=utf8mb4';
    $DB_USER = 'root';
    $DB_PASS = '';
    static $pdo = null;

    if ($pdo === null) {
        try {
            $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $e) {
            die('Error al conectar con la base de datos: ' . $e->getMessage());
        }
    }
    return $pdo;
}

function buscarUsuarioPorNombre($nombre) {
    $stmt = conectar()->prepare('SELECT id, nombre, password FROM usuarios WHERE nombre = :nombre');
    $stmt->execute([':nombre' => $nombre]);
    return $stmt->fetch();
}

function getPreguntasFromDB($dbc) {
    $consulta = "SELECT * FROM preguntas";
    $resultado = $dbc->query($consulta);
    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}

function iniciarSesionUsuario($user) {
    session_regenerate_id(true);
    $_SESSION['usuario_id'] = $user['id'];
    $_SESSION['nombre'] = $user['nombre'];
}
