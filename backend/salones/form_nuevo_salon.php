<?php require_once "../../db/conection/conn.php"; ?>

<div class="modal-header">
    <h5 class="modal-title">Agregar Nuevo Salón</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formNuevoSalon">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad</label>
            <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="">Selecciona tipo</option>
                <option value="salon">Salón</option>
                <option value="taller">Taller</option>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formNuevoSalon" class="btn btn-primary">Guardar</button>
</div>

<script>
$('#formNuevoSalon').on('submit', function (e) {
    e.preventDefault();
    $.post('../backend/salones/crear_salon.php', $(this).serialize(), function (resp) {
        if (resp === 'OK') {
            $('#modalCRUD').modal('hide');
            cargarSalones();
        } else {
            alert('Error: ' + resp);
        }
    });
});
</script>
