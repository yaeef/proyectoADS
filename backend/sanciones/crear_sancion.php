<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $descripcion = $_POST['descripcion'] ?? '';
    $duracionDias = $_POST['duracionDias'] ?? '';
    $gravedad = $_POST['gravedad'] ?? '';

    if ($descripcion === '' || $duracionDias === '' || !in_array($gravedad, ['leve', 'moderada', 'grave'])) {
        echo "Error: Todos los campos son requeridos y deben ser válidos.";
        exit;
    }

    $query = "INSERT INTO Sancion
    (descripcion, duracionDias, gravedad) 
    VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sis", $descripcion, $duracionDias, $gravedad);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al insertar la sanción: " . mysqli_stmt_error($stmt);
        exit;
    }

    mysqli_stmt_close($stmt);
    desconectarBD($conexion);
    echo "OK";
?>
