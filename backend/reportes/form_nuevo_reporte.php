
<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    // Obtener listas de estudiantes y docentes para los dropdowns
    $estudiantes = mysqli_query($conexion, "SELECT idEstudiante, CONCAT(paterno, ' ', materno, ' ', nombre) AS nombreCompleto FROM Estudiante ORDER BY paterno ASC");
    $docentes = mysqli_query($conexion, "SELECT idDocente, CONCAT(paterno, ' ', materno, ' ', nombre) AS nombreCompleto FROM Docente ORDER BY paterno ASC");
?>
<div class="modal-header">
    <h5 class="modal-title">Crear Nuevo Reporte de Conducta</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formNuevoReporte">
        <div class="mb-3">
            <label for="idEstudiante" class="form-label">Estudiante</label>
            <select id="idEstudiante" name="idEstudiante" class="form-select" required>
                <option value="">Seleccione un estudiante...</option>
                <?php while($est = mysqli_fetch_assoc($estudiantes)): ?>
                    <option value="<?= $est['idEstudiante'] ?>"><?= htmlspecialchars($est['nombreCompleto']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="idDocente" class="form-label">Docente que atestigua</label>
            <select id="idDocente" name="idDocente" class="form-select" required>
                <option value="">Seleccione un docente...</option>
                 <?php while($doc = mysqli_fetch_assoc($docentes)): ?>
                    <option value="<?= $doc['idDocente'] ?>"><?= htmlspecialchars($doc['nombreCompleto']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
         <div class="mb-3">
            <label for="fechaIncidente" class="form-label">Fecha del Incidente</label>
            <input type="datetime-local" id="fechaIncidente" name="fechaIncidente" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo del Reporte</label>
            <input type="text" id="motivo" name="motivo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="detalles" class="form-label">Detalles</label>
            <textarea id="detalles" name="detalles" class="form-control" rows="3" required></textarea>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formNuevoReporte" class="btn btn-primary">Guardar Reporte</button>
</div>

<script>
$('#formNuevoReporte').on('submit', function (e) {
    e.preventDefault();
    $.post('../backend/reportes/crear_reporte.php', $(this).serialize(), function (resp) {
        if (resp === 'OK') {
            $('#modalCRUD').modal('hide');
            cargarModuloDisciplina(); 
        } else {
            alert('Error al crear el reporte: ' + resp);
        }
    });
});
</script>