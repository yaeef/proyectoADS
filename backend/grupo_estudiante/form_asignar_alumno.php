<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$idGrupo = $_GET['idGrupo'] ?? 0;

$grupo = mysqli_fetch_assoc(mysqli_query($conexion, "
    SELECT G.idGrupo, G.nombre AS nombreGrupo, G.capacidad,
           (SELECT COUNT(*) FROM GrupoEstudiante WHERE idGrupo = G.idGrupo) AS inscritos
    FROM Grupo G
    WHERE G.idGrupo = $idGrupo
"));

$disponible = $grupo['capacidad'] - $grupo['inscritos'];

$estudiantes = mysqli_query($conexion, "
    SELECT E.idEstudiante, E.nombre, E.paterno, E.materno
    FROM Estudiante E
    WHERE E.idEstudiante NOT IN (
        SELECT idEstudiante FROM GrupoEstudiante
    )
");

?>

<div class="modal-header">
    <h5 class="modal-title">Inscribir alumno al grupo: <?= htmlspecialchars($grupo['nombreGrupo']) ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <p><strong>Cupo disponible:</strong> <?= $disponible ?></p>

    <?php if ($disponible > 0): ?>
    <form id="formInscribirAlumno">
        <input type="hidden" name="idGrupo" value="<?= $grupo['idGrupo'] ?>">
        <div class="mb-3">
            <label for="idEstudiante" class="form-label">Seleccionar alumno:</label>
            <select name="idEstudiante" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php while ($e = mysqli_fetch_assoc($estudiantes)): ?>
                    <option value="<?= $e['idEstudiante'] ?>">
                        <?= $e['nombre'] . " " . $e['paterno'] . " " . $e['materno'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Inscribir</button>
    </form>
    <?php else: ?>
        <div class="alert alert-warning">No hay cupo disponible en este grupo.</div>
    <?php endif; ?>
</div>

<script>
$('#formInscribirAlumno').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../backend/grupo_estudiante/asignar_alumno.php',
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
            alert(resp);
            $('#modalCRUD').modal('hide');
            cargarInscripciones();
        }
    });
});
</script>
