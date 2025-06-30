function cargarInscripciones() {
    $.ajax({
        url: '../backend/grupo_estudiante/grupo_estudiante_crud.php',
        method: 'GET',
        success: function(data) {
            $('#divDinamico').html(data);
        }
    });
}

function mostrarModalInscribir(idGrupo) {
    $.ajax({
        url: '../backend/grupo_estudiante/form_asignar_alumno.php',
        method: 'GET',
        data: { idGrupo: idGrupo },
        success: function(data) {
            $('#modalContentCRUD').html(data);
            $('#modalCRUD').modal('show');
        }
    });
}
