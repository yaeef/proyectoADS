<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$nombre = $_POST['nombre'] ?? '';
$capacidad = $_POST['capacidad'] ?? '';
$tipo = $_POST['tipo'] ?? '';

if ($nombre === '' || $capacidad === '' || $tipo === '') {
    echo "Faltan datos";
    exit;
}

$query = "INSERT INTO salon (nombre, capacidad, tipo) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "sis", $nombre, $capacidad, $tipo);

if (!mysqli_stmt_execute($stmt)) {
    echo "Error al insertar: " . mysqli_error($conexion);
    exit;
}

desconectarBD($conexion);
echo "OK";
