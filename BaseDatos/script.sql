/*SCRIPT PARA LA BASE DE DATOS */

CREATE DATABASE IF NOT EXISTS restaurante;
USE restaurante;

/*TABLA 1 - USUARIOS*/
CREATE TABLE IF NOT EXISTS usuarios(
  id_usuario TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(20) NOT NULL,
  apellidos VARCHAR(40) NOT NULL,
  dni CHAR(9) NOT NULL UNIQUE,
  telefono VARCHAR(9) NOT NULL UNIQUE,
  sexo CHAR(1) NOT NULL,
  usuario VARCHAR(25) NOT NULL UNIQUE,
  contrasenia VARCHAR(255) NOT NULL,
  email VARCHAR(60) NOT NULL UNIQUE,
  contador_pedidos TINYINT UNSIGNED DEFAULT 0
);

/*TABLA 2 - TIPO_PRODUCTO*/
CREATE TABLE IF NOT EXISTS tipo_producto(
  id_tipo_producto TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(15) NOT NULL
);

/*TABLA 3 - HORA_RESERVA*/
CREATE TABLE IF NOT EXISTS hora_reserva(
  id_hora TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  hora CHAR(5) NOT NULL
);

/*TABLA 4 - ALERGENOS*/
CREATE TABLE IF NOT EXISTS alergenos(
  id_alergeno TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(15);
  foto VARCHAR(100);
);

/*TABLA 5 - PRODUCTO*/
CREATE TABLE IF NOT EXISTS producto(
  id_producto TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(30) NOT NULL,
  descripcion VARCHAR(100),
  precio DOUBLE NOT NULL,
  foto VARCHAR(100),
  calorias TINYINT UNSIGNED,
  tipo_producto TINYINT UNSIGNED NOT NULL,
  CONSTRAINT fk_producto_tipo FOREIGN KEY (tipo_producto) REFERENCES tipo_producto(id_tipo_producto)
);

/*TABLA 6 - RESERVA*/
CREATE TABLE IF NOT EXISTS reserva(
  id_reserva TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_usuario TINYINT UNSIGNED NOT NULL,
  comensales TINYINT UNSIGNED NOT NULL,
  fecha_reserva DATE NOT NULL,
  hora_reserva TINYINT UNSIGNED NOT NULL,
  codigo_reserva CHAR(9),
  CONSTRAINT fk_hora_reserva FOREIGN KEY (hora_reserva) REFERENCES hora_reserva(id_hora),
  CONSTRAINT fk_reserva_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

/*TABLA 7 - PEDIDO*/
CREATE TABLE IF NOT EXISTS pedido(
  id_pedido TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_usuario TINYINT UNSIGNED NOT NULL,
  id_producto TINYINT UNSIGNED NOT NULL,
  gestionado BOOLEAN NOT NULL DEFAULT FALSE,
  CONSTRAINT fk_pedido_producto FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

/*TABLA 8 - PEDIDO_PRODUCTO*/
CREATE TABLE IF NOT EXISTS pedido_producto(
  id_pedido TINYINT UNSIGNED PRIMARY KEY,
  id_producto TINYINT UNSIGNED,
  CONSTRAINT fk_pedido_id FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
  CONSTRAINT fk_producto_id FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

/*TABLA 9 - ADMINISTRADOR*/
CREATE TABLE IF NOT EXISTS administrador(
  usuario VARCHAR(20) NOT NULL UNIQUE PRIMARY KEY,
  contrasenia VARCHAR(255) NOT NULL
);

INSERT INTO `administrador` (`usuario`, `contrasenia`) VALUES
  ('admin', MD5('admin'));

INSERT INTO `tipo_producto` (`id_tipo_producto`, `nombre`) VALUES
  ('1', 'Entrantes'),
  ('2', 'Ensaladas'),
  ('3', 'Carnes'),
  ('4', 'Pescados'),
  ('5', 'Bebidas'),
  ('6', 'Postres');

INSERT INTO `hora_reserva` (`id_hora`, `hora`) VALUES
  ('1', '13:00'),
  ('2', '13:15'),
  ('3', '13:30'),
  ('4', '13:45'),
  ('5', '14:00'),
  ('6', '14:15'),
  ('7', '14:30'),
  ('8', '14:45'),
  ('9', '15:00'),
  ('10', '15:15'),
  ('11', '15:30');
