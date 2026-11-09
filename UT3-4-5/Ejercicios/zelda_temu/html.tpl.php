<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zelda del temu</title>
    <!--<link rel="stylesheet" href="styles.css">-->
</head>
<style>
    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        background-color: rgb(233, 237, 255);
    }

    .tablero {
        display: grid;
        width: 512;
        height: 512;
        grid-template-columns: repeat(<?php echo $num_columns; ?>, 16px);
        grid-template-rows: repeat(<?php echo $num_rows; ?>, 16px);
        border: 1px solid black;
    }

    .controls-container {
    display: grid;
    grid-template-columns: 50px 50px 50px;
    grid-template-rows: 50px 50px 50px;
    gap: 5px;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
    }

    .controls-container a {
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;

        font-size: 28px;
        text-decoration: none;
        color: black;

        background-color: #ddd;
        border: 1px solid #999;
        border-radius: 4px;
    }

    .controls-container a:nth-child(1) {
        grid-column: 2;
        grid-row: 1;
    }

    .controls-container a:nth-child(2) {
        grid-column: 1;
        grid-row: 2;
    }

    .controls-container a:nth-child(3) {
        grid-column: 3;
        grid-row: 2;
    }

    .controls-container a:nth-child(4) {
        grid-column: 2;
        grid-row: 3;
    }

    .tile {
        box-sizing: border-box;
        width: 16px;
        height: 16px;
        border: 1px solid rgb(9, 39, 0);
        background-color: pink;
        background-image: url('./img/spritesheet.png');
        background-repeat: no-repeat;
        background-position-x: -86px;
        background-position-y: -86px;
    }

    .tile-hierba {
        background-position-x: -86px;
        background-position-y: -86px;
    }

    .tile-agua {
        background-position-x: -18px;
        background-position-y: -35px;
    }

    .tile-muro {
        background-position-x: -69px;
        background-position-y: -35px;
    }

    .tile-arbusto {
        background-position-x: -69px;
        background-position-y: -52px;
    }

    .character {
        position: fixed;
        width: 16px;
        height: 16px;
        object-fit: cover;
        pointer-events: none; 
        z-index: 9999;
    }

</style>

<body>
    <h1>Zelda del temu</h1>
    <div class="tablero">

        <?= rellenarCadenaTablero(getTableroFromCsv(__DIR__ . "/data_source/tablero.csv")) ?>

    </div>

    <?php
        [$x, $y] = getLinkPositions($tablero);

        $arriba = max(1, $y - 1);
        $abajo = min($num_rows, $y + 1);
        $izquierda = max(1, $x - 1);
        $derecha = min($num_columns, $x + 1);
        ?>

        <div class="controls-container">
            <a href="?x=<?= $x ?>&y=<?= $arriba ?>">↑</a>
            <a href="?x=<?= $izquierda ?>&y=<?= $y ?>">←</a>
            <a href="?x=<?= $derecha ?>&y=<?= $y ?>">→</a>
            <a href="?x=<?= $x ?>&y=<?= $abajo ?>">↓</a>
        </div>

    </div>
</body>

</html>
