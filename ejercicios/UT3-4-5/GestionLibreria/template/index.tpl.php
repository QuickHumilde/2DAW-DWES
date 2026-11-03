
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
            <option value="">Todos</option>
            <?php foreach (GENEROS as $genero): ?>
                <option value="<?= htmlspecialchars($genero) ?>" <?= ($filtros['genero'] ?? '') === $genero ? 'selected' : '' ?>>
                    <?= htmlspecialchars($genero) ?>
                </option>
            <?php endforeach ?>
        </select>
        <button>Filtrar</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Año</th>
                <th>Género</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= htmlspecialchars($libro['titulo']) ?></td>
                    <td><?= htmlspecialchars($libro['autor']) ?></td>
                    <td><?= htmlspecialchars($libro['anio']) ?></td>
                    <td><?= htmlspecialchars($libro['genero']) ?></td>
                    <td><?= $libro['disponible'] ? 'Disponible' : 'No disponible' ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>
</html>
