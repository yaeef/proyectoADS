<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

// Consulta unificada
$query = "
SELECT
    g.nombre AS grupo,
    m.nombre AS materia,
    CONCAT(d.nombre, ' ', d.paterno) AS profesor,
    h.dia,
    TIME_FORMAT(h.horaInicio, '%H:%i') AS horaInicio,
    TIME_FORMAT(h.horaFin, '%H:%i') AS horaFin,
    s.nombre AS salon,
    s.tipo AS tipoSalon
FROM Horario h
JOIN Grupo g ON g.idGrupo = h.idGrupo
JOIN Docente d ON d.idDocente = h.idDocente
JOIN Materia m ON m.idMateria = h.idMateria
JOIN Salon s ON s.idSalon = h.idSalon
ORDER BY g.nombre, m.nombre, h.dia, h.horaInicio;
";

$result = mysqli_query($conexion, $query);

// Agrupar por Grupo|Materia|Profesor
$horarios = [];
while ($row = mysqli_fetch_assoc($result)) {
    $key = $row['grupo'] . '|' . $row['materia'] . '|' . $row['profesor'];
    if (!isset($horarios[$key])) {
        $horarios[$key] = [
            'grupo' => $row['grupo'],
            'materia' => $row['materia'],
            'profesor' => $row['profesor'],
            'lunes' => '',
            'martes' => '',
            'miércoles' => '',
            'jueves' => '',
            'viernes' => ''
        ];
    }
    $celda = "{$row['horaInicio']} - {$row['horaFin']}<br>Salón: {$row['salon']}";
    $horarios[$key][$row['dia']] = $celda;
}
?>

<h3 class="mb-3">Horario General de Grupos</h3>

<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-primary" onclick="mostrarFormularioNuevoHorario()">Agregar Horario</button>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Grupo</th>
                <th>Materia</th>
                <th>Profesor</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($horarios as $h): ?>
                <tr>
                    <td><?= htmlspecialchars($h['grupo']) ?></td>
                    <td><?= htmlspecialchars($h['materia']) ?></td>
                    <td><?= htmlspecialchars($h['profesor']) ?></td>
                    <td><?= $h['lunes'] ?></td>
                    <td><?= $h['martes'] ?></td>
                    <td><?= $h['miércoles'] ?></td>
                    <td><?= $h['jueves'] ?></td>
                    <td><?= $h['viernes'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
