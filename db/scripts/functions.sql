--Funciones

--Función que verifica la existencia de un usuario en la BD
CREATE FUNCTION existirUsuario( usuarioVerificar VARCHAR(50) ) 
RETURNS TINYINT
DETERMINISTIC
BEGIN
    DECLARE resultado TINYINT DEFAULT 0;
    IF EXISTS (SELECT 1 FROM Usuario WHERE usuario = usuarioVerificar) THEN
        SET resultado = 1;
    END IF;
    RETURN resultado;
END;

