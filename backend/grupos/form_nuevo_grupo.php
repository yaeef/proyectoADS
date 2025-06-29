<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$grados = mysqli_query($conexion, "SELECT idGrado, grado FROM Grado");
$periodos = mysqli_query($conexion, "SELECT idPeriodo, estado FROM Periodo");
$salones = mysqli_query($conexion, "SELECT idSalon, nombre FROM Salon");
?>

<h4>Nuevo Grupo</h4>
<form id="formNuevoGrupo">
    <div class="mb-3">
        <label class="form-label">Nombre del Grupo</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Capacidad</label>
        <input type="number" name="capacidad" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Turno</label>
        <select name="turno" class="form-select" required>
            <option value="matutino">Matutino</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Grado</label>
        <select name="idGrado" class="form-select" required>
            <?php while($g = mysqli_fetch_assoc($grados)): ?>
                <option value="<?= $g['idGrado'] ?>"><?= $g['grado'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Periodo</label>
        <select name="idPeriodo" class="form-select" required>
            <?php while($p = mysqli_fetch_assoc($periodos)): ?>
                <option value="<?= $p['idPeriodo'] ?>"><?= $p['estado'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Salón</label>
        <select name="idSalon" class="form-select" required>
            <?php while($s = mysqli_fetch_assoc($salones)): ?>
                <option value="<?= $s['idSalon'] ?>"><?= $s['nombre'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

<script>
$('#formNuevoGrupo').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../backend/grupos/crear_grupo.php',
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
            alert(resp);
            cargarGrupos();
        }
    });
});
</script>
