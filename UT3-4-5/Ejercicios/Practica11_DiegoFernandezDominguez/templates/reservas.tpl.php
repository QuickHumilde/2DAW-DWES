<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <a href="./index.php">Listado Completo</a>
    <a href="./">Reserva</a>
    <h1>Reserva</h1>

    <form method="POST" action="">
        <label for="nombre">Introduzca su nombre:</label>
        <input name="nombre" id="name" type="text" value=<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>>

        <label for="email">Introduzca su email:</label>
        <input name="email" id="email" type="email" value=<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>>

        <label for="pista">Pista:</label>
        <select name="pista" id="pista">
            <?php foreach (PISTAS as $valor => $texto): ?>
                <option value="<?php echo $texto; ?>">
                    <?php echo $texto; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="date">Introduzca la fecha:</label>
        <input name="date" id="date" type="date" value=<?= isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '' ?>>

        <label>Introduzca la hora:</label>
        <?php
        $horas = [
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00'
        ];
        ?>
        <?php foreach ($horas as $hora): ?>
            <label>
                <input
                    type="radio"
                    name="hora"
                    value="<?= htmlspecialchars($hora) ?>"
                    <?= (isset($_POST['hora']) && $_POST['hora'] === $hora) ? 'checked' : '' ?>
                >
                <?= htmlspecialchars($hora) ?>
            </label>
            <br>
        <?php endforeach; ?>
        <p>------</p>
        <?php foreach (MATERIALES as $texto): ?>
            <label>
                <input
                    type="checkbox"
                    name="materiales[]"
                    value="<?= $texto ?>"
                    <?= (
                        isset($_POST['materiales']) &&
                        in_array($texto, $_POST['materiales'])
                    ) ? 'checked' : '' ?>
                >
                <?= $texto ?>
            </label>
            <br>
        <?php endforeach; ?>        
        <p>------</p>
        <input type="checkbox" id="normas" name="normas" value="1">
        <label for="normas">Aceptar las normas</label><br>

<button type="submit" name="mi_boton">Adjuntar reserva</button>
</form>
</body>
</html>