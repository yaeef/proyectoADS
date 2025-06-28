<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $nombre = $_POST['nombre'] ?? '';
    $grado = $_POST['grado'] ?? '';
    $tipo = $_POST['tipo'] ?? '';

    if ($nombre === '' || $grado === '' || $tipo === '') {
        echo "Faltan datos";
        exit;
    }

    $query = "INSERT INTO Materia(idGrado, nombre, tipo) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "iss", $grado, $nombre, $tipo);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al insertar: " . mysqli_error($conexion);
        exit;
    }

    desconectarBD($conexion);
    echo "OK";
?>
