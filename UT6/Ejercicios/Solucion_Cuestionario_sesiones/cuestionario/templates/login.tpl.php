<?php require __DIR__ . '/cabecera.tpl.php'; ?>
<h1>Iniciar sesión</h1>

<?php if ($flash !== null): ?>
    <p class="aviso"><?= e($flash) ?></p>
<?php endif; ?>
<?php if ($error !== null): ?>
    <p class="aviso mal"><?= e($error) ?></p>
<?php endif; ?>

<form method="post" action="login.php">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= e($email) ?>" required>

    <label for="contrasena">Contraseña</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <button type="submit">Entrar</button>
</form>

<p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
<?php require __DIR__ . '/pie.tpl.php'; ?>
