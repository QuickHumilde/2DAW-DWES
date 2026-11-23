<?php
// Inicialización común a todas las páginas.
// Se incluye en la primera línea de cada controlador, antes de cualquier salida.

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/bd.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/cuestionario.php';
