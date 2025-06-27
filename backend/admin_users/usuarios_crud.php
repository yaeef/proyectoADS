<?php
require "../../db/conection/conn.php";

$conexion = conectarBD();

function recuperarUsuarios($conexion)
{
    $query = "
        SELECT u.idUsuario, u.usuario, u.tipo, u.bloqueado,
               COALESCE(a.nombre, d.nombre, e.nombre, t.nombre) AS nombre,
               COALESCE(a.paterno, d.paterno, e.paterno, t.paterno) AS paterno,
               COALESCE(a.noEmpleado, d.noEmpleado, e.boleta, '') AS identificador
        FROM Usuario u
        LEFT JOIN Administrador a ON u.tipo = 'admin' AND u.idUsuario = a.idUsuario
        LEFT JOIN Docente d ON u.tipo = 'docente' AND u.idUsuario = d.idUsuario
        LEFT JOIN Estudiante e ON u.tipo = 'estudiante' AND u.idUsuario = e.idUsuario
        LEFT JOIN Tutor t ON u.tipo = 'tutor' AND u.idUsuario = t.idUsuario
    ";

    $resultado = mysqli_query($conexion, $query);
    $usuarios = array();

    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $fila;
        }
        return $usuarios;
    } else {
        return null;
    }
}

$usuarios = recuperarUsuarios($conexion);
desconectarBD($conexion);

// Render HTML como respuesta (no JSON)
if (!$usuarios) {
    echo '<div class="alert alert-warning">No se encontraron usuarios.</div>';
    exit;
}
?>

<h3 class="mb-3">Gestión de Usuarios</h3>
<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Tipo</th>
            <th>Bloqueado</th>
            <th>Nombre</th>
            <th>Paterno</th>
            <th>Identificador</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $row): ?>
            <tr>
                <td><?= $row['idUsuario'] ?></td>
                <td><?= htmlspecialchars($row['usuario']) ?></td>
                <td><?= ucfirst($row['tipo']) ?></td>
                <td><?= $row['bloqueado'] ? 'Sí' : 'No' ?></td>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= htmlspecialchars($row['paterno']) ?></td>
                <td><?= htmlspecialchars($row['identificador']) ?></td>
                <td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm" onclick="editarUsuario(<?= $row['idUsuario'] ?>)">Editar</button>
                        <button class="btn btn-outline-danger btn-sm" onclick="eliminarUsuario(<?= $row['idUsuario'] ?>)">Eliminar</button>
                    </td>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<button class="btn btn-primary mt-3" onclick="mostrarFormularioNuevoUsuario()">Nuevo Usuario</button>
