<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();


$idGrupo = $_POST['idGrupo'] ?? 0;
$nombre = $_POST['nombre'] ?? '';
$capacidad = $_POST['capacidad'] ?? 0;
$turno = $_POST['turno'] ?? '';
$idGrado = $_POST['idGrado'] ?? 0;
$idPeriodo = $_POST['idPeriodo'] ?? 0;
$idSalon = $_POST['idSalon'] ?? 0;

if ($idGrupo && $nombre && $capacidad && $turno && $idGrado && $idPeriodo && $idSalon) {
    $stmt = $conexion->prepare("
        UPDATE Grupo
        SET nombre = ?, capacidad = ?, turno = ?, idGrado = ?, idPeriodo = ?, idSalon = ?
        WHERE idGrupo = ?
    ");
    $stmt->bind_param("sisiiii", $nombre, $capacidad, $turno, $idGrado, $idPeriodo, $idSalon, $idGrupo);

    if ($stmt->execute()) {
        echo "Grupo actualizado correctamente.";
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }

    $stmt->close();
} else {
    echo "Faltan datos.";
}
