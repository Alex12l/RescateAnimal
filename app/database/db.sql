CREATE DATABASE tiendaperu;

use tiendaperu;

CREATE TABLE productos
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  classificacion ENUM('Equipo','Accesorio','Consumible') NOT NULL,
  marca         VARCHAR(30)   NOT NULL,
  descripcion   VARCHAR(100)  NOT NULL,
  garantia      TINYINT       NOT NULL DEFAULT 12,
  ingreso       DATE          NOT NULL,
  cantidad      SMALLINT      NOT NULL,
  created       DATETIME      NOT NULL DEFAULT NOW() COMMENT 'Campo calculado Fecha y Hora',
  updated       DATETIME      NOT NULL COMMENT 'se agrega al detectar un cambio'

)ENGINE = INNODB;

INSERT INTO productos 
(classificacion, marca, descripcion, garantia, ingreso, cantidad) VALUES
('Equipo', 'Epson', 'Impresora L200', 24, '2025-10-05', 10),
('Accesorio', 'Logitech', 'Teclado USB Negro', 12, '2025-11-01', 20),
('Consumible', 'Canon', 'Pixma 190 Yellow', 6, '2025-09-10', 5);
SELECT*FROM productos;