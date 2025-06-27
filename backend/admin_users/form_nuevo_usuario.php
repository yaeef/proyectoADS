<?php
require "../../db/conection/conn.php";
?>

<div class="modal-header">
    <h5 class="modal-title">Nuevo Usuario</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formNuevoUsuario">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Usuario</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="">Seleccione</option>
                <option value="admin">Administrador</option>
                <option value="docente">Docente</option>
                <option value="estudiante">Estudiante</option>
                <option value="tutor">Tutor</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="paterno" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="paterno" name="paterno" required>
        </div>
        <div class="mb-3" id="campoIdentificador">
            <!-- Este se llena dinámicamente dependiendo del tipo -->
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" form="formNuevoUsuario" class="btn btn-primary">Guardar</button>
</div>

<script>
    $('#tipo').on('change', function () {
        const tipo = $(this).val();
        let html = '';
        if (tipo === 'admin' || tipo === 'docente') {
            html = `
                <label for="noEmpleado" class="form-label">No. Empleado</label>
                <input type="text" class="form-control" id="noEmpleado" name="noEmpleado" required>
            `;
        } else if (tipo === 'estudiante') {
            html = `
                <label for="boleta" class="form-label">Boleta</label>
                <input type="text" class="form-control" id="boleta" name="boleta" required>
            `;
        } else {
            html = ''; // tutor no tiene identificador extra
        }
        $('#campoIdentificador').html(html);
    });

    $('#formNuevoUsuario').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '../backend/admin_users/crear_usuario.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function (resp) {
                if (resp === 'OK') {
                    $('#modalCRUD').modal('hide');
                    cargarUsuarios();
                } else {
                    alert('Error al crear usuario: ' + resp);
                }
            },
            error: function () {
                alert('Error en la petición AJAX');
            }
        });
    });
</script>
