<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $id = $_POST['idMateria'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $grado = $_POST['grado'] ?? '';
    $tipo = $_POST['tipo'] ?? '';

    if (!$id || $nombre === '' || $grado === '' || $tipo === '') {
        echo "Datos incompletos\n";
        echo $id;
        echo $nombre;
        echo $grado;
        echo $tipo;
        exit;
    }

    $query = "UPDATE Materia SET nombre = ?, idGrado = ?, tipo = ? WHERE idMateria = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sisi", $nombre, $grado, $tipo, $id);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al actualizar";
        exit;
    }

    desconectarBD($conexion);
    echo "OK";
?>