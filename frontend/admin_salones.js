// funciones.js

function cargarEntidad(tabla) {
    $.ajax({
        url: `../backend/obtener${tabla}.php`,             //Se obtiene los salones en formato JSON y se definen las funciones cuando hay un success o un error.
        type: 'GET',
        dataType: 'json',
        success: function(data) 
        {                          //Si se recuperan los salones sin error entonces vacialos en el divDinamico
            var contenedorDinaminco = document.getElementById('divDinamico');
            var salones = data.salones;
            let html = `<h3>Listado de ${tabla}</h3><table class="table"><thead><tr>`;
            // Encabezados
            for (let key in data.salones[0]) 
            {
                html += `<th>${key}</th>`;
            }
            
            html += `<th>Acciones</th></tr></thead><tbody>`;
            // Filas
            salones.forEach(item => {
                html += `<tr>`;
                for (let key in item) 
                {
                    html += `<td>${item[key]}</td>`;
                }
                html += `
                <td>
                    <button class="btn btn-warning btn-sm" onclick="abrirModalEditar('${tabla}', ${item.idSalon})">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="abrirModalEliminar('${tabla}', ${item.idSalon})">Eliminar</button>
                </td>
                </tr>`;
            });
            html += `</tbody></table>`;
            html += `<button class="btn btn-primary btn-lg" onclick="abrirModalCrear('${tabla}')">Crear</button>`;
            contenedorDinaminco.innerHTML = html;
        },
        error: function() 
        {
            alert('No hay Entidades registradas :(');
        }
    });
}

//Aqui van definidas las funciones que muestran el modal dinamico, buscan el archivo con la estructura del modal en $.get y se muestra con .show
function abrirModalEditar(tabla, id) 
{
    $.get(`modales/modal_editar_${tabla}.php`, { id: id }, function(html) 
    {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function abrirModalEliminar(tabla, id) {
    $.get(`modales/modal_eliminar_${tabla}.php`, { id: id }, function(html) 
    {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}

function abrirModalCrear(tabla) {
    $.get(`modales/modal_crear_${tabla}.php`, function(html) 
    {
        $('#modalContentCRUD').html(html);
        $('#modalCRUD').modal('show');
    });
}
