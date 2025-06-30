<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$idGrupo = $_POST['idGrupo'] ?? 0;
$idEstudiante = $_POST['idEstudiante'] ?? 0;

// Validar que haya espacio en el grupo
$datosGrupo = mysqli_fetch_assoc(mysqli_query($conexion, "
    SELECT capacidad,
           (SELECT COUNT(*) FROM GrupoEstudiante WHERE idGrupo = $idGrupo) AS inscritos
    FROM Grupo
    WHERE idGrupo = $idGrupo
"));

if (!$datosGrupo) {
    echo "Grupo no encontrado.";
    exit;
}

if ($datosGrupo['inscritos'] >= $datosGrupo['capacidad']) {
    echo "El grupo ya está lleno.";
    exit;
}

// Verificar si el alumno ya está inscrito (protección doble)
$existe = mysqli_query($conexion, "
    SELECT * FROM GrupoEstudiante
    WHERE idGrupo = $idGrupo AND idEstudiante = $idEstudiante
");
if (mysqli_num_rows($existe) > 0) {
    echo "El alumno ya está inscrito en este grupo.";
    exit;
}

// Insertar
$stmt = $conexion->prepare("
    INSERT INTO GrupoEstudiante (idGrupo, idEstudiante)
    VALUES (?, ?)
");
$stmt->bind_param("ii", $idGrupo, $idEstudiante);

if ($stmt->execute()) {
    echo "Alumno inscrito correctamente.";
} else {
    echo "Error al inscribir: " . $conexion->error;
}
$stmt->close();
