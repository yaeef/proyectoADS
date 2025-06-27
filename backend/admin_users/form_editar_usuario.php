<?php
require "../../db/conection/conn.php";
$conexion = conectarBD();

$idUsuario = $_GET['idUsuario'] ?? null;

if (!$idUsuario) {
    echo "<div class='alert alert-danger'>ID inválido</div>";
    exit;
}

// Obtener datos del usuario
$q = "
    SELECT u.idUsuario, u.usuario, u.tipo, u.contrasena,
           COALESCE(a.nombre, d.nombre, e.nombre, t.nombre) AS nombre,
           COALESCE(a.paterno, d.paterno, e.paterno, t.paterno) AS paterno,
           COALESCE(a.noEmpleado, d.noEmpleado, e.boleta, '') AS identificador
    FROM Usuario u
    LEFT JOIN Administrador a ON u.tipo = 'admin' AND u.idUsuario = a.idUsuario
    LEFT JOIN Docente d ON u.tipo = 'docente' AND u.idUsuario = d.idUsuario
    LEFT JOIN Estudiante e ON u.tipo = 'estudiante' AND u.idUsuario = e.idUsuario
    LEFT JOIN Tutor t ON u.tipo = 'tutor' AND u.idUsuario = t.idUsuario
    WHERE u.idUsuario = $idUsuario
";

$resultado = mysqli_query($conexion, $q);
if (!$resultado || mysqli_num_rows($resultado) == 0) {
    echo "<div class='alert alert-danger'>Usuario no encontrado</div>";
    exit;
}
$user = mysqli_fetch_assoc($resultado);
?>

<div class="modal-header">
    <h5 class="modal-title">Editar Usuario</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formEditarUsuario">
        <input type="hidden" name="idUsuario" value="<?= $user['idUsuario'] ?>">
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" value="<?= $user['usuario'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="text" class="form-control" name="contrasena" value="<?= $user['contrasena'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $user['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" name="paterno" value="<?= $user['paterno'] ?>" required>
        </div>
        <?php if ($user['tipo'] !== 'tutor'): ?>
            <div class="mb-3">
                <label class="form-label"><?= $user['tipo'] === 'estudiante' ? 'Boleta' : 'No. Empleado' ?></label>
                <input type="text" class="form-control" name="identificador" value="<?= $user['identificador'] ?>" required>
            </div>
        <?php endif; ?>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formEditarUsuario" class="btn btn-primary">Guardar cambios</button>
</div>

<script>
$('#formEditarUsuario').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: '../backend/admin_users/editar_usuario.php',
        method: 'POST',
        data: $(this).serialize(),
        success: function (res) {
            if (res === 'OK') {
                $('#modalCRUD').modal('hide');
                cargarUsuarios();
            } else {
                alert('Error: ' + res);
            }
        },
        error: function () {
            alert('Error en la petición AJAX');
        }
    });
});
</script>
