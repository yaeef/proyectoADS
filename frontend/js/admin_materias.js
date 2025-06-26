/**
 * Muestra los botones para seleccionar el grado (1ro, 2do, 3ro).
 */
function mostrarSeleccionGrado() {
    var contenedorDinaminco = document.getElementById('divDinamico');
    let html = `
        <h2>Materia</h2>
        <p>Selecciona un grado para ver las materias</p>
        <div class="mb-4">
            <button class="boton" onclick="cargarMaterias(1)">Primer Grado</button>
            <button class="boton" onclick="cargarMaterias(2)">Segundo Grado</button>
            <button class="boton" onclick="cargarMaterias(3)">Tercer Grado</button>
        </div>
    `;
    contenedorDinaminco.innerHTML = html;
}

function cargarMaterias(grado) {
    $.ajax({
        // RUTA CORREGIDA: Se quita /ADS/ para que sea relativa al archivo actual
        url: `backend/obtenerMaterias.php?grado=${grado}`,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var contenedorDinaminco = document.getElementById('divDinamico');
            var materias = data.materias;
            // ... (el resto de tu función success se queda igual) ...
            let html = `<h3>Listado de Materias para ${grado}° Grado</h3>`;
            if (data.materias && data.materias.length > 0) {
                html += `<table class="table"><thead><tr>`;
                for (let key in data.materias[0]) {
                    html += `<th>${key.toUpperCase()}</th>`;
                }
                html += `<th>ACCIONES</th></tr></thead><tbody>`;
                data.materias.forEach(item => {
                    html += `<tr>`;
                    for (let key in item) {
                        html += `<td>${item[key]}</td>`;
                    }
                    html += `<td>
                                <button class="btn btn-warning btn-sm" onclick="abrirModalEditar('materia', ${item.idMateria})">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="abrirModalEliminar('materia', ${item.idMateria})">Eliminar</button>
                             </td></tr>`;
                });
                html += `</tbody></table>`;
            } else {
                html += `<div class="alert alert-info">No hay materias registradas para este grado.</div>`;
            }
            html += `<button class="btn btn-primary btn-lg" onclick="abrirModalCrear('materia', ${grado})">Crear Materia</button>`;
            contenedorDinaminco.innerHTML = html;
        },
        error: function() {
            alert('Error al cargar las Materias.');
        }
    });
}

function abrirModalEditar(tabla, id) {
    // RUTA CORREGIDA: Se quita /ADS/
    $.get(`modales/modal_editar_${tabla}.php`, { id: id }, function(html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function abrirModalEliminar(tabla, id) {
    // RUTA CORREGIDA: Se quita /ADS/
    $.get(`modales/modal_eliminar_${tabla}.php`, { id: id }, function(html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function abrirModalCrear(tabla, grado) {
    // RUTA CORREGIDA: Se quita /ADS/
    $.get(`modales/modal_crear_${tabla}.php`, { grado: grado }, function(html) {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}