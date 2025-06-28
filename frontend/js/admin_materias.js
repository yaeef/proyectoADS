function cargarMaterias() {
    $.ajax({
        url: '../backend/materias/materias_crud.php',
        method: 'GET',
        success: function (data) {
            $('#divDinamico').html(data);
        },
        error: function () {
            $('#divDinamico').html('<div class="alert alert-danger">Error al cargar Materias.</div>');
        }
    });
}



function mostrarFormularioNuevaMateria() {
    $.get('../backend/materias/form_nueva_materia.php', function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function editarMateria(id) {
    $.get('../backend/materias/form_editar_materia.php', { idMateria: id }, function (html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function eliminarMateria(id) {
    if (!confirm('¿Deseas eliminar esta materia?')) return;
    $.post('../backend/materias/eliminar_materia.php', { idMateria: id }, function (resp) {
        if (resp === 'OK') {
            cargarMaterias();
        } else {
            alert('Error al eliminar materia: ' + resp);
        }
    });
}

function filtrarMateriasPorTipo(tipo) {
    $.ajax({
        url: '../backend/materias/materias_crud.php',
        method: 'GET',
        data: { tipo },
        success: function (data) {
            $('#divDinamico').html(data);
        },
        error: function () {
            $('#divDinamico').html('<div class="alert alert-danger">Error al filtrar materias.</div>');
        }
    });
}


