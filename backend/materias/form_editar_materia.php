<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $idMateria = $_GET['idMateria'] ?? null;
    if (!$idMateria) {
        echo "<div class='alert alert-danger'>ID inválido</div>";
        exit;
    }

    $result = mysqli_query($conexion, "SELECT * FROM Materia WHERE idMateria = $idMateria");
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "<div class='alert alert-warning'>Materia no encontrado</div>";
        exit;
    }
    $materia = mysqli_fetch_assoc($result);
?>

<div class="modal-header">
    <h5 class="modal-title">Editar Materia</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formEditarMateria">
        <input type="hidden" name="idMateria" value="<?= $materia['idMateria'] ?>">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= $materia['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Grado</label>
            <select name="grado" class="form-select" required>
                <option value="1" <?= $materia['idGrado'] === '1' ? 'selected' : '' ?>>Primero</option>
                <option value="2" <?= $materia['idGrado'] === '2' ? 'selected' : '' ?>>Segundo</option>
                <option value="3" <?= $materia['idGrado'] === '3' ? 'selected' : '' ?>>Tercero</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-select" required>
                <option value="general" <?= $materia['tipo'] === 'general' ? 'selected' : '' ?>>General</option>
                <option value="taller" <?= $materia['tipo'] === 'taller' ? 'selected' : '' ?>>Taller</option>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formEditarMateria" class="btn btn-primary">Guardar cambios</button>
</div>

<script>
    $('#formEditarMateria').on('submit', function (e) {
        e.preventDefault();
        $.post('../backend/materias/editar_materia.php', $(this).serialize(), function (resp) {
            if (resp === 'OK') {
                $('#modalCRUD').modal('hide');
                cargarMaterias();
            } else {
                alert('Error: ' + resp);
            }
        });
    });
</script>
