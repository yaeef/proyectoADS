<?php require_once "../../db/conection/conn.php"; ?>

<div class="modal-header">
    <h5 class="modal-title">Agregar Nueva Materia</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formNuevoSalon">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="">Selecciona tipo</option>
                <option value="general">General</option>
                <option value="taller">Taller</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="grado" class="form-label">Grado</label>
            <select class="form-select" id="grado" name="grado" required>
                <option value="">Selecciona grado</option>
                <option value="1">Primero</option>
                <option value="2">Segundo</option>
                <option value="3">Tercero</option>
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
    $.post('../backend/materias/crear_materia.php', $(this).serialize(), function (resp) {
        if (resp === 'OK') {
            $('#modalCRUD').modal('hide');
            cargarMaterias();
        } else {
            alert('Error: ' + resp);
        }
    });
});
</script>
