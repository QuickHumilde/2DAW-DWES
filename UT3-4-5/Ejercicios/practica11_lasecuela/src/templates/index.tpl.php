<?php

/**
 * @var array $data 
 * Array con la lista de reservas
 * 
 */
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <a href="./">Listado Completo</a>
    <h1>Listado Reservas</h1>
    
    </form>
        <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Pista</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Material</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $value): ?>
                <tr>
                <?php foreach($value as $field): ?>
                    <td><?php echo htmlspecialchars($field); ?></td>
                <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <br><br>

    <form method="get">
    <label for="date">Introduzca la fecha:</label>
    <input name="fecha" id="fecha" type="date">

    <label for="pista">Introduzca la PISTA:</label>
    <select name="pista" id="pista">
        <?php foreach(PISTAS as $clave => $valor): ?>
            <option value="<?php echo $valor; ?>">
                <?php echo htmlspecialchars($valor);?> 
            </option>
        <?php endforeach ?>
    </select>
    <button type="submit">Enviar</button>

</body>
</html>