<?php

/**
 * @var array $preguntasPorId
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<body>

<?php if (!empty($_SESSION["cuestionario"]["preguntas"])):
    $indice = $_SESSION["cuestionario"]["indice"];

    $id = $_SESSION["cuestionario"]["preguntas"][$indice];

    $pregunta = $preguntasPorId[$id];
?>

    <p><strong><?= htmlspecialchars($pregunta['enunciado']); ?></strong></p>
    <p><?= 'A: ' . htmlspecialchars($pregunta['opcion_a']); ?></p>
    <p><?= 'B: ' . htmlspecialchars($pregunta['opcion_b']); ?></p>
    <p><?= 'C: ' . htmlspecialchars($pregunta['opcion_c']); ?></p>
    <p><?= 'D: ' . htmlspecialchars($pregunta['opcion_d']); ?></p>

<?php endif; ?>
</body>
<button>Siguiente pregunta</button>
</body>
</html>