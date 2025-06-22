--Funciones






--STORE PROCEDURES

--Función que me retorna información de un usuario en caso de existir
CREATE PROCEDURE buscarUsuario(IN usuarioBuscar VARCHAR(50))
BEGIN
    DECLARE v_idUsuario INT;
    DECLARE v_tipo ENUM('admin', 'docente', 'estudiante', 'tutor');
    DECLARE EXIT HANDLER FOR NOT FOUND
        SELECT NULL AS usuario, NULL AS contrasena, NULL AS tipo, NULL AS nombre, NULL AS paterno;

    -- Verificar si el usuario existe
    SELECT idUsuario, tipo INTO v_idUsuario, v_tipo
    FROM Usuario
    WHERE usuario = usuarioBuscar;

    -- Devolver los datos según el tipo de usuario
    IF v_tipo = 'admin' THEN
        SELECT u.usuario, u.contrasena, u.tipo, u.bloqueado, a.nombre, a.paterno, a.noEmpleado
        FROM Usuario u
        JOIN Administrador a ON a.idUsuario = u.idUsuario
        WHERE u.idUsuario = v_idUsuario;

    ELSEIF v_tipo = 'docente' THEN
        SELECT u.usuario, u.contrasena, u.tipo, u.bloqueado, d.nombre, d.paterno, d.noEmpleado, d.tipo
        FROM Usuario u
        JOIN Docente d ON d.idUsuario = u.idUsuario
        WHERE u.idUsuario = v_idUsuario;

    ELSEIF v_tipo = 'estudiante' THEN
        SELECT u.usuario, u.contrasena, u.tipo, u.bloqueado, e.nombre, e.paterno, e.boleta
        FROM Usuario u
        JOIN Estudiante e ON e.idUsuario = u.idUsuario
        WHERE u.idUsuario = v_idUsuario;

    ELSEIF v_tipo = 'tutor' THEN
        SELECT u.usuario, u.contrasena, u.tipo, u.bloqueado, t.nombre, t.paterno
        FROM Usuario u
        JOIN Tutor t ON t.idUsuario = u.idUsuario
        WHERE u.idUsuario = v_idUsuario;
    END IF;
END;
