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

	#Función para evaluar si un usuario existe en la BD
	function evaluarExistenciaUsuario($conexion, $usuario)
	{
		$param = mysqli_real_escape_string($conexion, $usuario);
		$query = "SELECT existirUsuario('$usuario') AS resultado;";
		$resultado = mysqli_query($conexion, $query);

		if($resultado)
		{
			$fila = mysqli_fetch_assoc($resultado);
			$valor = $fila["resultado"];
			return ($valor == 1) ? 1 : 0;
		}
		else
		{
			die("Consulta fallida de evaluación de existencias a MySQL: ". mysqli_error($conexion));
		}
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

?>
