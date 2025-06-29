function cargarUsuarios() {
    $.ajax({
        url: '../backend/admin_users/usuarios_crud.php',
        method: 'GET',
        success: function (data) {
            $('#divDinamico').html(data);
        },
        error: function () {
            $('#divDinamico').html('<div class="alert alert-danger">Error al cargar usuarios.</div>');
        }
    });
}

function mostrarFormularioNuevoUsuario() {
    $.ajax({
        url: '../backend/admin_users/form_nuevo_usuario.php',
        success: function (html) {
            $('#modalContentCRUD').html(html);
            $('#modalCRUD').modal('show');
        },
        error: function () {
            alert('Error al cargar el formulario de nuevo usuario');
        }
    });
}

function editarUsuario(id, tipoUsuario) {
    $.ajax({
        url: '../backend/admin_users/form_editar_usuario.php',
        method: 'GET',
        data: { idUsuario: id , tipo: tipoUsuario},
        success: function (html) {
            $('#modalContentCRUD').html(html);
            $('#modalCRUD').modal('show');
        },
        error: function () {
            alert('Error al cargar datos del usuario');
        }
    });
}

function eliminarUsuario(id) {
    if (!confirm('¿Deseas eliminar este usuario?')) return;

    $.ajax({
        url: '../backend/admin_users/eliminar_usuario.php',
        method: 'POST',
        data: { idUsuario: id },
        success: function (res) {
            if (res === 'OK') {
                alert('Usuario eliminado');
                cargarUsuarios();
            } else {
                alert('Error al eliminar usuario: ' + res);
            }
        },
        error: function () {
            alert('Error al intentar eliminar');
        }
    });
}

function filtrarUsuariosPorTipo(tipo) {
    $.ajax({
        url: '../backend/admin_users/usuarios_crud.php',
        method: 'GET',
        data: { tipo: tipo },
        success: function (data) {
            $('#divDinamico').html(data);
            $('#filtroTipo').val(tipo);
        },
        error: function () 
        {   
            $('#divDinamico').html('<div class="alert alert-danger">Error al filtrar usuarios.</div>');
        }
    });
}
