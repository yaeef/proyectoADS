<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $idSancion = $_POST['idSancion'] ?? null;
    $descripcion = $_POST['descripcion'] ?? '';
    $duracionDias = $_POST['duracionDias'] ?? '';
    $gravedad = $_POST['gravedad'] ?? '';

    if (!$idSancion || $descripcion === '' || $duracionDias === '' || !in_array($gravedad, ['leve', 'moderada', 'grave'])) {
        echo "Error: Datos incompletos o inválidos.";
        exit;
    }

    $query = "UPDATE Sancion 
    SET descripcion = ?, 
    duracionDias = ?, 
    gravedad = ? 
    WHERE idSancion = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sisi", $descripcion, $duracionDias, $gravedad, $idSancion);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al actualizar la sanción.";
        exit;
    }

    mysqli_stmt_close($stmt);
    desconectarBD($conexion);
    echo "OK";
?>