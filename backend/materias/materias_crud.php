<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $tipoFiltro = $_GET['tipo'] ?? 'todos';
    $query = "SELECT * FROM Materia";
    if ($tipoFiltro !== 'todos') {
        $query .= " WHERE idGrado = '$tipoFiltro'";
    }
    $query .= " ORDER BY idGrado ASC";

    $resultado = mysqli_query($conexion, $query);
    
?>

<h3 class="mb-3">Gestión de Materias</h3>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <label for="filtroTipo" class="form-label me-2">Filtrar por tipo:</label>
        <select id="filtroTipo" class="form-select d-inline-block w-auto" onchange="filtrarMateriasPorTipo(this.value)">
            <option value="todos" <?= $tipoFiltro == 'todos' ? 'selected' : '' ?>>Todos</option>
            <option value="1" <?= $tipoFiltro == '1' ? 'selected' : '' ?>>Primer grado</option>
            <option value="2" <?= $tipoFiltro == '2' ? 'selected' : '' ?>>Segundo grado</option>
            <option value="3" <?= $tipoFiltro == '3' ? 'selected' : '' ?>>Tercer grado</option>
        </select>
    </div>
    <button class="btn btn-primary" onclick="mostrarFormularioNuevaMateria()">Nuevo Materia</button>
</div>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Grado</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
            <tr>
                <td><?= $row['idMateria'] ?></td>
                <td><?= htmlspecialchars($row['idGrado']) ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= ucfirst($row['tipo']) ?></td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="editarMateria(<?= $row['idMateria'] ?>)">Editar</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="eliminarMateria(<?= $row['idMateria'] ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
