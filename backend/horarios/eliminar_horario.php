<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$idHorario = $_POST['idHorario'] ?? null;
if (!$idHorario) {
    echo "ID inválido";
    exit;
}

$stmt = mysqli_prepare($conexion, "DELETE FROM Horario WHERE idHorario = ?");
mysqli_stmt_bind_param($stmt, "i", $idHorario);
if (!mysqli_stmt_execute($stmt)) {
    echo "Error al eliminar";
    exit;
}

echo "OK";
