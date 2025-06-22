/*Usuarios*/
INSERT INTO Usuario(usuario, contrasena, tipo, bloqueado) VALUES('admin1', 'admin1', 'admin', 0);

/*Administrador*/
INSERT INTO Administrador(idUsuario, noEmpleado,nombre,paterno,materno,telefono,calle,colonia,CP,fechaNacimiento,correo,RFC, padecimientos) VALUES(1, 'A123456', 'alejandro', 'erreguin', 'franco', '5573705014', 'Av. del ferrocarril', 'marina nacional', '54190', '1999-10-23', 'yaef123@gmail.com', 'EEFY991023EW0', 'Con sueño todos los dias alb');



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

