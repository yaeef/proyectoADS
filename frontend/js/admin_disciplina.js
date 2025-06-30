
function cargarModuloDisciplina() {
    $.ajax({
        url: '../backend/sanciones/sanciones_crud.php', 
        method: 'GET',
        success: function (data) {
            $('#divDinamico').html(data);
        },
        error: function () {
            $('#divDinamico').html('<div class="alert alert-danger">Error al cargar el módulo de disciplina.</div>');
        }
    });
}


function mostrarFormularioNuevoReporte() {
    $.get('../backend/reportes/form_nuevo_reporte.php', function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    }).fail(function() {
        alert('No se pudo cargar el formulario para crear un nuevo reporte.');
    });
}


function gestionarReporte(id) {
    $.get('../backend/reportes/form_gestionar_reporte.php', { idReporteConducta: id }, function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    }).fail(function() {
        alert('No se pudo cargar el formulario para gestionar el reporte.');
    });
}


function mostrarFormularioNuevaSancion() {
    $.get('../backend/sanciones/form_nueva_sancion.php', function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}


function editarSancion(id) {
    $.get('../backend/sanciones/form_editar_sancion.php', { idSancion: id }, function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}


function eliminarSancion(id) {
    if (!confirm('¿Estás seguro de que deseas eliminar esta sanción del catálogo? Si ya está asignada a un reporte, podría causar un error.')) return;

    $.post('../backend/sanciones/eliminar_sancion.php', { idSancion: id }, function (resp) {
        if (resp === 'OK') {
            cargarModuloDisciplina(); 
        } else {
            alert('Error al eliminar: ' + resp);
        }
    });
}
