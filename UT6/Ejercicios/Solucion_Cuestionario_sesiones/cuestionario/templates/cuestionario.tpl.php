<?php require __DIR__ . '/cabecera.tpl.php'; ?>
<p>Pregunta <?= $numero ?> de <?= $total ?> · Tiempo restante: <?= intdiv($restante, 60) ?> min <?= $restante % 60 ?> s</p>

<?php if ($flash !== null): ?>
    <p class="aviso mal"><?= e($flash) ?></p>
<?php endif; ?>

<form method="post" action="cuestionario.php">
    <input type="hidden" name="accion" value="responder">
    <input type="hidden" name="pregunta" value="<?= e($pregunta['id']) ?>">
    <fieldset>
        <legend><?= e($pregunta['enunciado']) ?></legend>
        <?php foreach (LETRAS as $letra): ?>
            <label class="opcion">
                <input type="radio" name="respuesta" value="<?= $letra ?>" required>
                <?= e($pregunta['opcion_' . $letra]) ?>
            </label>
        <?php endforeach; ?>
    </fieldset>
    <button type="submit">Responder</button>
</form>

<form method="post" action="cuestionario.php">
    <input type="hidden" name="accion" value="abandonar">
    <button type="submit">Abandonar</button>
</form>
<?php require __DIR__ . '/pie.tpl.php'; ?>
