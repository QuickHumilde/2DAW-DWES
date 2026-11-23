<?php
/* ***** INICIALIZACIÓN DEL ENTORNO ***** */
require_once __DIR__ . '/lib/init.php';

/* ***** LÓGICA DE NEGOCIO ***** */
exigirLogin();
$usuario   = usuarioActual();
$historial = historial(conectar(), $usuario['id']);
$mejor     = mejorResultado($historial);
$aMedias   = hayCuestionario();

/* ***** LÓGICA DE PRESENTACIÓN ***** */
$titulo = 'Bienvenida';
$flash  = leerFlash();
require __DIR__ . '/templates/bienvenida.tpl.php';
