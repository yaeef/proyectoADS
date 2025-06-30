<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

extract($_POST); // cuidado en producción, aquí es seguro

$query = "INSERT INTO Horario (idGrupo, idMateria, idDocente, dia, horaInicio, horaFin, idSalon)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "iiisssi", $idGrupo, $idMateria, $idDocente, $dia, $horaInicio, $horaFin, $idSalon);

if (!mysqli_stmt_execute($stmt)) {
    echo "Error al insertar horario";
    exit;
}
echo "OK";
