<?php
require "../../db/conection/conn.php";
$conexion = conectarBD();

$idUsuario = $_POST['idUsuario'] ?? null;
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$paterno = $_POST['paterno'] ?? '';
$identificador = $_POST['identificador'] ?? '';

if (!$idUsuario || $usuario === '' || $contrasena === '' || $nombre === '' || $paterno === '') {
    echo "Datos incompletos";
    exit;
}

// tipo original
$q = mysqli_query($conexion, "SELECT tipo FROM Usuario WHERE idUsuario = $idUsuario");
$tipo = mysqli_fetch_assoc($q)['tipo'] ?? '';

mysqli_query($conexion, "UPDATE Usuario SET usuario = '$usuario', contrasena = '$contrasena' WHERE idUsuario = $idUsuario");

switch ($tipo) {
    case 'admin':
        $query = "UPDATE Administrador SET nombre = ?, paterno = ?, noEmpleado = ? WHERE idUsuario = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nombre, $paterno, $identificador, $idUsuario);
        break;
    case 'docente':
        $query = "UPDATE Docente SET nombre = ?, paterno = ?, noEmpleado = ? WHERE idUsuario = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nombre, $paterno, $identificador, $idUsuario);
        break;
    case 'estudiante':
        $query = "UPDATE Estudiante SET nombre = ?, paterno = ?, boleta = ? WHERE idUsuario = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nombre, $paterno, $identificador, $idUsuario);
        break;
    case 'tutor':
        $query = "UPDATE Tutor SET nombre = ?, paterno = ? WHERE idUsuario = ?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $paterno, $idUsuario);
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
