<?php
// Datos de conexión: solo aquí
const DB_DSN  = 'mysql:host=localhost;dbname=login_dwes;charset=utf8mb4';
const DB_USER = 'login_dwes';
const DB_PASS = 'Login2026.';

/**
 * Devuelve la conexión PDO (la misma durante toda la petición).
 */
function conectar(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}
