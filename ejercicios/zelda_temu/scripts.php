<?php

function dump($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function rellenarCadenaTablero($tablero) {
    $output = "";
    $posiciones = getLinkPositions($tablero);

    foreach ($tablero as $y => $fila) {
        foreach ($fila as $x => $casilla) {

            // Pasamos de índices PHP (0-31) a coordenadas (1-32)
            $posX = $x + 1;
            $posY = $y + 1;

            if ($casilla == "hierba") {
                $output .= "<div class='tile tile-hierba'>";

            } elseif ($casilla == "agua") {
                $output .= "<div class='tile tile-agua'>";

            } elseif ($casilla == "muro") {
                $output .= "<div class='tile tile-muro'>";

            } elseif ($casilla == "arbusto") {
                $output .= "<div class='tile tile-arbusto'>";

            } else {
                $output .= "<div class='tile'>";
            }

            if ($posiciones[0] == $posX && $posiciones[1] == $posY) {
                $output .= "<img src='./img/link.png' class='character'>";
            }

            $output .= "</div>";
        }
    }

    return $output;
}

function getTableroFromCsv(String $rutaCSV) {
    $stream = fopen($rutaCSV, 'r');
    $tablero = [];


    if ($stream !== false) {

        while (($fila = fgetcsv($stream)) !== false) {
            $tablero[] = $fila;
        }

        fclose($stream);
    }

    return $tablero;
}

function getLinkPositions($tablero) {
    $num_rows = count($tablero);
    $num_columns = count($tablero[0]);

    $x = isset($_GET['x']) ? (int)$_GET['x'] : 3;
    $y = isset($_GET['y']) ? (int)$_GET['y'] : 3;

    $x = max(1, min($x, $num_columns));
    $y = max(1, min($y, $num_rows));

    return [$x, $y];
}
