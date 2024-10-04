
CREATE DATABASE banco;

USE banco;

CREATE TABLE usuarios (
  id_usuario INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  contraseña VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_usuario)
);


CREATE TABLE cuentas (
  id_cuenta INT(11) NOT NULL AUTO_INCREMENT,
  id_usuario INT(11) DEFAULT NULL,
  saldo DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (id_cuenta),
  KEY fk_id_usuario (id_usuario),
  CONSTRAINT fk_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE transferencias (
  id_transferencia INT(11) NOT NULL AUTO_INCREMENT,
  cantidad DECIMAL(10,2) NOT NULL,
  id_remitente INT(11) DEFAULT NULL,
  id_cuentadestino INT(11) DEFAULT NULL,
  PRIMARY KEY (id_transferencia),
  KEY fk_id_remitente (id_remitente),
  KEY fk_id_cuentadestino (id_cuentadestino),
  CONSTRAINT fk_id_remitente FOREIGN KEY (id_remitente) REFERENCES cuentas (id_cuenta) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_id_cuentadestino FOREIGN KEY (id_cuentadestino) REFERENCES cuentas (id_cuenta) ON UPDATE RESTRICT ON DELETE RESTRICT
);