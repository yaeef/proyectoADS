<?php
    // modal_editar_salones.php
    require '../../db/conection/conn.php';


    $conexion = conectarBD();
    $id = $_GET['id'];
    $query = "SELECT * FROM Salon WHERE idSalon = $id";
    $resultado = mysqli_query($conexion,$query);
    $data = mysqli_fetch_assoc($resultado);
    desconectarBD($conexion);
?>
<!-- Estructura del MODAL para editar salones-->
<div class="modal-header">
  <h5 class="modal-title">Editar Salón</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <form id="formEditarSalon">
        <input type="hidden" name="id" value="<?= $data['idSalon'] ?>">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= $data['nombre'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Capacidad</label>
            <input type="number" name="capacidad" value="<?= $data['capacidad'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Tipo</label>
            <select name="tipo" class="form-control">
                <option value="salon" <?php echo ($data['tipo'] == 'salon') ? 'selected' : ''; ?>>Salón</option>
                <option value="taller" <?php echo ($data['tipo'] == 'taller') ? 'selected' : ''; ?>>Taller</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script>
  $('#formEditarSalon').on('submit', function(e) {
    e.preventDefault();
    $.post('backend/editar_salon.php', $(this).serialize(), function(response) //Driver que contendra la logica de los diagramas de secuencia
    {
      alert(response);
      $('#modalCRUD').modal('hide');
      cargarEntidad('Salones');  // Recargar la lista de salones
    });
  });
</script>
