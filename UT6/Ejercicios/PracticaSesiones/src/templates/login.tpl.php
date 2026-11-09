<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
</head>
<body>
    <h1>INICIO SESION</h1>
    <form method="POST">

        <label for="nombre_usuario">Nombre Usuario:</label>
        <input name="nombre_usuario" value="" type="text">
        <br><br>

        <label for="contraseña">Contraseña:</label>
        <input name="contraseña" value="" type="password">
        <br><br>
        
        <button name="boton_enviar" value="boton_enviar">Enviar</button>
        <p>Si no tienes cuenta tienes que <a href="./register.php">REGISTRATE</a> matao</p>
    </form>
</body>
</html>