<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>REGISTRO</h1>
    <?php foreach ($errores as $error): ?>
        <p style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endforeach; ?>
    
    <form method="POST">
        
        <label for="email">Email:*</label>
        <input name="email" value="<?= htmlspecialchars(($datos['email']??'')) ?>" type="email" required>
        <br><br>

        <label for="nombre_usuario">Nombre Usuario:*</label>
        <input name="nombre_usuario" value="<?= htmlspecialchars(($datos['nombre_usuario']??'')) ?>" type="text" required>
        <br><br>

        <label for="contraseña">Contraseña:*</label>
        <input name="contraseña" value="" type="password" required>
        <br><br>

        <label for="contraseña_confirmacion">Repite la contraseña:*</label>
        <input name="contraseña_confirmacion" value="" type="password" required>
        <br><br>

        <button name="boton_enviar" value="boton_enviar">Enviar</button>
        <p>Si ya tienes cuenta tienes que <a href="login.php">INICIAR SESION</a> matao</p>
    </form>
</body>
</html>