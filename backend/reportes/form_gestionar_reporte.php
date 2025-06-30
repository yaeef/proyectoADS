<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $idReporteConducta = $_GET['idReporteConducta'] ?? null;
    if (!$idReporteConducta) {
        echo "<div class='alert alert-danger'>ID de reporte inválido.</div>";
        exit;
    }

    $query_reporte = "SELECT rc.*, CONCAT(e.nombre, ' ', e.paterno) AS nombreEstudiante 
                      FROM ReporteConducta rc 
                      JOIN Estudiante e ON rc.idEstudiante = e.idEstudiante
                      WHERE rc.idReporteConducta = ?";
    $stmt_reporte = mysqli_prepare($conexion, $query_reporte);
    mysqli_stmt_bind_param($stmt_reporte, "i", $idReporteConducta);
    mysqli_stmt_execute($stmt_reporte);
    $result_reporte = mysqli_stmt_get_result($stmt_reporte);
    $reporte = mysqli_fetch_assoc($result_reporte);

    $query_sanciones = "SELECT idSancion, descripcion, gravedad FROM Sancion ORDER BY gravedad, descripcion";
    $sanciones = mysqli_query($conexion, $query_sanciones);
?>

<div class="modal-header">
    <h5 class="modal-title">Gestionar Reporte de Conducta #<?= htmlspecialchars($reporte['idReporteConducta']) ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <h6>Detalles del Reporte:</h6>
    <p><strong>Estudiante:</strong> <?= htmlspecialchars($reporte['nombreEstudiante']) ?></p>
    <p><strong>Motivo:</strong> <?= htmlspecialchars($reporte['motivo']) ?></p>
    <p><strong>Detalles:</strong> <?= htmlspecialchars($reporte['detalles']) ?></p>
    <hr>
    
    <form id="formGestionarReporte">
        <input type="hidden" name="idReporteConducta" value="<?= htmlspecialchars($reporte['idReporteConducta']) ?>">
        
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="checkAsignarSancion" name="asignarSancion">
            <label class="form-check-label" for="checkAsignarSancion"><b>Asignar Sanción</b> (Marque para aplicar una sanción del catálogo)</label>
        </div>

        <div id="camposSancion" style="display: none;">
            <div class="mb-3">
                <label for="idSancion" class="form-label">Tipo de Sanción</label>
                <select id="idSancion" name="idSancion" class="form-select">
                    <option value="">Seleccione una sanción...</option>
                    <?php while($sancion = mysqli_fetch_assoc($sanciones)): ?>
                        <option value="<?= $sancion['idSancion'] ?>">
                            (<?= htmlspecialchars(ucfirst($sancion['gravedad'])) ?>) <?= htmlspecialchars($sancion['descripcion']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" id="fechaInicio" name="fechaInicio" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fechaFin" class="form-label">Fecha de Fin</label>
                    <input type="date" id="fechaFin" name="fechaFin" class="form-control">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios del Administrador (Obligatorio)</label>
            <textarea id="comentarios" name="comentarios" class="form-control" rows="3" required></textarea>
            <small class="form-text text-muted">Añada un comentario final, incluso si no se asigna una sanción.</small>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formGestionarReporte" class="btn btn-primary">Guardar y Resolver</button>
</div>

<script>
$(document).ready(function() {
    $('#checkAsignarSancion').on('change', function() {
        if ($(this).is(':checked')) {
            $('#camposSancion').slideDown();
            $('#idSancion, #fechaInicio, #fechaFin').prop('required', true);
        } else {
            $('#camposSancion').slideUp();
            $('#idSancion, #fechaInicio, #fechaFin').prop('required', false);
        }
    });

    $('#formGestionarReporte').on('submit', function(e) {
        e.preventDefault();
        $.post('../backend/reportes/procesar_reporte.php', $(this).serialize(), function(resp) {
            if (resp === 'OK') {
                $('#modalCRUD').modal('hide');
                cargarModuloDisciplina();
            } else {
                alert('Error al procesar el reporte: ' + resp);
            }
        });
    });
});
</script>

<?php
    mysqli_close($conexion);
?>
