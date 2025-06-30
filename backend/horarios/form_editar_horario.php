<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$idHorario = $_GET['idHorario'] ?? null;
if (!$idHorario) exit("ID inválido");

$horario = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM Horario WHERE idHorario = $idHorario"));

$grupos = mysqli_query($conexion, "SELECT idGrupo, nombre FROM Grupo ORDER BY nombre");
$materias = mysqli_query($conexion, "SELECT idMateria, nombre FROM Materia ORDER BY nombre");
$docentes = mysqli_query($conexion, "SELECT idDocente, CONCAT(nombre, ' ', paterno) AS nombreCompleto FROM Docente ORDER BY nombre");
$salones = mysqli_query($conexion, "SELECT idSalon, nombre FROM Salon ORDER BY nombre");
?>

<div class="modal-header">
    <h5 class="modal-title">Editar Horario</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <form id="formEditarHorario">
        <input type="hidden" name="idHorario" value="<?= $horario['idHorario'] ?>">

        <div class="mb-2">
            <label>Grupo</label>
            <select name="idGrupo" class="form-select" required>
                <?php while ($g = mysqli_fetch_assoc($grupos)) : ?>
                    <option value="<?= $g['idGrupo'] ?>" <?= $g['idGrupo'] == $horario['idGrupo'] ? 'selected' : '' ?>>
                        <?= $g['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Materia</label>
            <select name="idMateria" class="form-select" required>
                <?php while ($m = mysqli_fetch_assoc($materias)) : ?>
                    <option value="<?= $m['idMateria'] ?>" <?= $m['idMateria'] == $horario['idMateria'] ? 'selected' : '' ?>>
                        <?= $m['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Docente</label>
            <select name="idDocente" class="form-select" required>
                <?php while ($d = mysqli_fetch_assoc($docentes)) : ?>
                    <option value="<?= $d['idDocente'] ?>" <?= $d['idDocente'] == $horario['idDocente'] ? 'selected' : '' ?>>
                        <?= $d['nombreCompleto'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Día</label>
            <select name="dia" class="form-select" required>
                <?php foreach (['lunes','martes','miércoles','jueves','viernes'] as $dia): ?>
                    <option value="<?= $dia ?>" <?= $dia == $horario['dia'] ? 'selected' : '' ?>><?= ucfirst($dia) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Hora Inicio</label>
            <input type="time" name="horaInicio" class="form-control" value="<?= $horario['horaInicio'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Hora Fin</label>
            <input type="time" name="horaFin" class="form-control" value="<?= $horario['horaFin'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Salón</label>
            <select name="idSalon" class="form-select" required>
                <?php while ($s = mysqli_fetch_assoc($salones)) : ?>
                    <option value="<?= $s['idSalon'] ?>" <?= $s['idSalon'] == $horario['idSalon'] ? 'selected' : '' ?>>
                        <?= $s['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formEditarHorario" class="btn btn-primary">Guardar cambios</button>
</div>

<script>
$('#formEditarHorario').on('submit', function(e) {
    e.preventDefault();
    $.post('../backend/horarios/editar_horario.php', $(this).serialize(), function(resp) {
        if (resp === 'OK') {
            $('#modalCRUD').modal('hide');
            cargarHorarios();
        } else {
            alert('Error: ' + resp);
        }
    });
});
</script>
