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

?>
