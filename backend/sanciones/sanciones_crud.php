<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

  
    $query_reportes = "SELECT rc.idReporteConducta, rc.fechaReporte, rc.motivo,
                              CONCAT(e.nombre, ' ', e.paterno) AS nombreEstudiante
                       FROM ReporteConducta rc
                       JOIN Estudiante e ON rc.idEstudiante = e.idEstudiante
                       WHERE rc.estado = 'iniciado'
                       ORDER BY rc.fechaReporte DESC";
    $stmt_reportes = mysqli_prepare($conexion, $query_reportes);
    mysqli_stmt_execute($stmt_reportes);
    $resultado_reportes = mysqli_stmt_get_result($stmt_reportes);

    $query_historial = "SELECT rs.idReporteSancion, rs.fechaAsignacion, rs.comentarios,
                               CONCAT(e.nombre, ' ', e.paterno) AS nombreEstudiante,
                               s.descripcion AS nombreSancion,
                               CONCAT(a.nombre, ' ', a.paterno) AS nombreAdmin
                        FROM ReporteSancion rs
                        JOIN ReporteConducta rc ON rs.idReporteConducta = rc.idReporteConducta
                        JOIN Estudiante e ON rc.idEstudiante = e.idEstudiante
                        JOIN Sancion s ON rs.idSancion = s.idSancion
                        JOIN Administrador a ON rs.idAdmin = a.idAdmin
                        ORDER BY rs.fechaAsignacion DESC";
    $stmt_historial = mysqli_prepare($conexion, $query_historial);
    mysqli_stmt_execute($stmt_historial);
    $resultado_historial = mysqli_stmt_get_result($stmt_historial);


    $query_sanciones = "SELECT * FROM Sancion ORDER BY gravedad, descripcion";
    $stmt_sanciones = mysqli_prepare($conexion, $query_sanciones);
    mysqli_stmt_execute($stmt_sanciones);
    $resultado_sanciones = mysqli_stmt_get_result($stmt_sanciones);
?>


<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Reportes de Conducta Pendientes</h3>
        <button class="btn btn-success" onclick="mostrarFormularioNuevoReporte()">
            <i class="fas fa-plus"></i> Nuevo Reporte
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Reporte</th>
                    <th>Estudiante</th>
                    <th>Fecha del Reporte</th>
                    <th>Motivo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($resultado_reportes) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($resultado_reportes)) : ?>
                        <tr>
                            <td><?= ($row['idReporteConducta']) ?></td>
                            <td><?= ($row['nombreEstudiante']) ?></td>
                            <td><?= ($row['fechaReporte']) ?></td>
                            <td><?= ($row['motivo']) ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary" onclick="gestionarReporte(<?= $row['idReporteConducta'] ?>)">
                                    <i class="fas fa-gavel"></i> Gestionar
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">¡Excelente! No hay reportes pendientes por gestionar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<hr class="my-5">


<div class="mb-5">
    <h3 class="mb-3">Historial de Sanciones Asignadas</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Sanción Asignada</th>
                    <th>Estudiante Sancionado</th>
                    <th>Sanción Aplicada</th>
                    <th>Fecha de Asignación</th>
                    <th>Admin Responsable</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>
                 <?php if (mysqli_num_rows($resultado_historial) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($resultado_historial)) : ?>
                        <tr>
                            <td><?= ($row['idReporteSancion']) ?></td>
                            <td><?= ($row['nombreEstudiante']) ?></td>
                            <td><?= ($row['nombreSancion']) ?></td>
                            <td><?= ($row['fechaAsignacion']) ?></td>
                            <td><?= ($row['nombreAdmin']) ?></td>
                            <td><?= ($row['comentarios']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aún no se ha asignado ninguna sanción.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<hr class="my-5">


<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Catálogo de Sanciones</h3>
        <button class="btn btn-success" onclick="mostrarFormularioNuevaSancion()">
            <i class="fas fa-plus"></i> Nueva Sanción
        </button>
    </div>
    <p class="text-muted">Administre los tipos de sanciones que se pueden asignar a los reportes.</p>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Duración (días)</th>
                    <th>Gravedad</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado_sanciones)) : ?>
                    <tr>
                        <td><?= ($row['idSancion']) ?></td>
                        <td><?= ($row['descripcion']) ?></td>
                        <td><?= ($row['duracionDias']) ?></td>
                        <td><?= (ucfirst($row['gravedad'])) ?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary" onclick="editarSancion(<?= $row['idSancion'] ?>)">Editar</button>
                            <button class="btn btn-sm btn-outline-danger" onclick="eliminarSancion(<?= $row['idSancion'] ?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    mysqli_stmt_close($stmt_reportes);
    mysqli_stmt_close($stmt_historial);
    mysqli_stmt_close($stmt_sanciones);
    desconectarBD($conexion);
?>
