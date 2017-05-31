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
  nombre VARCHAR(15) NOT NULL,
  is_delete CHAR(1) NOT NULL DEFAULT 0
);

/*TABLA 3 - HORA_RESERVA*/
CREATE TABLE IF NOT EXISTS hora_reserva(
  id_hora TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  hora CHAR(5) NOT NULL,
  is_delete CHAR(1) NOT NULL DEFAULT 0
);

/*TABLA 4 - ALERGENOS*/
CREATE TABLE IF NOT EXISTS alergenos(
  id_alergeno TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(15) NOT NULL,
  foto VARCHAR(100),
  is_delete CHAR(1) NOT NULL DEFAULT 0
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
  is_delete CHAR(1) NOT NULL DEFAULT 0,
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
  precio DOUBLE NOT NULL,
  codigo_pedido CHAR(9),
  CONSTRAINT fk_pedido_producto FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

/*TABLA 8 - PEDIDO_PRODUCTO*/
CREATE TABLE IF NOT EXISTS pedido_producto(
  id_pedido TINYINT UNSIGNED PRIMARY KEY,
  id_producto TINYINT UNSIGNED,
  cantidad_producto TINYINT,
  CONSTRAINT fk_pedido_id FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
  CONSTRAINT fk_producto_id FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

/*TABLA 9 - PRODUCTO_ALERGENO*/
CREATE TABLE IF NOT EXISTS producto_alergeno(
  id_producto TINYINT UNSIGNED PRIMARY KEY ,
  id_alergeno TINYINT UNSIGNED,
  CONSTRAINT  fk_producto_id FOREIGN KEY (id_producto) REFERENCES pedido(id_pedido),
  CONSTRAINT  fk_alergeno_id FOREIGN KEY (id_alergeno) REFERENCES alergenos(id_alergeno)
);

/*TABLA 10 - RESERVA_ALERGENO*/
CREATE TABLE IF NOT EXISTS reserva_alergeno(
  id_reserva TINYINT UNSIGNED PRIMARY KEY,
  id_alergeno TINYINT UNSIGNED,
  CONSTRAINT fk_reserva_id FOREIGN KEY (id_reserva) REFERENCES reserva(id_reserva),
  CONSTRAINT fk_alergeno_id FOREIGN KEY (id_alergeno) REFERENCES alergenos(id_alergeno)
);

/*TABLA 11 - ADMINISTRADOR*/
CREATE TABLE IF NOT EXISTS administrador(
  usuario VARCHAR(20) NOT NULL UNIQUE PRIMARY KEY,
  contrasenia VARCHAR(255) NOT NULL
);

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

INSERT INTO `alergenos` (`id_alergeno`, `nombre`, `foto`) VALUES
  ('1', 'altramuces', 'alergenos-altramuces.png'),
  ('2', 'apio', 'alergenos-apio.png'),
  ('3', 'cacahuetes', 'alergenos-cacahuetes.png'),
  ('4', 'crustaceos', 'alergenos-crustaceos.png'),
  ('5', 'frutos secos', 'alergenos-frutos.png'),
  ('6', 'gluten', 'alergenos-gluten.png'),
  ('7', 'huevo', 'alergenos-huevo.png'),
  ('8', 'leche', 'alergenos-leche.png'),
  ('9', 'moluscos', 'alergenos-moluscos.png'),
  ('10', 'mostaza', 'alergenos-mostaza.png'),
  ('11', 'pescado', 'alergenos-pescado.png'),
  ('12', 'sesamo', 'alergenos-sesamo.png'),
  ('13', 'soja', 'alergenos-soja.png'),
  ('14', 'sulfito', 'alergenos-sulfito.png');