<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

extract($_POST);

$query = "UPDATE Horario SET idGrupo=?, idMateria=?, idDocente=?, dia=?, horaInicio=?, horaFin=?, idSalon=? WHERE idHorario=?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "iiisssii", $idGrupo, $idMateria, $idDocente, $dia, $horaInicio, $horaFin, $idSalon, $idHorario);

if (!mysqli_stmt_execute($stmt)) {
    echo "Error al actualizar";
    exit;
}

echo "OK";
