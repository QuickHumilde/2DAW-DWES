<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir libro</title>
</head>
<body>
    <h1>AÑADIR LIBRO</h1>
    <form action="<?=  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="ISBN">ISBN: </label><input id="isbn" name="isbn" type="text" value="<?= htmlspecialchars(($datosValidos['isbn']??'')?$datosValidos['isbn']:'') ?>">
        <label for="Titulo">Titulo: </label><input id="titulo" name="titulo" type="text" value="<?= htmlspecialchars(($datosValidos['titulo']??'')) ?>">
        <label for="Autor">Autor: </label><input id="autor" name="autor" type="text" value="">
        <label for="Genero">Genero: </label><select id="genero" name="genero">
            <option>Elige un genero</option>
            <?php foreach (GENEROS as $genero):?>
                <option value="<?= htmlspecialchars($genero)?>" <?=  htmlspecialchars(($datosValidos['genero']??'')===$genero ?'selected':'') ?>> <!-- Texto--> <?= htmlspecialchars($genero) ?> <!-- /Texto--> </option>
            <?php endforeach;?>
        </select>

        <fieldset>
        <legend>Generos 2</legend>
            <?php foreach (GENEROS as $genero):?>
                <input id="gen_<?= htmlspecialchars($genero) ?>" type="checkbox" value="<?= htmlspecialchars($genero)?>" name="generos[]"><label for="gen_<?= htmlspecialchars($genero) ?>"><?= ucfirst(htmlspecialchars($genero)); ?></label>
            <?php endforeach;?>
        </fieldset>

        <button type="submit" name="nuevo_libro" value="nuevo_libro">Añadir Libro</button>
    </form>
</body>
</html>