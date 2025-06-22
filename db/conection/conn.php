<?php
	require "env.php";
	#Funcion para crear conexion y retornarla
	function conectarBD()
	{
		global $server;
		global $user;
		global $password;
		global $database;
	
		$conexion = mysqli_connect($server, $user, $password, $database);
		
		if(!$conexion)
		{
			die("Conexion Fallida a MYSQL | " . mysqli_connect_error());
		}
		else
		{
			#echo "Conectado :)";
			return $conexion;
		}
	}

	#Funcion para cerrar alguna conexion existente
	function desconectarBD($conexion)
	{
		mysqli_close($conexion);
	}

	#Función que recupera los datos importantes del admin para crear sesion
	function recuperarAdminConUsuario($conexion, $usuario)
	{
		$query = "SELECT Usuario.idUsuario, Administrador.idAdmin , usuario, contrasena, bloqueado, noEmpleado FROM Usuario INNER JOIN Administrador ON Usuario.usuario = '$usuario';";
		$resultado = mysqli_query($conexion,$query);

		if($resultado)
        {
            $fila = mysqli_fetch_assoc($resultado);

            if($fila == NULL)
            {
                return null;
            }
            return $fila;
        }
        else
        {
            echo "Error al recuperar Administrador de la BD: " . mysqli_error($conexion);
            return null;
        }
	}

	#Función que busca un usuario en la BD y si lo encuentra retorna sus datos dependiendo el tipo de usuario
	function validarUsuario($conexion, $usuario)
	{
		$query = "CALL buscarUsuario('$usuario');";
		$resultado = mysqli_query($conexion,$query);

		if($resultado)
		{
			$fila = mysqli_fetch_assoc($resultado);
			if(is_null($fila['usuario']))
			{
				return null;
			}
			return $fila;
		}
		else
		{
			echo "Error al recuperar Usuario de la BD: " . mysqli_error($conexion);
            return null;
		}
	}
?>
