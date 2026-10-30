<?php

function dump($var)
{
    echo '<pre>' . print_r($var, 1) . '</pre>';
}

function conectar($dbParameters){
    try {

        $dbh = new PDO($dbParameters['dns'], $dbParameters['username'], $dbParameters['password']);
        
        return $dbh;
        
    } catch (PDOException $e) {
        dump("Error al conectar con la base de datos");
    }
}

function contarDisponibles(PDO $pdo): int {
    $consulta = "SELECT COUNT(*) FROM libros WHERE disponible = 1";
    $resultado = $pdo->query($consulta);
    return $resultado->fetchColumn();
}

function obtenerLibro(PDO $pdo, int $id): array|false
{
    $consulta = "SELECT * FROM libros WHERE id = $id";
    $resultado = $pdo->prepare($consulta);
    $resultado->execute();

    return $resultado->fetch(PDO::FETCH_ASSOC);
}

function listarLibros(PDO $pdo, ?string $genero=null): array {

    if (is_null($genero)) {
        $consulta = "SELECT * FROM libros ORDER BY titulo";
        $resultado = $pdo->query($consulta);

    } else {
        $consulta = "SELECT * FROM libros WHERE genero = :genero";
        $resultado = $pdo->prepare($consulta);
        $resultado->execute(['genero' => $genero]);
    }

    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}
