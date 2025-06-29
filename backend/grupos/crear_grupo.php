<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$nombre = $_POST['nombre'] ?? '';
$capacidad = $_POST['capacidad'] ?? 0;
$turno = $_POST['turno'] ?? 'matutino';
$idGrado = $_POST['idGrado'] ?? 0;
$idPeriodo = $_POST['idPeriodo'] ?? 0;
$idSalon = $_POST['idSalon'] ?? 0;

if ($nombre && $capacidad && $idGrado && $idPeriodo && $idSalon) {
    $stmt = $conexion->prepare("
        INSERT INTO Grupo (nombre, capacidad, turno, idGrado, idPeriodo, idSalon)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("sisiii", $nombre, $capacidad, $turno, $idGrado, $idPeriodo, $idSalon);

    if ($stmt->execute()) {
        echo "Grupo creado correctamente.";
    } else {
        echo "Error al guardar grupo: " . $conexion->error;
    }

    $stmt->close();
} else {
    echo "Faltan datos obligatorios.";
}
