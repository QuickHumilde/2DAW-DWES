<?php

function dump($var){
    echo '<pre>'; var_dump($var); echo '<pre>';
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

function fillZeldaBoard($board_data){
    $output = '<div class="tablero">';
    foreach($board_data as $fila){
        foreach ($fila as $tile_value){
            $output .= '<div class="tile '.$tile_value.'-tile"></div>';
        }
    }
    //Metemos también a link
    $output .= '<div class="character link"></div>';
    $output .= '</div>';

    return $output;
}

function getLinkPosFromSession() {
    return [
        'left' => $_SESSION['pos_x'],
        'top' => $_SESSION['pos_y']
    ];
}

function moveLink($num_rows, $num_columns) {

    $move = filter_input(INPUT_POST, 'move');

    switch ($move) {

        case 'left':
            if ($_SESSION['pos_x'] > 1) {
                $_SESSION['pos_x']--;
            }
            break;

        case 'right':
            if ($_SESSION['pos_x'] < $num_columns) {
                $_SESSION['pos_x']++;
            }
            break;

        case 'up':
            if ($_SESSION['pos_y'] > 1) {
                $_SESSION['pos_y']--;
            }
            break;

        case 'down':
            if ($_SESSION['pos_y'] < $num_rows) {
                $_SESSION['pos_y']++;
            }
            break;
    }
}