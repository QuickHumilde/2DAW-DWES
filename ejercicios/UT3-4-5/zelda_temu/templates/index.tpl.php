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
        background-color: rgb(0, 47, 255);
        width: 215px;
        height: 215px;
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

</style>

<body>
    <div class="tablero">

        <?= rellenarTableroCSV($tablero) ?>

    </div>

    <div class="controls-container">

    </div>
</body>

</html>
