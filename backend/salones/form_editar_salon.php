<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$idSalon = $_GET['idSalon'] ?? null;
if (!$idSalon) {
    echo "<div class='alert alert-danger'>ID inválido</div>";
    exit;
}

$result = mysqli_query($conexion, "SELECT * FROM salon WHERE idSalon = $idSalon");
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-warning'>Salón no encontrado</div>";
    exit;
}
$salon = mysqli_fetch_assoc($result);
?>

<div class="modal-header">
    <h5 class="modal-title">Editar Salón</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formEditarSalon">
        <input type="hidden" name="idSalon" value="<?= $salon['idSalon'] ?>">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= $salon['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Capacidad</label>
            <input type="number" name="capacidad" class="form-control" value="<?= $salon['capacidad'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-select" required>
                <option value="salon" <?= $salon['tipo'] === 'salon' ? 'selected' : '' ?>>Salón</option>
                <option value="taller" <?= $salon['tipo'] === 'taller' ? 'selected' : '' ?>>Taller</option>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formEditarSalon" class="btn btn-primary">Guardar cambios</button>
</div>

<script>
$('#formEditarSalon').on('submit', function (e) {
    e.preventDefault();
    $.post('../backend/salones/editar_salon.php', $(this).serialize(), function (resp) {
        if (resp === 'OK') {
            $('#modalCRUD').modal('hide');
            cargarSalones();
        } else {
            alert('Error: ' + resp);
        }
    });
});
</script>
