<?php
    require "../../db/conection/conn.php";
    $conexion = conectarBD();

    $idUsuario = $_POST['idUsuario'] ?? null;

    if (!$idUsuario) 
    {
        echo "ID inválido";
        exit;
    }
    // Borrar de tabla principal
    mysqli_query($conexion, "DELETE FROM Usuario WHERE idUsuario = $idUsuario");

    desconectarBD($conexion);
    echo "OK";
?>
