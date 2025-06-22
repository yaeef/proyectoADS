<?php
    require "../db/conection/conn.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $conexion = conectarBD();
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $usuarioDB = validarUsuario($conexion,$usuario);

        

        if(!is_null($usuarioDB['usuario']))   //Si existe el usuario
        {
            if($usuarioDB['bloqueado'] == '0')  //Si el usuario no esta bloqueado
            {
                if($usuarioDB['contrasena'] == $password) //Si coincide la contraseña
                {
                    if($usuarioDB['tipo'] == "admin")
                    {
                        session_start();    //Creación de sesión
                        $_SESSION['usuario'] = $usuarioDB['usuario'];
                        $_SESSION['nombre'] = $usuarioDB['nombre'];
                        $_SESSION['paterno'] = $usuarioDB['paterno'];
                        $_SESSION['noEmpleado'] = $usuarioDB['noEmpleado'];
                        $_SESSION['session'] = 'admin';
                        
                        desconectarBD($conexion);
                        header("location:../frontend/admin.php");
                        exit();
                    }
                    if($usuarioDB['tipo'] == "docente")
                    {
                        
                    }
                    if($usuarioDB['tipo'] == "estudiante")
                    {
                        
                    }
                    if($usuarioDB['tipo'] == "tutor")
                    {
                        
                    }
                }
                else
                {
                    desconectarBD($conexion);
                    header("location:../frontend/login.php?notif=3");
                    exit();
                }

            }
            else
            {
                desconectarBD($conexion);
                header("location:../frontend/login.php?notif=2");
                exit();
            }

        }
        else
        {
            desconectarBD($conexion);
            header("location:../frontend/login.php?notif=1");
            exit();
        }

    }
    else #Aqui va a donde se redirige si  no se obtiene info mediante POST
    {
        header("location:../frontend/login.php?notif=0");
        exit();
    }
?>

