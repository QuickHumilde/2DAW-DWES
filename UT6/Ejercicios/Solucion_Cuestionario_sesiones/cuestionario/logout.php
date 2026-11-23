<?php
/* ***** INICIALIZACIÓN DEL ENTORNO ***** */
require_once __DIR__ . '/lib/init.php';

/* ***** LÓGICA DE NEGOCIO ***** */
cerrarSesion();
redirigir('login.php');
