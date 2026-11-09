-- Base de datos: dwes_examen1
-- Tiendas, videojuegos y stock de cada videojuego en cada tienda

DROP DATABASE IF EXISTS dwes_examen1;
CREATE DATABASE dwes_examen1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dwes_examen1;

-- Tabla de tiendas
CREATE TABLE tiendas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ciudad VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Tabla de videojuegos
CREATE TABLE videojuegos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    plataforma VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- Tabla intermedia: stock de cada videojuego en cada tienda
CREATE TABLE stock (
    tienda_id INT UNSIGNED NOT NULL,
    videojuego_id INT UNSIGNED NOT NULL,
    cantidad INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (tienda_id, videojuego_id),
    CONSTRAINT fk_stock_tienda FOREIGN KEY (tienda_id)
        REFERENCES tiendas(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_stock_videojuego FOREIGN KEY (videojuego_id)
        REFERENCES videojuegos(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Datos de ejemplo
INSERT INTO tiendas (id, nombre, ciudad) VALUES
(1, 'GameZone Centro', 'Madrid'),
(2, 'Pixel Store', 'Barcelona'),
(3, 'Level Up', 'Sevilla');

INSERT INTO videojuegos (id, titulo, plataforma) VALUES
(1, 'The Legend of Zelda: Tears of the Kingdom', 'Nintendo Switch'),
(2, 'Elden Ring', 'PS5'),
(3, 'Mario Kart 8 Deluxe', 'Nintendo Switch'),
(4, 'Forza Horizon 5', 'Xbox Series X'),
(5, 'EA Sports FC 25', 'PS5'),
(6, 'Baldur''s Gate 3', 'PC');

INSERT INTO stock (tienda_id, videojuego_id, cantidad) VALUES
(1, 1, 12),
(1, 2, 5),
(1, 5, 20),
(2, 2, 8),
(2, 3, 15),
(2, 4, 3),
(2, 6, 7),
(3, 1, 4),
(3, 3, 10),
(3, 5, 0);

CREATE USER IF NOT EXISTS 'dwes_examen1'@'localhost' IDENTIFIED BY 'dwes_examen1';
GRANT ALL PRIVILEGES ON dwes_examen1.* TO 'dwes_examen1'@'localhost';

