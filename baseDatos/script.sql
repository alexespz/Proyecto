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
  icono VARCHAR(100) NOT NULL,
  is_delete CHAR(1) NOT NULL DEFAULT 0
);

/*TABLA 3 - HORA_RESERVA*/
CREATE TABLE IF NOT EXISTS hora_reserva(
  id_hora TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  hora CHAR(5) NOT NULL,
  is_delete CHAR(1) NOT NULL DEFAULT 0
);

/*TABLA 4 - ALERGENOS*/
CREATE TABLE IF NOT EXISTS alergeno(
  id_alergeno TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(15) NOT NULL,
  foto VARCHAR(100) DEFAULT NULL,
  is_delete CHAR(1) NOT NULL DEFAULT 0
);

/*TABLA 5 - PRODUCTO*/
CREATE TABLE IF NOT EXISTS producto(
  id_producto TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(30) NOT NULL,
  descripcion VARCHAR(100),
  precio DOUBLE NOT NULL,
  foto VARCHAR(100) DEFAULT NULL,
  calorias SMALLINT UNSIGNED DEFAULT NULL,
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
  codigo_reserva CHAR(9) NOT NULL,
  CONSTRAINT fk_hora_reserva FOREIGN KEY (hora_reserva) REFERENCES hora_reserva(id_hora),
  CONSTRAINT fk_reserva_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

/*TABLA 7 - PEDIDO*/
CREATE TABLE IF NOT EXISTS pedido(
  id_pedido TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_usuario TINYINT UNSIGNED NOT NULL,
  precio DOUBLE NOT NULL,
  codigo_pedido CHAR(9) NOT NULL,
  CONSTRAINT fk_pedido_producto FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

/*TABLA 8 - PEDIDO_PRODUCTO*/
CREATE TABLE IF NOT EXISTS pedido_producto(
  id_pedido_producto TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_pedido TINYINT UNSIGNED NOT NULL,
  id_producto TINYINT UNSIGNED NOT NULL,
  cantidad_producto TINYINT NOT NULL,
  CONSTRAINT fk_pedido_id FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
  CONSTRAINT fk_producto_id FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

/*TABLA 9 - PRODUCTO_ALERGENO*/
CREATE TABLE IF NOT EXISTS producto_alergeno(
  id_producto_alergeno TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_producto TINYINT UNSIGNED,
  id_alergeno TINYINT UNSIGNED,
  CONSTRAINT fk_productoA_id FOREIGN KEY (id_producto) REFERENCES producto(id_producto),
  CONSTRAINT fk_alergenoA_id FOREIGN KEY (id_alergeno) REFERENCES alergeno(id_alergeno)
);

/*TABLA 10 - RESERVA_ALERGENO*/
CREATE TABLE IF NOT EXISTS reserva_alergeno(
  id_reserva_alergeno TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  id_reserva TINYINT UNSIGNED,
  id_alergeno TINYINT UNSIGNED,
  CONSTRAINT fk_reserva_id FOREIGN KEY (id_reserva) REFERENCES reserva(id_reserva),
  CONSTRAINT fk_alergeno_id FOREIGN KEY (id_alergeno) REFERENCES alergeno(id_alergeno)
);

/*TABLA 11 - ADMINISTRADOR*/
CREATE TABLE IF NOT EXISTS administrador(
  usuario VARCHAR(20) NOT NULL PRIMARY KEY,
  contrasenia VARCHAR(255) NOT NULL
);

INSERT INTO `tipo_producto` (`id_tipo_producto`, `nombre`, `icono`) VALUES
  ('1', 'Entrantes', 'cheese.png'),
  ('2', 'Ensaladas', 'salad.png'),
  ('3', 'Carnes', 'meat.png'),
  ('4', 'Pescados', 'salmon.png'),
  ('5', 'Bebidas', 'cocktail.png'),
  ('6', 'Postres', 'ice-cream-1.png');

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

INSERT INTO `alergeno` (`id_alergeno`, `nombre`, `foto`) VALUES
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

INSERT INTO `producto` (`id_producto`, `nombre`, `descripcion`, `precio`, `foto`, `calorias`, `tipo_producto`, `is_delete`) VALUES
  ('1', 'Surtido Ibérico', 'Surtido variado ibérico', '4', 'Surtido_de_Ibericos.jpg', '1200', '1', 0),
  ('2', 'Croquetas Caseras', 'Croqueras caseras', '3', 'croquetas.jpg', '800', '1', 0),
  ('3', 'Tabla de queso', 'Tabla de quesos', '3', 'tabladequesos.jpg', '400', '1' , 0),
  ('4', 'Esparragos verdes', 'Esparragos verdes naturales a la plancha', '5', 'esparrago-verde.jpg', '300', '1' , 0),
  ('5', 'Ensalada Mixta', 'Ensalada mixta', '5.20', 'ensaladamixta.jpg', '200', '2', 0),
  ('6', 'Ensalada Cesar', 'Ensalada cesar', '7.20', 'ensalada-cesar.jpg', '400', '2', 0),
  ('7', 'Ensalada Griega', 'Ensalada griega', '7.20', 'ensalada-griega.jpg', '400', '2', 0),
  ('8', 'Ensalada Gourmet', 'Ensalada gourmet', '11.00', 'Ensalada-gourmet.jpg', '400', '2', 0),
  ('9', 'Solomillo al Roquefort', 'Solomillo al roquefort', '13.90', 'solomillo-roquefort.jpg', '900', '3', 0),
  ('10', 'Secreto Ibérico', 'Secreto ibérico', '14.70', 'secreto-iberico.jpg', '900', '3', 0),
  ('11', 'Chulentón de ternera', 'chuleton de ternera', '17.90', 'chuleton.jpg', '900', '3', 0),
  ('12', 'Manitas de cerdo', 'manitas de cerdo', '16.90', null, '900', '3', 0),
  ('13', 'Bacalado a la Nata', 'Bacalado a la nata', '14.60', 'bacalao-nata.jpg', '800', '4', 0),
  ('14', 'Merluza a la Plancha', 'Merluza a la plancha', '13.90', 'merluza-plancha.jpg', '600', '4', 0),
  ('15', 'Chipirones rellenos', 'chipirones rellenos', '19.60', 'chipirones-rellenos.jpg', '800', '4', 0),
  ('16', 'Lubina a la sal', 'Lubina a la sal', '22.60', 'lubina_dorada_sal.jpg', '800', '4', 0),
  ('17', 'Jarra Cerveza 1/2 L', 'Jarra de cerveza de medio litro', '2', 'cerveza.jpg', '80', '5', 0),
  ('18', 'CocaCola', 'CocaCola normal', '1.20', 'cocacola.jpg', '150', '5', 0),
  ('19', 'Fanta de naranja', 'Fanta de naranja', '1.60', 'fanta-naranja.jpg', '80', '5', 0),
  ('20', 'Nestea', 'nestea', '1.30', 'nestea.jpg', '80', '5', 0),
  ('21', 'Copa de Chocolate', 'Copa de helado de chocolate', '2', 'copa-chocolate.jpg', '400', '6', 0),
  ('22', 'Flan Casero', 'Flan casero de huevo', '2.50', 'flan.jpg', '240', '6', 0),
  ('23', 'Natillas', 'natillas', '3', 'natillas.jpg', '400', '6', 0),
  ('24', 'Tarta de queso', 'tarta de queso', '3.50', 'tarta-queso.jpg', '400', '6', 0);

INSERT INTO `producto_alergeno` VALUES
  ('1', '2', '6'),
  ('2', '2', '8'),
  ('3', '5', '8'),
  ('4', '6', '6'),
  ('5', '7', '7'),
  ('6', '7', '9'),
  ('7', '7', '11'),
  ('8', '8', '9'),
  ('9', '8', '11'),
  ('10', '12', '7'),
  ('11', '12', '8'),
  ('12', '12', '13');
