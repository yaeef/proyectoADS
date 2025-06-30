<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$query = "
SELECT G.idGrupo, G.nombre AS nombreGrupo, G.capacidad, Gr.grado,
    (SELECT COUNT(*) FROM GrupoEstudiante GE WHERE GE.idGrupo = G.idGrupo) AS inscritos
FROM Grupo G
JOIN Grado Gr ON G.idGrado = Gr.idGrado
ORDER BY G.nombre ASC
";

$resultado = mysqli_query($conexion, $query);
?>

<h4 class="mb-4">Inscripción de Estudiantes a Grupos</h4>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Grupo</th>
            <th>Grado</th>
            <th>Capacidad</th>
            <th>Inscritos</th>
            <th>Disponibles</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['nombreGrupo']) ?></td>
                <td><?= $row['grado'] ?></td>
                <td><?= $row['capacidad'] ?></td>
                <td><?= $row['inscritos'] ?></td>
                <td><?= $row['capacidad'] - $row['inscritos'] ?></td>
                <td>
                    <button class="btn btn-sm btn-primary"
                            onclick="mostrarModalInscribir(<?= $row['idGrupo'] ?>)">
                        Inscribir alumno
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
