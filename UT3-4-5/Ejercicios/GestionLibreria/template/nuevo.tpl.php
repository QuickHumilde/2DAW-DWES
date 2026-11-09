<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir libro</title>
</head>
<body>
    <h1>AÑADIR LIBRO</h1>
    <form action="./" method="POST">
        <label for="ISBN">ISBN: </label><input id="isbn" name="isbn" type="text" value="">
        <label for="Titulo">Titulo: </label><input id="titulo" name="titulo" type="text" value="">
        <label for="Autor">Autor: </label><input id="autor" name="autor" type="text" value="">

        <button type="submit" name="nuevo_libro" value="nuevo_libro">Añadir Libro</button>
    </form>
</body>
</html>