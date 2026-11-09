<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiendas y videojuegos</title>
    <!--<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">-->
</head>
<body>
    <header>
        <h1>Tiendas de videojuegos</h1>
        <p>Stock de videojuegos disponible en cada tienda</p>
    </header>

    <main>

        <?php foreach ($videoGamesShops as $valor ):?>
        <p> <?= htmlspecialchars($valor['nombre']) ?></p>
        <ul>
        <li> <?= htmlspecialchars($valor['titulo']. " || Cantidad:" .$valor['cantidad'])  ?></li>
        </ul>
        <?php endforeach; ?>

    </main>

    <footer>
        <p>DWES - Examen 1A - Ejercicio 1</p>
    </footer>
</body>
</html>
