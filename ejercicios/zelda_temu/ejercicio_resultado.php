<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$casillas_valores = [
    0 => "hierba",
    1 => "agua",
    2 => "muro",
    3 => "arbusto",
];

$tablero = [
    [
        $casillas_valores[0],
        $casillas_valores[1],
        $casillas_valores[2],
        $casillas_valores[3],
        $casillas_valores[0],
    ],
    [
        $casillas_valores[1],
        $casillas_valores[0],
        $casillas_valores[3],
        $casillas_valores[2],
        $casillas_valores[1],
    ],
    [
        $casillas_valores[2],
        $casillas_valores[3],
        $casillas_valores[0],
        $casillas_valores[1],
        $casillas_valores[2],
    ],
    [
        $casillas_valores[3],
        $casillas_valores[2],
        $casillas_valores[1],
        $casillas_valores[0],
        $casillas_valores[3],
    ],
    [
        $casillas_valores[0],
        $casillas_valores[1],
        $casillas_valores[3],
        $casillas_valores[2],
        $casillas_valores[0],
    ],
];

include_once(__DIR__ . '/scripts.php');
include_once(__DIR__ . '/html.tpl.php');

$output = rellenarTablero($tablero);

?>