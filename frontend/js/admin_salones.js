function cargarSalones() {
    $.ajax({
        url: '../backend/salones/salones_crud.php',
        method: 'GET',
        success: function (data) {
            $('#divDinamico').html(data);
        },
        error: function () {
            $('#divDinamico').html('<div class="alert alert-danger">Error al cargar salones.</div>');
        }
    });
}

function mostrarFormularioNuevoSalon() {
    $.get('../backend/salones/form_nuevo_salon.php', function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function editarSalon(id) {
    $.get('../backend/salones/form_editar_salon.php', { idSalon: id }, function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function eliminarSalon(id) {
    if (!confirm('¿Deseas eliminar este salón?')) return;
    $.post('../backend/salones/eliminar_salon.php', { idSalon: id }, function (resp) {
        if (resp === 'OK') {
            cargarSalones();
        } else {
            alert('Error al eliminar salón: ' + resp);
        }
    });
}

function filtrarSalonesPorTipo(tipo) {
    $.ajax({
        url: '../backend/salones/salones_crud.php',
        method: 'GET',
        data: { tipo },
        success: function (data) {
            $('#divDinamico').html(data);
        },
        error: function () {
            $('#divDinamico').html('<div class="alert alert-danger">Error al filtrar salones.</div>');
        }
    });
}
