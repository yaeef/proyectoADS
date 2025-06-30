<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $idSancion = $_GET['idSancion'] ?? null;
    if (!$idSancion) {
        echo "<div class='alert alert-danger'>ID de sanción inválido.</div>";
        exit;
    }

    $query = "SELECT * FROM Sancion WHERE idSancion = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $idSancion);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "<div class='alert alert-warning'>Sanción no encontrada.</div>";
        exit;
    }
    $sancion = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    desconectarBD($conexion);
?>

<div class="modal-header">
    <h5 class="modal-title">Editar Sanción del Catálogo</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formEditarSancion">
        <input type="hidden" name="idSancion" value="<?= ($sancion['idSancion']) ?>">
        
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="<?= ($sancion['descripcion']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Duración en días</label>
            <input type="number" name="duracionDias" class="form-control" value="<?= ($sancion['duracionDias']) ?>" min="0" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gravedad</label>
            <select name="gravedad" class="form-select" required>
                <option value="leve" <?= $sancion['gravedad'] === 'leve' ? 'selected' : '' ?>>Leve</option>
                <option value="moderada" <?= $sancion['gravedad'] === 'moderada' ? 'selected' : '' ?>>Moderada</option>
                <option value="grave" <?= $sancion['gravedad'] === 'grave' ? 'selected' : '' ?>>Grave</option>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formEditarSancion" class="btn btn-primary">Guardar cambios</button>
</div>

<script>
$('#formEditarSancion').on('submit', function (e) {
    e.preventDefault();
    $.post('../backend/sanciones/editar_sancion.php', $(this).serialize(), function (resp) {
        if (resp === 'OK') {
            $('#modalCRUD').modal('hide');
            cargarModuloDisciplina();
        } else {
            alert('Error al actualizar: ' + resp);
        }
    });
});
</script>
