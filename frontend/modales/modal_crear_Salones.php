
<!-- Estructura del MODAL para crear salones-->

<div class="modal-header">
  <h5 class="modal-title">Crear Nuevo Salón</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <form id="formCrearSalon">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
            <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad</label>
            <input type="number" id="capacidad" name="capacidad" class="form-control" required>
        </div>
            <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="salon">Salón</option>
                <option value="taller">Taller</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    </form>
</div>

<script>
  $('#formCrearSalon').on('submit', function(e) {
    e.preventDefault();
    $.post('backend/crear_salon.php', $(this).serialize(), function(response)  //Driver que contendra la logica de los diagramas de secuencia
    {
      alert(response);
      $('#modalCRUD').modal('hide');
      cargarEntidad('Salones');  // Recargar la lista de salones
    });
  });
</script>

<?php
    // modal_crear_salones.php
    require '../../db/conection/conn.php';

    #desconectarBD($conexion);
?>
