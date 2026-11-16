<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
</head>
<body>
    <h1>INICIO SESION</h1>


    <?php if (!empty($error)): ?>
        <p class="error" style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" value="" type="nombre">
        <br><br>

        <label for="contrasena">Contraseña:</label>
        <input id="contrasena" name="contrasena" value="" type="password">
        <br><br>

        <button name="boton_enviar" value="boton_enviar">Enviar</button>
    </form>

</body>
</html>
