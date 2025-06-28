<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $id = $_POST['idMateria'] ?? null;
    if (!$id) {
        echo "ID inválido";
        exit;
    }

    $query = "DELETE FROM Materia WHERE idMateria = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al eliminar";
        exit;
    }

    desconectarBD($conexion);
    echo "OK";
?>