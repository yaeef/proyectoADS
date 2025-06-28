<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $id = $_POST['idSalon'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $capacidad = $_POST['capacidad'] ?? '';
    $tipo = $_POST['tipo'] ?? '';

    if (!$id || $nombre === '' || $capacidad === '' || $tipo === '') {
        echo "Datos incompletos";
        exit;
    }

    $query = "UPDATE Salon SET nombre = ?, capacidad = ?, tipo = ? WHERE idSalon = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sisi", $nombre, $capacidad, $tipo, $id);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al actualizar";
        exit;
    }

    desconectarBD($conexion);
    echo "OK";
?>