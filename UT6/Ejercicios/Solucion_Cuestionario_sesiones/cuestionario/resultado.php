<?php
/* ***** INICIALIZACIÓN DEL ENTORNO ***** */
require_once __DIR__ . '/lib/init.php';

/* ***** LÓGICA DE NEGOCIO ***** */
exigirLogin();
$pdo     = conectar();
$usuario = usuarioActual();

// El resultado a mostrar sale de la sesión, no de la URL
$ultimo    = $_SESSION['ultimo_resultado'] ?? null;
$resultado = $ultimo ? obtenerResultado($pdo, $ultimo['id'], $usuario['id']) : false;
if ($resultado === false) {
    redirigir('bienvenida.php');
}

$revision = revisarRespuestas($pdo, $ultimo['preguntas'], $ultimo['respuestas']);   // Para nota

/* ***** LÓGICA DE PRESENTACIÓN ***** */
$titulo = 'Resultado';
$flash  = leerFlash();
require __DIR__ . '/templates/resultado.tpl.php';
