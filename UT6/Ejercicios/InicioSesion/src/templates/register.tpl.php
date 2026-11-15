<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>REGISTRO</h1>

    <form method="POST">

        <label for="email">Email:*</label>
        <input id="email" name="email" value="<?= htmlspecialchars($datos['email'] ?? '') ?>" type="email" required>
        <?php if (isset($errores['email'])): ?><span style="color: red;"><?= htmlspecialchars($errores['email']) ?></span><?php endif; ?>
        <br><br>

        <label for="nombre_usuario">Nombre Usuario:*</label>
        <input id="nombre_usuario" name="nombre_usuario" value="<?= htmlspecialchars($datos['nombre_usuario'] ?? '') ?>" type="text" required>
        <?php if (isset($errores['nombre_usuario'])): ?><span style="color: red;"><?= htmlspecialchars($errores['nombre_usuario']) ?></span><?php endif; ?>
        <br><br>

        <label for="contraseña">Contraseña:*</label>
        <input id="contraseña" name="contraseña" value="" type="password" required>
        <?php if (isset($errores['contraseña'])): ?><span style="color: red;"><?= htmlspecialchars($errores['contraseña']) ?></span><?php endif; ?>
        <br><br>

        <label for="contraseña_confirmacion">Repite la contraseña:*</label>
        <input id="contraseña_confirmacion" name="contraseña_confirmacion" value="" type="password" required>
        <br><br>

        <button name="boton_enviar" value="boton_enviar">Enviar</button>
        <p>Si ya tienes cuenta tienes que <a href="login.php">INICIAR SESION</a> matao</p>
    </form>
</body>
</html>
