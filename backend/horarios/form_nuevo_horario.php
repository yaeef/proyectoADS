<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$grupos = mysqli_query($conexion, "SELECT idGrupo, nombre FROM Grupo ORDER BY nombre");
$materias = mysqli_query($conexion, "SELECT idMateria, nombre FROM Materia ORDER BY nombre");
$docentes = mysqli_query($conexion, "SELECT idDocente, CONCAT(nombre, ' ', paterno) AS nombreCompleto FROM Docente ORDER BY nombre");
$salones = mysqli_query($conexion, "SELECT idSalon, nombre FROM Salon ORDER BY nombre");
?>

<div class="modal-header">
    <h5 class="modal-title">Agregar Horario</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <form id="formNuevoHorario">
        <div class="mb-2">
            <label>Grupo</label>
            <select name="idGrupo" class="form-select" required>
                <?php while ($g = mysqli_fetch_assoc($grupos)) : ?>
                    <option value="<?= $g['idGrupo'] ?>"><?= $g['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Materia</label>
            <select name="idMateria" class="form-select" required>
                <?php while ($m = mysqli_fetch_assoc($materias)) : ?>
                    <option value="<?= $m['idMateria'] ?>"><?= $m['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Docente</label>
            <select name="idDocente" class="form-select" required>
                <?php while ($d = mysqli_fetch_assoc($docentes)) : ?>
                    <option value="<?= $d['idDocente'] ?>"><?= $d['nombreCompleto'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Día</label>
            <select name="dia" class="form-select" required>
                <option value="lunes">Lunes</option>
                <option value="martes">Martes</option>
                <option value="miércoles">Miércoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
            </select>
        </div>
        <div class="mb-2">
            <label>Hora Inicio</label>
            <input type="time" name="horaInicio" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Hora Fin</label>
            <input type="time" name="horaFin" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Salón</label>
            <select name="idSalon" class="form-select" required>
                <?php while ($s = mysqli_fetch_assoc($salones)) : ?>
                    <option value="<?= $s['idSalon'] ?>"><?= $s['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formNuevoHorario" class="btn btn-primary">Guardar</button>
</div>

<script>
$('#formNuevoHorario').on('submit', function(e) {
    e.preventDefault();
    $.post('../backend/horarios/crear_horario.php', $(this).serialize(), function(resp) {
        if (resp === 'OK') {
            $('#modalCRUD').modal('hide');
            cargarHorarios();
        } else {
            alert('Error: ' + resp);
        }
    });
});
</script>
