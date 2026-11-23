<?php
/* ***** INICIALIZACIÓN DEL ENTORNO ***** */
require_once __DIR__ . '/lib/init.php';

/* ***** LÓGICA DE NEGOCIO ***** */
exigirLogin();
$pdo     = conectar();
$usuario = usuarioActual();

// Acciones (siempre POST y siempre con redirección: PRG)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'empezar') {
        if (!hayCuestionario()) {             // si hay uno a medias, se continúa
            empezarCuestionario($pdo);
        }
        redirigir('cuestionario.php');
    }

    if (!hayCuestionario()) {
        redirigir('bienvenida.php');
    }

    if ($accion === 'abandonar') {
        abandonarCuestionario();
        guardarFlash('Has abandonado el cuestionario. No se ha guardado ningún resultado.');
        redirigir('bienvenida.php');
    }

    if ($accion === 'responder' && !tiempoAgotado()) {
        $error = responder((int) ($_POST['pregunta'] ?? 0), (string) ($_POST['respuesta'] ?? ''));
        if ($error !== null) {
            guardarFlash($error);
        }
    }
    redirigir('cuestionario.php');
}

// GET: mostrar la pregunta actual
if (!hayCuestionario()) {
    redirigir('bienvenida.php');
}

if (tiempoAgotado()) {
    terminarCuestionario($pdo, $usuario['id']);
    guardarFlash('Se acabó el tiempo. Se ha puntuado lo que habías respondido.');
    redirigir('resultado.php');
}

if (cuestionarioCompleto()) {
    terminarCuestionario($pdo, $usuario['id']);
    redirigir('resultado.php');
}

$pregunta = obtenerPregunta($pdo, idPreguntaActual());
if ($pregunta === false) {                    // la pregunta se borró de la BD
    abandonarCuestionario();
    guardarFlash('El cuestionario ya no está disponible. Empieza uno nuevo.');
    redirigir('bienvenida.php');
}

$numero   = $_SESSION['cuestionario']['actual'] + 1;
$total    = count($_SESSION['cuestionario']['preguntas']);
$restante = segundosRestantes();

/* ***** LÓGICA DE PRESENTACIÓN ***** */
$titulo = "Pregunta $numero de $total";
$flash  = leerFlash();
require __DIR__ . '/templates/cuestionario.tpl.php';
