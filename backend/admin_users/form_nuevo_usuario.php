<?php
require "../../db/conection/conn.php";
?>

<div class="modal-header">
    <h5 class="modal-title">Nuevo Usuario</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body ">
    <form id="formNuevoUsuario"> 
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Usuario</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="" selected disabled>Seleccione</option>
                <option value="admin">Administrador</option>
                <option value="docente">Docente</option>
                <option value="estudiante">Estudiante</option>
                <option value="tutor">Tutor</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ejemplo: Juan" required>
        </div>
        <div class="mb-3">
            <label for="paterno" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="paterno" name="paterno" placeholder="Ejemplo: Perez" required>
        </div>
        <div class="mb-3">
            <label for="materno" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" id="materno" name="materno" placeholder="Ejemplo: Perez" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ejemplo: 5512345678" pattern="[0-9]{10}" maxlength="10" required>
        </div>

        <div class="mb-3">
            <label for="calle" class="form-label">Calle</label>
            <input type="text" class="form-control" id="calle" name="calle" placeholder="Ejemplo: Avenida Politecnico" required>
        </div>
        <div class="mb-3">
            <label for="colonia" class="form-label">Colonia</label>
            <input type="text" class="form-control" id="colonia" name="colonia" placeholder="Ejemplo: Marina Nacional" required>
        </div>
        <div class="mb-3">
            <label for="cp" class="form-label">CP</label>
            <input type="text" class="form-control" id="cp" name="cp" placeholder="Ejemplo: 55170" pattern="[0-9]{5}" maxlength="5" required>
        </div>
        <div class="mb-3">
            <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="nacimiento" name="nacimiento" required>
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
        if (tipo === 'admin')
        {
            html = `
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ejemplo: ejemplo@dominio.com" required>
                </div>
                <div class="mb-3">
                    <label for="rfc" class="form-label">RFC</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ejemplo: ABCD123456EFG" pattern="^[A-Z]{4}\\d{6}[A-Z0-9]{3}$" maxlength="13" required>
                </div>
                <div class="mb-3">
                    <label for="padecimientos" class="form-label">Padecimientos</label>
                    <input type="text" class="form-control" id="padecimientos" name="padecimientos" placeholder="Ejemplo: Alérgias, discapacidad visual, etc." required>
                </div>
            `;
        } 
        else if (tipo === 'docente')
        {
            html = `
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ejemplo: ejemplo@dominio.com" required>
                </div>
                <div class="mb-3">
                    <label for="rfc" class="form-label">RFC</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ejemplo: ABCD123456EFG" pattern="^[A-Z]{4}\\d{6}[A-Z0-9]{3}$" maxlength="13" required>
                </div>
                <div class="mb-3">
                    <label for="tipoDocente" class="form-label">Tipo de Docente</label>
                    <select class="form-select" id="tipoDocente" name="tipoDocente" required>
                        <option value="" selected disabled>Seleccione</option>
                        <option value="CA">CA</option>
                        <option value="CB">CB</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="padecimientos" class="form-label">Padecimientos</label>
                    <input type="text" class="form-control" id="padecimientos" name="padecimientos" placeholder="Ejemplo: Alérgias, discapacidad visual, etc." required>
                </div>
            `;
        } 
        else if (tipo === 'estudiante')
        {
            html = `
                <div class="mb-3">
                    <label for="curp" class="form-label">CURP</label>
                    <input type="text" class="form-control" id="curp" name="curp" placeholder="Ejemplo: ABCD123456EFGHIJ78" pattern="[A-Z]{4}\\d{6}[HM]{1}[A-Z]{2}[A-Z0-9]{5}" maxlength="18" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ejemplo: ejemplo@dominio.com" required>
                </div>
                <div class="mb-3">
                    <label for="padecimientos" class="form-label">Padecimientos</label>
                    <input type="text" class="form-control" id="padecimientos" name="padecimientos" placeholder="Ejemplo: Alérgias, discapacidad visual, etc." required>
                </div>
            `;
        }
        else if (tipo === 'tutor') //Falta asignarle un alumno
        {
            html = `
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ejemplo: ejemplo@dominio.com" required>
                </div>
                <div class="mb-3">
                    <label for="rfc" class="form-label">RFC</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ejemplo: ABCD123456EFG" pattern="^[A-Z]{4}\\d{6}[A-Z0-9]{3}$" maxlength="13" required>
                </div>
            `;
        } 
        else 
        {
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
