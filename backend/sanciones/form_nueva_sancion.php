<div class="modal-header">
    <h5 class="modal-title">Agregar Nueva Sanción al Catálogo</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formNuevaSancion">
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        </div>
        <div class="mb-3">
            <label for="duracionDias" class="form-label">Duración en días</label>
            <input type="number" class="form-control" id="duracionDias" name="duracionDias" min="0" required>
        </div>
        <div class="mb-3">
            <label for="gravedad" class="form-label">Gravedad</label>
            <select class="form-select" id="gravedad" name="gravedad" required>
                <option value="">Seleccione una gravedad</option>
                <option value="leve">Leve</option>
                <option value="moderada">Moderada</option>
                <option value="grave">Grave</option>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formNuevaSancion" class="btn btn-primary">Guardar Sanción</button>
</div>

<script>
$('#formNuevaSancion').on('submit', function (e) {
    e.preventDefault();
    $.post('../backend/sanciones/crear_sancion.php', $(this).serialize(), function (resp) {
        if (resp === 'OK') {
            $('#modalCRUD').modal('hide');
            cargarModuloDisciplina();
        } else {
            alert('Error al guardar: ' + resp);
        }
    });
});
</script>
