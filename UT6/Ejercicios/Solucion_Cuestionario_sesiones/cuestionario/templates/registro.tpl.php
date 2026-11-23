<?php require __DIR__ . '/cabecera.tpl.php'; ?>
<h1>Crear cuenta</h1>

<form method="post" action="registro.php" novalidate>
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="<?= e($datos['nombre']) ?>" maxlength="100" required>
    <?php if (isset($errores['nombre'])): ?><p class="error"><?= e($errores['nombre']) ?></p><?php endif; ?>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= e($datos['email']) ?>" maxlength="100" required>
    <?php if (isset($errores['email'])): ?><p class="error"><?= e($errores['email']) ?></p><?php endif; ?>

    <label for="contrasena">Contraseña (mínimo 8 caracteres)</label>
    <input type="password" id="contrasena" name="contrasena" minlength="8" required>
    <?php if (isset($errores['contrasena'])): ?><p class="error"><?= e($errores['contrasena']) ?></p><?php endif; ?>

    <label for="repetir">Repite la contraseña</label>
    <input type="password" id="repetir" name="repetir" required>
    <?php if (isset($errores['repetir'])): ?><p class="error"><?= e($errores['repetir']) ?></p><?php endif; ?>

    <button type="submit">Registrarme</button>
</form>

<p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
<?php require __DIR__ . '/pie.tpl.php'; ?>
