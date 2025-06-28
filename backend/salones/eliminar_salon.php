<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $id = $_POST['idSalon'] ?? null;
    if (!$id) {
        echo "ID inválido";
        exit;
    }

    $query = "DELETE FROM Salon WHERE idSalon = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al eliminar";
        exit;
    }

    desconectarBD($conexion);
    echo "OK";
?>