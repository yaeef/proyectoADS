<?php
    require "../../db/conection/conn.php";
    $conexion = conectarBD();


    $idUsuario = (int)$_POST['idUsuario'] ?? null;
    $tipo = $_POST['tipoActualizacion'];
    if($tipo === 'admin')
    {
        $idAdmin = $_POST['idAdmin'];
    }
    else if($tipo === 'docente')
    {
        $idDocente = $_POST['idDocente'];
    }
    else if($tipo === 'estudiante')
    {
        $idDocente = $_POST['idEstudiante'];
    }/*Falta tutor y caso donde no se reciba*/ 

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $bloqueado = (int)$_POST['bloqueado'];
    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $cp = $_POST['CP'];
    $nacimiento = $_POST['fechaNacimiento'];
    $correo = $_POST['correo'];

    /*Variables generales*/ 
    if (!$idUsuario || $usuario === '' || $contrasena === '' || $bloqueado === '' || $nombre === '' || $paterno === '' || $materno === '' || $calle === '' || $colonia === '' || $cp === '' || $nacimiento === '' || $correo === '') 
    {
        echo "Datos incompletos";
        exit;
    }

    $queryU = "UPDATE Usuario SET usuario = ?, contrasena = ?, bloqueado = ? WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conexion, $queryU);
    mysqli_stmt_bind_param($stmt, "ssii", $usuario, $contrasena, $bloqueado, $idUsuario);
    mysqli_stmt_execute($stmt);

    switch ($tipo) {
        case 'admin':
            $idAdmin = $_POST['idAdmin'];
            $noEmpleado = $_POST['noEmpleado'];
            $telefono = $_POST['telefono'];
            $rfc = $_POST['rfc'];
            $padecimientos = $_POST['padecimientos'];

            $query = "UPDATE Administrador SET noEmpleado = ?, nombre = ?, paterno = ? , materno = ?, telefono = ?, calle = ?, colonia = ?, cp = ?, fechaNacimiento = ?, correo = ?, RFC = ?, padecimientos = ? WHERE idAdmin = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "ssssssssssssi", $noEmpleado, $nombre, $paterno, $materno, $telefono, $calle, $colonia, $cp, $nacimiento, $correo, $rfc, $padecimientos, $idAdmin);
            mysqli_stmt_execute($stmt);
            break;
        case 'docente':
            $idDocente = $_POST['idDocente'];
            $noEmpleado = $_POST['noEmpleado'];
            $telefono = $_POST['telefono'];
            $rfc = $_POST['rfc'];
            $tipoDocente = $_POST['tipo'];
            $padecimientos = $_POST['padecimientos'];

            $query = "UPDATE Docente SET noEmpleado = ?, nombre = ?, paterno = ? , materno = ?, telefono = ?, calle = ?, colonia = ?, cp = ?, fechaNacimiento = ?, correo = ?, RFC = ?, tipo = ?, padecimientos = ? WHERE idDocente = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "sssssssssssssi", $noEmpleado, $nombre, $paterno, $materno, $telefono, $calle, $colonia, $cp, $nacimiento, $correo, $rfc, $tipoDocente, $padecimientos, $idDocente);
            mysqli_stmt_execute($stmt);
            break;
        case 'estudiante':
            $idEstudiante = $_POST['idEstudiante'];
            $boleta = $_POST['boleta'];
            $curp = $_POST['curp'];
            $padecimientos = $_POST['padecimientos'];

            $query = "UPDATE Estudiante SET boleta = ?, nombre = ?, paterno = ? , materno = ?, calle = ?, colonia = ?, cp = ?, fechaNacimiento = ?, correo = ?, CURP = ?, padecimientos = ? WHERE idEstudiante = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "sssssssssssi", $boleta, $nombre, $paterno, $materno, $calle, $colonia, $cp, $nacimiento, $correo, $curp, $padecimientos, $idEstudiante);
            mysqli_stmt_execute($stmt);
            break;
        case 'tutor':
            $idTutor = $_POST['idTutor'];
            $telefono = $_POST['telefono'];
            $rfc = $_POST['rfc'];

            $query = "UPDATE Tutor SET nombre = ?, paterno = ? , materno = ?, calle = ?, colonia = ?, cp = ?, fechaNacimiento = ?, correo = ?, telefono = ?, RFC = ? WHERE idTutor = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "ssssssssssi", $nombre, $paterno, $materno, $calle, $colonia, $cp, $nacimiento, $correo, $telefono, $rfc, $idTutor);
            mysqli_stmt_execute($stmt);
            break;
        default:
            echo "Tipo no válido";
            exit;
    }

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al actualizar";
        exit;
    }

    desconectarBD($conexion);
    echo "OK";
?>
