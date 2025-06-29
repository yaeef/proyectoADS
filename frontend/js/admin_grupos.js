// Cargar la tabla de grupos
function cargarGrupos() {
    $.ajax({
        url: '../backend/grupos/grupos_crud.php',
        method: 'GET',
        success: function(data) {
            $('#divDinamico').html(data);
        },
        error: function(err) {
            alert("Error al cargar grupos: " + err.statusText);
        }
    });
}

// Mostrar formulario para nuevo grupo
function mostrarFormularioNuevoGrupo() {
    $.ajax({
        url: '../backend/grupos/form_nuevo_grupo.php',
        method: 'GET',
        success: function(data) {
            $('#divDinamico').html(data);
        },
        error: function() {
            alert("No se pudo cargar el formulario.");
        }
    });
}

// Mostrar formulario para editar grupo
function editarGrupo(id) {
    $.ajax({
        url: '../backend/grupos/form_editar_grupo.php',
        method: 'GET',
        data: { id: id }, // 👈 ESTA LÍNEA ENVÍA EL ID
        success: function(data) {
            $('#divDinamico').html(data);
        },
        error: function(err) {
            alert("Error al cargar el formulario de edición.");
        }
    });
}

// Eliminar grupo
function eliminarGrupo(id) {
    if (confirm("¿Deseas eliminar este grupo?")) {
        $.ajax({
            url: '../backend/grupos/eliminar_grupo.php',
            method: 'POST',
            data: { idGrupo: id },
            success: function(resp) {
                alert(resp);
                cargarGrupos();
            },
            error: function() {
                alert("Error al eliminar el grupo.");
            }
        });
    }
}

function filtrarGrupos() {
    const grado = $('#filtroGrado').val();

    $.ajax({
        url: '../backend/grupos/grupos_crud.php',
        method: 'GET',
        data: { grado: grado },
        success: function(data) {
            $('#divDinamico').html(data);
        }
    });
}
