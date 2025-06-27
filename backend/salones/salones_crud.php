<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$tipoFiltro = $_GET['tipo'] ?? 'todos';

$query = "SELECT * FROM salon";
if ($tipoFiltro !== 'todos') {
    $query .= " WHERE tipo = '$tipoFiltro'";
}
$query .= " ORDER BY nombre ASC";

$resultado = mysqli_query($conexion, $query);
?>

<h3 class="mb-3">Gestión de Salones</h3>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <label for="filtroTipo" class="form-label me-2">Filtrar por tipo:</label>
        <select id="filtroTipo" class="form-select d-inline-block w-auto" onchange="filtrarSalonesPorTipo(this.value)">
            <option value="todos" <?= $tipoFiltro == 'todos' ? 'selected' : '' ?>>Todos</option>
            <option value="salon" <?= $tipoFiltro == 'salon' ? 'selected' : '' ?>>Salones</option>
            <option value="taller" <?= $tipoFiltro == 'taller' ? 'selected' : '' ?>>Talleres</option>
        </select>
    </div>
    <button class="btn btn-primary" onclick="mostrarFormularioNuevoSalon()">Nuevo Salón</button>
</div>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Capacidad</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
            <tr>
                <td><?= $row['idSalon'] ?></td>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= $row['capacidad'] ?></td>
                <td><?= ucfirst($row['tipo']) ?></td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="editarSalon(<?= $row['idSalon'] ?>)">Editar</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="eliminarSalon(<?= $row['idSalon'] ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
