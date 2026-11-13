
-- =====================================================
-- BASE DE DATOS: cuestionario_sesiones_dwes
-- Proyecto: Desarrollo Web en Entorno Servidor
-- =====================================================

CREATE DATABASE IF NOT EXISTS cuestionario_sesiones_dwes
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish_ci;

USE cuestionario_sesiones_dwes;


-- =====================================================
-- TABLA USUARIOS
-- Se crea únicamente si todavía no existe.
-- Si ya tienes usuarios.sql, comprueba que su tabla
-- tiene una clave primaria llamada id compatible.
-- =====================================================

CREATE TABLE IF NOT EXISTS usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;


-- =====================================================
-- TABLA PREGUNTAS
-- =====================================================

CREATE TABLE IF NOT EXISTS preguntas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    enunciado TEXT NOT NULL,
    opcion_a VARCHAR(255) NOT NULL,
    opcion_b VARCHAR(255) NOT NULL,
    opcion_c VARCHAR(255) NOT NULL,
    opcion_d VARCHAR(255) NOT NULL,
    correcta ENUM('A', 'B', 'C', 'D') NOT NULL
) ENGINE=InnoDB;


-- =====================================================
-- TABLA RESULTADOS
-- =====================================================

CREATE TABLE IF NOT EXISTS resultados (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario INT UNSIGNED NOT NULL,
    aciertos INT UNSIGNED NOT NULL,
    total_preguntas INT UNSIGNED NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_resultados_usuarios
        FOREIGN KEY (usuario)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE

) ENGINE=InnoDB;


-- =====================================================
-- INSERTAR PREGUNTAS
-- ON DUPLICATE KEY UPDATE evita duplicados
-- al ejecutar el script varias veces.
-- =====================================================

INSERT INTO preguntas
(id, enunciado, opcion_a, opcion_b, opcion_c, opcion_d, correcta)
VALUES

(1,
'¿Para qué sirven las sesiones en PHP?',
'Para guardar información del usuario entre páginas',
'Para crear tablas en MySQL',
'Para diseñar páginas HTML',
'Para ejecutar consultas SQL',
'A'),

(2,
'¿Qué función permite iniciar o recuperar una sesión en PHP?',
'session_start()',
'session_create()',
'start_session()',
'new_session()',
'A'),

(3,
'¿Dónde se almacenan normalmente los datos de sesión en PHP?',
'En $_POST',
'En $_GET',
'En $_SESSION',
'En $_SERVER',
'C'),

(4,
'¿Qué significa PDO en PHP?',
'PHP Data Objects',
'Personal Data Operations',
'Programming Database Option',
'PHP Direct Output',
'A'),

(5,
'¿Para qué sirven las sentencias preparadas de PDO?',
'Para mejorar el diseño de los formularios',
'Para evitar inyecciones SQL y separar datos de consultas',
'Para crear sesiones automáticamente',
'Para convertir PHP en HTML',
'B'),

(6,
'¿Qué método HTTP se utiliza habitualmente para enviar formularios con datos privados?',
'GET',
'LINK',
'POST',
'HEAD',
'C'),

(7,
'¿Qué función de PHP permite escapar caracteres especiales en HTML?',
'htmlspecialchars()',
'htmlentities_sql()',
'escape_html()',
'filter_html()',
'A'),

(8,
'¿Qué superglobal de PHP permite recoger datos enviados mediante POST?',
'$_GET',
'$_SESSION',
'$_SERVER',
'$_POST',
'D'),

(9,
'¿Qué significa el patrón PRG (Post/Redirect/Get)?',
'Preparar, Recuperar y Guardar',
'Post, Redirect y Get',
'PHP, Request y Generate',
'Programar, Redirigir y Gestionar',
'B'),

(10,
'¿Qué instrucción permite finalizar la ejecución de un script PHP?',
'stop()',
'break_all()',
'exit',
'close()',
'C')

ON DUPLICATE KEY UPDATE
    enunciado = VALUES(enunciado),
    opcion_a = VALUES(opcion_a),
    opcion_b = VALUES(opcion_b),
    opcion_c = VALUES(opcion_c),
    opcion_d = VALUES(opcion_d),
    correcta = VALUES(correcta);


-- =====================================================
-- FIN DEL SCRIPT
-- =====================================================
