
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__ . '/src/functions.php');

session_start();

$data_tablero = getTableroFromCsv(__DIR__ . '/data/tablero.csv');

$num_rows = count($data_tablero);
$num_columns = count($data_tablero[0]);

if (!isset($_SESSION['pos_x'])) {
    $_SESSION['pos_x'] = 4;
}

if (!isset($_SESSION['pos_y'])) {
    $_SESSION['pos_y'] = 3;
}

moveLink($num_rows, $num_columns);

$link_pos = getLinkPosFromSession();

$tablero = fillZeldaBoard($data_tablero);

include(__DIR__ . '/templates/index.tpl.php');

?>
