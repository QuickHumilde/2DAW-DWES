<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <a href="./">Listado Completo</a>
    <a href="./reservas.php">Reserva</a>
    <h1>Listado</h1>
    <?php echo $markup_datos; ?>

    <form method="get">
        <label for="date">Introduzca la fecha:</label>
        <input name="fecha" id="fecha" type="date">

        <?php if ($filtros["fecha"] !== NULL): ?>
            <?php echo $filtros["fecha"];?>
        <?php endif; ?>

        <label for="pista">Pista:</label>
        <select name="pista" id="pista">
            <?php foreach (PISTAS as $valor => $texto): ?>
                <option value="<?php echo $texto; ?>">
                    <?php echo $texto; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php if ($filtros["pista"] !== NULL): ?>
            <?php echo $filtros["pista"];?>
        <?php endif; ?>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>