/*Usuarios*/
INSERT INTO Usuario(usuario, contrasena, tipo, bloqueado) VALUES('admin1', 'admin1', 'admin', 0);
INSERT INTO Usuario(usuario, contrasena, tipo, bloqueado) VALUES('docente1', 'docente1', 'docente', 0);

/*Administrador*/
INSERT INTO Administrador(idUsuario, noEmpleado,nombre,paterno,materno,telefono,calle,colonia,CP,fechaNacimiento,correo,RFC, padecimientos) VALUES(1, 'A123456', 'alejandro', 'erreguin', 'franco', '5573705014', 'Av. del ferrocarril', 'marina nacional', '54190', '1999-10-23', 'yaef123@gmail.com', 'EEFY991023EW0', 'Con sueño todos los dias alb');
INSERT INTO Docente(idUsuario, noEmpleado,nombre,paterno,materno,telefono,calle,colonia,CP,fechaNacimiento,correo,RFC, padecimientos) VALUES(2, 'D123456', 'pablo', 'gomez', 'martinez', '5512345678', 'lago de patzcuaro', 'la laguna', '54190', '1987-07-21', 'pablo12345@gmail.com', 'GOMP870721AL6', 'Sin padecimientos');



/*Salones*/
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('1SA', '60', 'salon');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('1SB', '60', 'salon');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('1SC', '60', 'salon');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('2SA', '30', 'salon');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('2SB', '30', 'salon');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('2SC', '30', 'salon');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('3SA', '30', 'salon');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('3SB', '30', 'salon');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('3SC', '30', 'salon');

INSERT INTO Salon(nombre, capacidad, tipo) VALUES('1TA', '60', 'taller');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('1TB', '60', 'taller');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('1TC', '60', 'taller');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('2TA', '30', 'taller');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('2TB', '30', 'taller');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('2TC', '30', 'taller');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('3TA', '30', 'taller');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('3TB', '30', 'taller');
INSERT INTO Salon(nombre, capacidad, tipo) VALUES('3TC', '30', 'taller');

/*Grados*/
INSERT INTO Grado(grado) VALUES(1);
INSERT INTO Grado(grado) VALUES(2);
INSERT INTO Grado(grado) VALUES(3);

/*Materias*/
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'MATEMATICAS I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'ESPAÑOL I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'CIENCIAS NATURALES I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'GEOGRAFIA I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'FORMACION CIVICA Y ETICA I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'INGLES I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'COMPUTACION', 'taller');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'ARTE', 'taller');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('1', 'DEPORTE', 'taller');

INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'MATEMATICAS II', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'ESPAÑOL II', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'BIOLOGIA I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'HISTORIA I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'FORMACION CIVICA Y ETICA II', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'INGLES II', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'ROBOTICA', 'taller');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'MUSICA', 'taller');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('2', 'DEPORTE', 'taller');

INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'MATEMATICAS III', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'ESPAÑOL III', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'QUIMICA I', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'HISTORIA II', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'FORMACION CIVICA Y ETICA III', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'INGLES III', 'general');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'PROGRAMACION', 'taller');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'TEATRO', 'taller');
INSERT INTO Materia(idGrado,nombre,tipo) VALUES('3', 'DEPORTE', 'taller');
