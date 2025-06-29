<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$idGrupo = $_GET['id'] ?? 0;
if (!$idGrupo) {
    echo "<script>alert('ID de grupo no recibido.');</script>";
    exit;
}

$stmt = $conexion->prepare("SELECT * FROM Grupo WHERE idGrupo = ?");
$stmt->bind_param("i", $idGrupo);
$stmt->execute();
$result = $stmt->get_result();
$grupo = $result->fetch_assoc();

$grados = mysqli_query($conexion, "SELECT idGrado, grado FROM Grado");
$periodos = mysqli_query($conexion, "SELECT idPeriodo, estado FROM Periodo");
$salones = mysqli_query($conexion, "SELECT idSalon, nombre FROM Salon");
?>

<h4>Editar Grupo</h4>
<form id="formEditarGrupo">
    <input type="hidden" name="idGrupo" value="<?= $grupo['idGrupo'] ?>">

    <div class="mb-3">
        <label class="form-label">Nombre del Grupo</label>
        <input type="text" name="nombre" class="form-control" value="<?= $grupo['nombre'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Capacidad</label>
        <input type="number" name="capacidad" class="form-control" value="<?= $grupo['capacidad'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Turno</label>
        <select name="turno" class="form-select">
            <option value="matutino" <?= $grupo['turno'] == 'matutino' ? 'selected' : '' ?>>Matutino</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Grado</label>
        <select name="idGrado" class="form-select">
            <?php while ($g = mysqli_fetch_assoc($grados)) : ?>
                <option value="<?= $g['idGrado'] ?>" <?= $g['idGrado'] == $grupo['idGrado'] ? 'selected' : '' ?>>
                    <?= $g['grado'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Periodo</label>
        <select name="idPeriodo" class="form-select">
            <?php while ($p = mysqli_fetch_assoc($periodos)) : ?>
                <option value="<?= $p['idPeriodo'] ?>" <?= $p['idPeriodo'] == $grupo['idPeriodo'] ? 'selected' : '' ?>>
                    <?= $p['estado'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Salón</label>
        <select name="idSalon" class="form-select">
            <?php while ($s = mysqli_fetch_assoc($salones)) : ?>
                <option value="<?= $s['idSalon'] ?>" <?= $s['idSalon'] == $grupo['idSalon'] ? 'selected' : '' ?>>
                    <?= $s['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar Cambios</button>
</form>

<script>
$('#formEditarGrupo').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../backend/grupos/editar_grupo.php',
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
            alert(resp);
            cargarGrupos();
        }
    });
});
</script>
