<?php
/*
 * ESTADO DEL CUESTIONARIO EN LA SESIÓN
 *
 * Todo va en una sola clave, $_SESSION['cuestionario']:
 *   'preguntas'  => [id, id, ...]   ids de las preguntas, ya barajadas
 *   'actual'     => int             posición de la pregunta que toca (0 = primera)
 *   'respuestas' => [id => letra]   respuestas dadas hasta ahora
 *   'inicio'     => int             time() del comienzo (límite de tiempo)
 *
 * Solo identificadores y letras: enunciados, opciones y la respuesta
 * correcta se leen siempre de la base de datos.
 *
 * Al terminar, $_SESSION['ultimo_resultado'] guarda el id del resultado
 * y las respuestas, para que resultado.php sepa qué mostrar (y nada más).
 */

const NUM_PREGUNTAS = 5;
const TIEMPO_MAX    = 5 * 60;          // segundos (Para nota)
const LETRAS        = ['a', 'b', 'c', 'd'];

function hayCuestionario(): bool
{
    return isset($_SESSION['cuestionario']);
}

/** Crea un cuestionario nuevo con NUM_PREGUNTAS preguntas al azar. */
function empezarCuestionario(PDO $pdo): void
{
    $ids = $pdo->query('SELECT id FROM preguntas')->fetchAll(PDO::FETCH_COLUMN);
    shuffle($ids);

    $_SESSION['cuestionario'] = [
        'preguntas'  => array_map('intval', array_slice($ids, 0, NUM_PREGUNTAS)),
        'actual'     => 0,
        'respuestas' => [],
        'inicio'     => time(),
    ];
}

function abandonarCuestionario(): void
{
    unset($_SESSION['cuestionario']);
}

/** Id de la pregunta que toca responder. */
function idPreguntaActual(): int
{
    $c = $_SESSION['cuestionario'];
    return $c['preguntas'][$c['actual']];
}

function tiempoAgotado(): bool
{
    return time() - $_SESSION['cuestionario']['inicio'] > TIEMPO_MAX;
}

function segundosRestantes(): int
{
    return max(0, TIEMPO_MAX - (time() - $_SESSION['cuestionario']['inicio']));
}

/** Pregunta sin la respuesta correcta (esa columna no se lee para mostrar). */
function obtenerPregunta(PDO $pdo, int $id): array|false
{
    $sql = 'SELECT id, enunciado, opcion_a, opcion_b, opcion_c, opcion_d FROM preguntas WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

/**
 * Registra la respuesta a la pregunta actual.
 * Devuelve null si se acepta, o el motivo del rechazo.
 */
function responder(int $idPregunta, string $letra): ?string
{
    if (!in_array($letra, LETRAS, true)) {
        return 'Elige una de las cuatro opciones.';
    }
    if ($idPregunta !== idPreguntaActual()) {
        return 'Esa pregunta ya estaba respondida. Sigue con la actual.';
    }

    $_SESSION['cuestionario']['respuestas'][$idPregunta] = $letra;
    $_SESSION['cuestionario']['actual']++;
    return null;
}

function cuestionarioCompleto(): bool
{
    $c = $_SESSION['cuestionario'];
    return $c['actual'] >= count($c['preguntas']);
}

/** Respuestas correctas (id => letra) de una lista de ids. */
function respuestasCorrectas(PDO $pdo, array $ids): array
{
    if (!$ids) {
        return [];
    }
    $marcas = implode(', ', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT id, correcta FROM preguntas WHERE id IN ($marcas)");
    $stmt->execute(array_values($ids));
    return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
}

/**
 * Puntúa, guarda el resultado y quita el cuestionario de la sesión.
 * Las preguntas sin responder (tiempo agotado) cuentan como fallos.
 */
function terminarCuestionario(PDO $pdo, int $idUsuario): void
{
    $c         = $_SESSION['cuestionario'];
    $correctas = respuestasCorrectas($pdo, $c['preguntas']);

    $aciertos = 0;
    foreach ($c['respuestas'] as $id => $letra) {
        if (($correctas[$id] ?? null) === $letra) {
            $aciertos++;
        }
    }

    $sql = 'INSERT INTO resultados (usuario_id, aciertos, total) VALUES (:usuario, :aciertos, :total)';
    $pdo->prepare($sql)->execute([
        ':usuario'  => $idUsuario,
        ':aciertos' => $aciertos,
        ':total'    => count($c['preguntas']),
    ]);

    $_SESSION['ultimo_resultado'] = [
        'id'         => (int) $pdo->lastInsertId(),
        'preguntas'  => $c['preguntas'],
        'respuestas' => $c['respuestas'],
    ];
    unset($_SESSION['cuestionario']);
}

/** Resultado por id, solo si es del usuario indicado. */
function obtenerResultado(PDO $pdo, int $id, int $idUsuario): array|false
{
    $sql = 'SELECT aciertos, total, fecha FROM resultados WHERE id = :id AND usuario_id = :usuario';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id, ':usuario' => $idUsuario]);
    return $stmt->fetch();
}

/** Revisión (Para nota): cada pregunta con la opción elegida y la correcta. */
function revisarRespuestas(PDO $pdo, array $ids, array $respuestas): array
{
    $marcas = implode(', ', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM preguntas WHERE id IN ($marcas)");
    $stmt->execute(array_values($ids));
    $porId = array_column($stmt->fetchAll(), null, 'id');

    $revision = [];
    foreach ($ids as $id) {                       // en el orden en que salieron
        if (!isset($porId[$id])) {
            continue;
        }
        $p = $porId[$id];
        $elegida = $respuestas[$id] ?? null;
        $revision[] = [
            'enunciado' => $p['enunciado'],
            'elegida'   => $elegida !== null ? $p['opcion_' . $elegida] : null,
            'correcta'  => $p['opcion_' . $p['correcta']],
            'acierto'   => $elegida === $p['correcta'],
        ];
    }
    return $revision;
}

/** Historial del usuario, del más reciente al más antiguo. */
function historial(PDO $pdo, int $idUsuario): array
{
    $sql = 'SELECT aciertos, total, fecha FROM resultados
            WHERE usuario_id = :usuario ORDER BY fecha DESC, id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':usuario' => $idUsuario]);
    return $stmt->fetchAll();
}

/** Mejor resultado (mayor proporción de aciertos; a igualdad, el más reciente). */
function mejorResultado(array $historial): ?array
{
    $mejor = null;
    foreach ($historial as $r) {
        if ($mejor === null || $r['aciertos'] / $r['total'] > $mejor['aciertos'] / $mejor['total']) {
            $mejor = $r;
        }
    }
    return $mejor;
}

function fechaEs(string $fechaMysql): string
{
    return date('d/m/Y H:i', strtotime($fechaMysql));
}
