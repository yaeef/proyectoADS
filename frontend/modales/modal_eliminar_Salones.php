<?php
    // modal_eliminar_salones.php
    require '../../db/conection/conn.php';


    $conexion = conectarBD();
    $id = $_GET['id'];
    $query = "SELECT * FROM Salon WHERE idSalon = $id";
    $resultado = mysqli_query($conexion,$query);
    $data = mysqli_fetch_assoc($resultado);
    desconectarBD($conexion);
?>
<!-- Estructura del MODAL para eliminar salones-->
<div class="modal-header">
  <h5 class="modal-title">Eliminar Salón</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <form id="formEliminarSalon">
        <input type="hidden" name="id" value="<?= $data['idSalon'] ?>">
        <div class="mb-3">
            <p class="form-control-plaintext">Salon: <strong><?= $data['nombre'] ?></strong></p>
        </div>
        <div class="mb-3">
           <p class="form-control-plaintext">Capacidad: <strong><?= $data['capacidad'] ?></strong></p>
        </div>
        <div class="mb-3">
          <p class="form-control-plaintext">Tipo: <strong><?= ucfirst($data['tipo']) ?></strong></p> <!-- Convierte a mayúscula la primera letra --></label>
        </div>
        <p>¿Está seguro de que desea eliminar este salón?</p>
        
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    </form>
</div>

<script>
  $('#formEliminarSalon').on('submit', function(e) {
    e.preventDefault();  //Evita que tome el camino normal de un form al hacer click en submit, basicamente para que no me cambie de pantalla
    $.post('backend/eliminar_salon.php', $(this).serialize(), function(response)  //Driver que contendra la logica de los diagramas de secuencia
    { 
      alert(response);  //Aqui se manejara la notificacion del CRUD
      $('#modalCRUD').modal('hide');
      cargarEntidad('Salones');  // Recargar la lista de salones
    });
  });
</script>
