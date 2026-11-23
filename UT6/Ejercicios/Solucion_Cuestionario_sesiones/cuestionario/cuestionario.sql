-- ============================================================
-- Actividad: cuestionario con progreso en sesión · cuestionario.sql
-- Se ejecuta DESPUÉS de usuarios.sql, como root, sobre login_dwes.
-- Se puede ejecutar varias veces sin errores.
--
-- Permisos: el usuario login_dwes ya tiene SELECT, INSERT, UPDATE y
-- DELETE sobre login_dwes.*, que incluye las tablas nuevas. No hay
-- que cambiar nada (la aplicación solo necesita SELECT e INSERT).
-- ============================================================

SET NAMES utf8mb4;
USE login_dwes;

-- Primero la tabla que tiene la clave ajena
DROP TABLE IF EXISTS resultados;
DROP TABLE IF EXISTS preguntas;

CREATE TABLE preguntas (
    id        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    enunciado VARCHAR(255) NOT NULL,
    opcion_a  VARCHAR(255) NOT NULL,
    opcion_b  VARCHAR(255) NOT NULL,
    opcion_c  VARCHAR(255) NOT NULL,
    opcion_d  VARCHAR(255) NOT NULL,
    correcta  CHAR(1)      NOT NULL,
    CONSTRAINT ck_preguntas_correcta CHECK (correcta IN ('a', 'b', 'c', 'd'))
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_spanish_ci;

CREATE TABLE resultados (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED     NOT NULL,
    aciertos   TINYINT UNSIGNED NOT NULL,
    total      TINYINT UNSIGNED NOT NULL,
    fecha      DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_resultados_usuario FOREIGN KEY (usuario_id)
        REFERENCES usuarios (id) ON DELETE CASCADE,
    CONSTRAINT ck_resultados_aciertos CHECK (aciertos <= total)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_spanish_ci;

INSERT INTO preguntas (enunciado, opcion_a, opcion_b, opcion_c, opcion_d, correcta) VALUES
('¿Dónde se guardan por defecto los datos de una sesión en PHP?',
 'En una cookie del navegador', 'En un fichero del servidor', 'En la base de datos', 'En la URL', 'b'),
('¿Cómo se llama por defecto la cookie que guarda el identificador de sesión?',
 'SESSIONID', 'PHPSID', 'PHPSESSID', 'SID', 'c'),
('¿Qué función hay que llamar antes de usar $_SESSION en un script?',
 'session_start()', 'session_open()', 'session_init()', 'session_begin()', 'a'),
('¿Qué ocurre si se llama a session_start() después de enviar HTML al navegador?',
 'Nada, funciona igual', 'Se crea una sesión nueva cada vez', 'Se borra la sesión anterior', 'Aparece el aviso «headers already sent» y la sesión no se inicia', 'd'),
('¿Para qué sirve el patrón PRG?',
 'Para cifrar los datos del formulario', 'Para que recargar la página no reenvíe el formulario', 'Para validar los datos en el cliente', 'Para paginar resultados', 'b'),
('¿Qué hay que escribir siempre después de header(''Location: ...'')?',
 'exit', 'return', 'break', 'session_destroy()', 'a'),
('¿Qué método de PDO prepara una consulta con parámetros?',
 'query()', 'exec()', 'prepare()', 'bind()', 'c'),
('¿Qué protege de la inyección SQL?',
 'htmlspecialchars()', 'Las sentencias preparadas', 'trim()', 'Usar el método POST', 'b'),
('¿Qué función se usa para escapar texto antes de mostrarlo en HTML?',
 'addslashes()', 'strip_tags()', 'urlencode()', 'htmlspecialchars()', 'd'),
('¿Con qué función se comprueba si una contraseña coincide con su hash?',
 'password_verify()', 'password_hash()', 'hash_equals()', 'crypt()', 'a'),
('¿Qué variable superglobal contiene los datos de un formulario enviado por POST?',
 '$_GET', '$_REQUEST', '$_POST', '$_FORM', 'c'),
('¿Qué atributo de PDO hace que los errores lancen excepciones?',
 'PDO::ATTR_ERRMODE con PDO::ERRMODE_EXCEPTION', 'PDO::ATTR_EMULATE_PREPARES a false', 'PDO::ATTR_DEFAULT_FETCH_MODE', 'PDO::ATTR_PERSISTENT', 'a');
