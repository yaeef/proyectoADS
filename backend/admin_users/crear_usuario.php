<?php
require "../../db/conection/conn.php";
$conexion = conectarBD();

$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$paterno = $_POST['paterno'] ?? '';
$identificador = $_POST['noEmpleado'] ?? ($_POST['boleta'] ?? '');

if ($usuario === '' || $contrasena === '' || $tipo === '' || $nombre === '' || $paterno === '') {
    echo "Faltan datos obligatorios";
    exit;
}

// Insertar en Usuario
$insertUsuario = "INSERT INTO Usuario (usuario, contrasena, tipo, bloqueado) VALUES (?, ?, ?, 0)";
$stmt = mysqli_prepare($conexion, $insertUsuario);
mysqli_stmt_bind_param($stmt, "sss", $usuario, $contrasena, $tipo);
if (!mysqli_stmt_execute($stmt)) {
    echo "Error al insertar en Usuario: " . mysqli_error($conexion);
    exit;
}

$idUsuario = mysqli_insert_id($conexion);

// Insertar en tabla específica según tipo
switch ($tipo) {
    case 'admin':
        $query = "INSERT INTO Administrador (idUsuario, nombre, paterno, noEmpleado) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "isss", $idUsuario, $nombre, $paterno, $identificador);
        break;
    case 'docente':
        $query = "INSERT INTO Docente (idUsuario, nombre, paterno, noEmpleado, tipo) VALUES (?, ?, ?, ?, 'base')";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "isss", $idUsuario, $nombre, $paterno, $identificador);
        break;
    case 'estudiante':
        $query = "INSERT INTO Estudiante (idUsuario, nombre, paterno, boleta) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "isss", $idUsuario, $nombre, $paterno, $identificador);
        break;
    case 'tutor':
        $query = "INSERT INTO Tutor (idUsuario, nombre, paterno) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "iss", $idUsuario, $nombre, $paterno);
        break;
    default:
        echo "Tipo de usuario inválido";
        exit;
}

if (!mysqli_stmt_execute($stmt)) {
    echo "Error al insertar tipo $tipo: " . mysqli_error($conexion);
    exit;
}

desconectarBD($conexion);
echo "OK";
