<?php require __DIR__ . '/cabecera.tpl.php'; ?>
<h1>Bienvenido/a, <?= e($usuario['nombre']) ?></h1>

<?php if ($flash !== null): ?>
    <p class="aviso"><?= e($flash) ?></p>
<?php endif; ?>

<form method="post" action="cuestionario.php">
    <input type="hidden" name="accion" value="empezar">
    <button type="submit"><?= $aMedias ? 'Continuar cuestionario' : 'Empezar cuestionario' ?></button>
</form>

<h2>Tu historial</h2>
<?php if (!$historial): ?>
    <p>Todavía no has hecho ningún cuestionario.</p>
<?php else: ?>
    <p>Mejor resultado: <strong><?= e($mejor['aciertos']) ?> de <?= e($mejor['total']) ?></strong>
       (<?= e(fechaEs($mejor['fecha'])) ?>)</p>
    <table>
        <thead><tr><th>Fecha</th><th>Aciertos</th></tr></thead>
        <tbody>
        <?php foreach ($historial as $r): ?>
            <tr>
                <td><?= e(fechaEs($r['fecha'])) ?></td>
                <td><?= e($r['aciertos']) ?> / <?= e($r['total']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p><a href="logout.php">Cerrar sesión</a></p>
<?php require __DIR__ . '/pie.tpl.php'; ?>
