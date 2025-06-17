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
        
        echo $password;
        echo $usuario;
        echo "PRE LOGIN, NECESITA TERMINAR DRIVER";
        desconectarBD($conexion);

    }



?>