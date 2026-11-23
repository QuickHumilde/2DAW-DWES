<?php require __DIR__ . '/cabecera.tpl.php'; ?>
<h1>Resultado</h1>

<?php if ($flash !== null): ?>
    <p class="aviso"><?= e($flash) ?></p>
<?php endif; ?>

<p>Has acertado <strong><?= e($resultado['aciertos']) ?> de <?= e($resultado['total']) ?></strong> preguntas.</p>

<h2>Revisión</h2>
<ol>
<?php foreach ($revision as $r): ?>
    <li>
        <?= e($r['enunciado']) ?><br>
        Tu respuesta: <?= $r['elegida'] !== null ? e($r['elegida']) : '<em>sin responder</em>' ?>
        <?= $r['acierto'] ? '✔' : '✘ · Correcta: ' . e($r['correcta']) ?>
    </li>
<?php endforeach; ?>
</ol>

<p><a href="bienvenida.php">Volver a la bienvenida</a></p>
<?php require __DIR__ . '/pie.tpl.php'; ?>
