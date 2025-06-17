<?php
    require "../db/conection/con.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        #MANEJO DE NOTIFICACIONES
        #if(!isset($_POST['usuario'])) {header("location:../frontend/admin.php?notif=-3");}
        #if(!isset($_POST['password'])) {header("location:../frontend/admin.php?notif=-3");}

        $conexion = conectarBD();
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $existeUsuario = evaluarExistenciaUsuario($conexion,$usuario);

        if($existeUsuario)
        {
            $admin = recuperarAdminConUsuario($conexion, $usuario);
            if($password == $admin['contrasena'])
            {
                echo "Acceso autorizado";
                echo $usuario;


                #SE DEBE INICIAR SESION


                #Quitar comentarios cuando ya se tenga a donde ir con header
                desconectarBD($conexion);
                #header("location:");
                #exit();

            }
            else
            {
                echo "Existe usuario pero contraseña incorrecta";
                #Quitar comentarios cuando ya se tenga a donde ir con header
                desconectarBD($conexion);
                #header("location:");
                #exit();
            }

        }
        else
        {
            echo "No existe el usuario :(";
            #Quitar comentarios cuando ya se tenga a donde ir con header
            desconectarBD($conexion);
            #header("location:");
            #exit();
        }

    }
    else #Aqui va a donde se redirige si  no se obtiene info mediante POST
    {
        exit();
    }



?>

