
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
</head>
<body>
    <h1>Biblioteca</h1>
    <p>
        Libros disponibles: <?= htmlspecialchars($numDisponibles) ?>
    </p>

    <form method="get" action="./">
        <select name="genero" id="filtroGenero">
                <option value="" selected>Seleccionar...</option>
                <?php foreach(GENEROS as $genero): ?>
                    <option><?php htmlspecialchars($genero) ?></option>
                <?php endforeach ?>
            </select>

        <button>Filtrar</button>
    </form>
</body>
</html>
