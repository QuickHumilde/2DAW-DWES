<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
</head>
<body>
    <h1>INICIO SESION</h1>

    <?php if ($flash): ?>
        <p style="color: green;"><?= htmlspecialchars($flash) ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">

        <label for="email">Email</label>
        <input id="email" name="email" value="<?= htmlspecialchars($email) ?>" type="email">
        <br><br>

        <label for="contraseña">Contraseña:</label>
        <input id="contraseña" name="contraseña" value="" type="password">
        <br><br>

        <button name="boton_enviar" value="boton_enviar">Enviar</button>
        <p>Si no tienes cuenta tienes que <a href="./register.php">REGISTRATE</a> matao</p>
    </form>
</body>
</html>
