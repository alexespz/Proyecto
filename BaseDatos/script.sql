/*SCRIPT PARA LA BASE DE DATOS */

CREATE DATABASE IF NOT EXISTS restaurante;
USE restaurante;

/*TABLA 1 - USUARIOS*/
CREATE TABLE IF NOT EXISTS usuarios(
  id_usuario TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(20) NOT NULL,
  apellido1 VARCHAR(20) NOT NULL,
  apellido2 VARCHAR(20) NOT NULL,
  dni CHAR(9) NOT NULL UNIQUE,
  telefono VARCHAR(9) NOT NULL UNIQUE,
  sexo CHAR(1) NOT NULL,
  usuario VARCHAR(25) NOT NULL UNIQUE,
  contrasenia VARCHAR(255) NOT NULL,
  email VARCHAR(60) NOT NULL UNIQUE,
  contador_pedidos TINYINT UNSIGNED AUTO_INCREMENT,
  tipo_usuario CHAR(1) NOT NULL
);

/*TABLA 2 - TIPO_PRODUCTO*/
CREATE TABLE IF NOT EXISTS tipo_producto(
  id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(15) NOT NULL
);

/*TABLA 3 - PRODUCTO*/
CREATE TABLE IF NOT EXISTS producto(
  id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(30) NOT NULL,
  descripcion VARCHAR(100) NOT NULL,
  precio DECIMAL NOT NULL,
  tipo_producto TINYINT UNSIGNED NOT NULL,
  CONSTRAINT fk_producto_tipo FOREIGN KEY (tipo_producto) REFERENCES tipo_producto(id)
);

/*TABLA 4 - RESERVA*/
CREATE TABLE IF NOT EXISTS reserva(
  id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  comensales TINYINT UNSIGNED NOT NULL,
  fecha_reserva DATETIME NOT NULL,
  codigo_reserva CHAR(9)
);

/*TABLA 5 - PEDIDO*/
CREATE TABLE IF NOT EXISTS pedido(
  id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_producto TINYINT UNSIGNED NOT NULL,
  CONSTRAINT fk_pedido_producto FOREIGN KEY (id_producto) REFERENCES producto(id)
);

/*TABLA 6 - ADMINISTRADOR*/
CREATE TABLE IF NOT EXISTS administrador(
  usuario VARCHAR(20) NOT NULL UNIQUE PRIMARY KEY,
  contrasenia VARCHAR(255) NOT NULL
);

INSERT INTO `administrador` (`usuario`, `contrasenia`) VALUES
  ('admin', MD5('admin'));

INSERT INTO `tipo_producto` (`id`, `nombre`) VALUES
  ('1', 'Entrantes'),
  ('2', 'Ensaladas'),
  ('3', 'Carnes'),
  ('4', 'Pescados'),
  ('5', 'Bebidas'),
  ('6', 'Postres'),;
