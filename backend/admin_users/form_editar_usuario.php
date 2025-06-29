<?php
    require "../../db/conection/conn.php";
    $conexion = conectarBD();

    $idUsuario = $_GET['idUsuario'] ?? null;
    $tipoUsuario = $_GET['tipo'] ?? null;

    if (!$idUsuario) {
        echo "<div class='alert alert-danger'>ID inválido</div>";
        exit;
    }
    if($tipoUsuario === 'admin')
    {
        $query = "
            SELECT 
                u.idUsuario,
                u.usuario,
                u.contrasena,
                u.tipo,
                u.bloqueado,
                u.ultimoLogin,
                u.fechaRegistro,
                a.idAdmin,
                a.noEmpleado,
                a.nombre,
                a.paterno,
                a.materno,
                a.telefono,
                a.calle,
                a.colonia,
                a.CP,
                a.fechaNacimiento,
                a.correo,
                a.RFC,
                a.padecimientos
            FROM 
                Usuario u
            JOIN 
                Administrador a ON u.idUsuario = a.idUsuario
            WHERE 
                u.idUsuario = $idUsuario;
        ";
        $resultado = mysqli_query($conexion, $query);
        if (!$resultado || mysqli_num_rows($resultado) == 0) 
        {
            echo "<div class='alert alert-danger'>Usuario  Administrador no encontrado</div>";
            exit;
        }
        $user = mysqli_fetch_assoc($resultado);
    }
    else if($tipoUsuario === 'docente')
    {
        $query = "
            SELECT 
                u.idUsuario,
                u.usuario,
                u.contrasena,
                u.tipo,
                u.bloqueado,
                u.ultimoLogin,
                u.fechaRegistro,
                d.idDocente,
                d.noEmpleado,
                d.nombre,
                d.paterno,
                d.materno,
                d.telefono,
                d.calle,
                d.colonia,
                d.CP,
                d.fechaNacimiento,
                d.correo,
                d.RFC,
                d.tipo,
                d.padecimientos
            FROM 
                Usuario u
            JOIN 
                Docente d ON u.idUsuario = d.idUsuario
            WHERE 
                u.idUsuario = $idUsuario;
        ";
        $resultado = mysqli_query($conexion, $query);
        if (!$resultado || mysqli_num_rows($resultado) == 0) 
        {
            echo "<div class='alert alert-danger'>Usuario  Administrador no encontrado</div>";
            exit;
        }
        $user = mysqli_fetch_assoc($resultado);
    }
    else if($tipoUsuario === 'estudiante')
    {
        $query = "
            SELECT 
                u.idUsuario,
                u.usuario,
                u.contrasena,
                u.tipo,
                u.bloqueado,
                u.ultimoLogin,
                u.fechaRegistro,
                e.idEstudiante,
                e.boleta,
                e.nombre,
                e.paterno,
                e.materno,
                e.calle,
                e.colonia,
                e.CP,
                e.fechaNacimiento,
                e.correo,
                e.CURP,
                e.padecimientos
            FROM 
                Usuario u
            JOIN 
                Estudiante e ON u.idUsuario = e.idUsuario
            WHERE 
                u.idUsuario = $idUsuario;
        ";
        $resultado = mysqli_query($conexion, $query);
        if (!$resultado || mysqli_num_rows($resultado) == 0) 
        {
            echo "<div class='alert alert-danger'>Usuario  Administrador no encontrado</div>";
            exit;
        }
        $user = mysqli_fetch_assoc($resultado);
    }
?>

<div class="modal-header">
    <h5 class="modal-title">Editar Usuario</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formEditarUsuario">
        <input type="hidden" name="idUsuario" value="<?= $user['idUsuario'] ?>">     <!--Valores para facilitar UPDATE EN DRIVER-->
        <input type="hidden" name="tipoActualizacion" value="<?= $tipoUsuario ?>">         <!--Valores para facilitar UPDATE EN DRIVER-->
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" value="<?= $user['usuario'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="text" class="form-control" name="contrasena" value="<?= $user['contrasena'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">¿Bloqueado?</label>
            <select name="bloqueado" class="form-select" required>
                <option value="0" <?= $user['bloqueado'] === '0' ? 'selected' : '' ?>>Desbloqueado</option>
                <option value="1" <?= $user['bloqueado'] === '1' ? 'selected' : '' ?>>Bloqueado</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $user['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" name="paterno" value="<?= $user['paterno'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" name="materno" value="<?= $user['materno'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Calle</label>
            <input type="text" class="form-control" name="calle" value="<?= $user['calle'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Colonia</label>
            <input type="text" class="form-control" name="colonia" value="<?= $user['colonia'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">CP</label>
            <input type="text" class="form-control" name="CP" value="<?= $user['CP'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" name="fechaNacimiento" value="<?= $user['fechaNacimiento'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" value="<?= $user['correo'] ?>" required>
        </div>
        



        <?php if ($tipoUsuario === 'admin'): /*Campos extra para Admin*/?>  
            <input type="hidden" name="idAdmin" value="<?= $user['idAdmin'] ?>">     <!--Valores para facilitar UPDATE EN DRIVER-->
            <strong><label for="adminOp">Datos de Administrador</label></strong>
            <div class="mb-3">
                <label class="form-label">Número de Empleado</label>
                <input type="text" class="form-control" name="noEmpleado" value="<?= $user['noEmpleado'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefono</label>
                <input type="tel" class="form-control" name="telefono" value="<?= $user['telefono'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">RFC</label>
                <input type="text" class="form-control" name="rfc" value="<?= $user['RFC'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Padecimientos</label>
                <input type="text" class="form-control" name="padecimientos" value="<?= $user['padecimientos'] ?>" required>
            </div>
        <?php endif; ?>

        <?php if ($tipoUsuario === 'docente'): /*Campos extra para Docente*/?>   
            <input type="hidden" name="idDocente" value="<?= $user['idDocente'] ?>">     <!--Valores para facilitar UPDATE EN DRIVER-->
            <strong><label for="docenteOp">Datos de Docente</label></strong>
            <div class="mb-3">
                <label class="form-label">Número de Empleado</label>
                <input type="text" class="form-control" name="noEmpleado" value="<?= $user['noEmpleado'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefono</label>
                <input type="tel" class="form-control" name="telefono" value="<?= $user['telefono'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">RFC</label>
                <input type="text" class="form-control" name="rfc" value="<?= $user['RFC'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">¿Tipo?</label>
                <select name="tipo" class="form-select" required>
                    <option value="CA" <?= $user['tipo'] === 'CA' ? 'selected' : '' ?>>CA</option>
                    <option value="CB" <?= $user['tipo'] === 'CB' ? 'selected' : '' ?>>CB</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Padecimientos</label>
                <input type="text" class="form-control" name="padecimientos" value="<?= $user['padecimientos'] ?>" required>
            </div>
        <?php endif; ?>

        <?php if ($tipoUsuario === 'estudiante'): /*Campos extra para Estudiante*/?>   
            <input type="hidden" name="idEstudiante" value="<?= $user['idEstudiante'] ?>">     <!--Valores para facilitar UPDATE EN DRIVER-->
            <strong><label for="docenteOp">Datos de Estudiante</label></strong>
            <div class="mb-3">
                <label class="form-label">Boleta</label>
                <input type="text" class="form-control" name="boleta" value="<?= $user['boleta'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CURP</label>
                <input type="text" class="form-control" name="curp" value="<?= $user['CURP'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Padecimientos</label>
                <input type="text" class="form-control" name="padecimientos" value="<?= $user['padecimientos'] ?>" required>
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
