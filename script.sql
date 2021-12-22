CREATE TABLE usuario(
idusuario int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
usuario VARCHAR(20) NOT NULL,
clave VARCHAR(20) NOT NULL
);

INSERT INTO usuario(usuario,clave) VALUES
("admin", "admin1"),
("pepe", "pepe1");

CREATE TABLE tarea(
idtarea int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR(100) NOT NULL,
contenido VARCHAR(500) NOT NULL,
fecharegistro DATE NOT NULL,
fechavencimiento DATE NOT NULL,
prioridad VARCHAR(20) NOT NULL,
estado VARCHAR(20) NOT NULL,
idusuario int(10) unsigned NOT NULL
);