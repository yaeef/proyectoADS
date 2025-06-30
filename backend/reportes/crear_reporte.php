<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

   
    $idEstudiante = $_POST['idEstudiante'] ?? '';
    $idDocente = $_POST['idDocente'] ?? '';
    $fechaIncidente = $_POST['fechaIncidente'] ?? '';
    $motivo = $_POST['motivo'] ?? '';
    $detalles = $_POST['detalles'] ?? '';

    
    if(empty($idEstudiante) || empty($idDocente) || empty($fechaIncidente) || empty($motivo) || empty($detalles)) {
        echo "Error: Todos los campos son obligatorios.";
        exit;
    }

    
    $result_periodo = mysqli_query($conexion, 
    "SELECT idPeriodo 
    FROM Periodo 
    WHERE estado = 'activo' 
    LIMIT 1");
    if(mysqli_num_rows($result_periodo) == 0) {
        echo "Error: No se encontró un periodo escolar activo en el sistema.";
        exit;
    }
    $periodo = mysqli_fetch_assoc($result_periodo);
    $idPeriodo = $periodo['idPeriodo'];

    $query = "INSERT INTO ReporteConducta
    (idEstudiante, idDocente, idPeriodo, fechaIncidente, motivo, detalles) 
    VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "iiisss", $idEstudiante, $idDocente, $idPeriodo, $fechaIncidente, $motivo, $detalles);

    if (mysqli_stmt_execute($stmt)) {
        echo "OK";
    } else {
        echo "Error al guardar en la base de datos.";
    }

    mysqli_stmt_close($stmt);
    desconectarBD($conexion);
?>
