CREATE TABLE `movimientos` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tipo` ENUM('ingreso', 'gasto') NOT NULL,
  `descripcion` TEXT,
  `valor` DECIMAL(10, 2) NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
