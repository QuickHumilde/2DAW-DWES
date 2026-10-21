<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coches y eso</title>
</head>
<body>
    <h1>COCHES TO CHULOS</h1>

    <?php if (isset($coches)): ?>

        <?= getCochesMarkup($coches) ?>

    <?php endif; ?>

</body>
</html>
