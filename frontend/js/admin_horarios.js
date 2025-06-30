function cargarHorarios() {
    $.ajax({
        url: '../backend/horarios/grupos_horario.php',
        method: 'GET',
        success: function (html) {
            $('#divDinamico').html(html);
        },
        error: function () {
            $('#divDinamico').html('<div class="alert alert-danger">Error al cargar horarios.</div>');
        }
    });
}

function mostrarFormularioNuevoHorario() {
    $.get('../backend/horarios/form_nuevo_horario.php', function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function editarHorario(id) {
    $.get('../backend/horarios/form_editar_horario.php', { idHorario: id }, function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function eliminarHorario(id) {
    if (!confirm("¿Deseas eliminar este horario?")) return;
    $.post('../backend/horarios/eliminar_horario.php', { idHorario: id }, function(resp) {
        if (resp === 'OK') {
            cargarHorarios();
        } else {
            alert('Error: ' + resp);
        }
    });
}
