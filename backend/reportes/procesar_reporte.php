<?php
    session_start();
    require_once "../../db/conection/conn.php";

    if (!isset($_SESSION['session']) || $_SESSION['session'] != 'admin' || !isset($_SESSION['noEmpleado'])) {
        echo "Error: Sesión de administrador no válida o incompleta.";
        exit;
    }
    
    $conexion = conectarBD();

    $noEmpleado = $_SESSION['noEmpleado'];
    $query_admin = "SELECT idAdmin FROM Administrador WHERE noEmpleado = ? LIMIT 1";
    $stmt_admin = mysqli_prepare($conexion, $query_admin);
    mysqli_stmt_bind_param($stmt_admin, "s", $noEmpleado);
    mysqli_stmt_execute($stmt_admin);
    $result_admin = mysqli_stmt_get_result($stmt_admin);

    if (mysqli_num_rows($result_admin) == 0) {
        echo "Error: No se pudo verificar la identidad del administrador.";
        desconectarBD($conexion);
        exit;
    }
    $admin_data = mysqli_fetch_assoc($result_admin);
    $idAdmin = $admin_data['idAdmin'];
    mysqli_stmt_close($stmt_admin);

    $idReporteConducta = $_POST['idReporteConducta'] ?? null;
    $comentarios = $_POST['comentarios'] ?? '';
    $asignarSancion = isset($_POST['asignarSancion']);
    
    if (!$idReporteConducta || $comentarios === '') {
        echo "Error: Faltan datos esenciales (ID de reporte o comentarios).";
        exit;
    }

    mysqli_autocommit($conexion, false);
    $error = false;
    $error_message = '';

    if ($asignarSancion) {
        $idSancion = $_POST['idSancion'] ?? '';
        $fechaInicio = $_POST['fechaInicio'] ?? '';
        $fechaFin = $_POST['fechaFin'] ?? '';

        if ($idSancion === '' || $fechaInicio === '' || $fechaFin === '') {
            $error = true;
            $error_message = "Error: Si asigna una sanción, todos los campos son requeridos.";
        }

        if (!$error) {
            $query_insert = "INSERT INTO ReporteSancion (idReporteConducta, idSancion, idAdmin, fechaInicio, fechaFin, comentarios) 
                             VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = mysqli_prepare($conexion, $query_insert);
            mysqli_stmt_bind_param($stmt_insert, "iiisss", $idReporteConducta, $idSancion, $idAdmin, $fechaInicio, $fechaFin, $comentarios);
            
            if (!mysqli_stmt_execute($stmt_insert)) {
                $error = true;
                $error_message = "No se pudo crear el reporte de sanción.";
            }
            mysqli_stmt_close($stmt_insert);
        }
    }
    
    if (!$error) {
        $query_update = "UPDATE ReporteConducta SET estado = 'resuelto' WHERE idReporteConducta = ?";
        $stmt_update = mysqli_prepare($conexion, $query_update);
        mysqli_stmt_bind_param($stmt_update, "i", $idReporteConducta);
        if (!mysqli_stmt_execute($stmt_update)) {
            $error = true;
            $error_message = "No se pudo actualizar el estado del reporte de conducta.";
        }
        mysqli_stmt_close($stmt_update);
    }
    
    if ($error) {
        mysqli_rollback($conexion);
        echo $error_message ?: "Error: No se pudieron guardar los cambios. La operación fue revertida.";
    } else {
        mysqli_commit($conexion);
        echo "OK";
    }

    desconectarBD($conexion);
?>
