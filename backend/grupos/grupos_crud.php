<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();
$gradoFiltro = $_GET['grado'] ?? 'todos';

$query = "
SELECT G.idGrupo, G.nombre AS nombreGrupo, G.capacidad, G.turno,
       Gr.grado, P.estado AS periodo, S.nombre AS salon
FROM Grupo G
JOIN Grado Gr ON G.idGrado = Gr.idGrado
JOIN Periodo P ON G.idPeriodo = P.idPeriodo
JOIN Salon S ON G.idSalon = S.idSalon
WHERE 1
";

if ($gradoFiltro !== 'todos') {
    $query .= " AND G.idGrado = " . intval($gradoFiltro);
}

$query .= " ORDER BY G.nombre ASC";


$resultado = mysqli_query($conexion, $query);
?>

<h3 class="mb-3">Gestión de Grupos</h3>

<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-primary" onclick="mostrarFormularioNuevoGrupo()">Nuevo Grupo</button>
</div>

<div class="d-flex justify-content-between mb-3">
    <div>
        <label for="filtroGrado" class="form-label me-2">Filtrar por grado:</label>
        <select id="filtroGrado" class="form-select d-inline-block w-auto" onchange="filtrarGrupos()">
            <option value="todos" <?= $gradoFiltro == 'todos' ? 'selected' : '' ?>>Todos</option>
            <?php
            $gradosRes = mysqli_query($conexion, "SELECT idGrado, grado FROM Grado");
            while ($row = mysqli_fetch_assoc($gradosRes)) {
                $selected = ($gradoFiltro == $row['idGrado']) ? 'selected' : '';
                echo "<option value='{$row['idGrado']}' $selected>{$row['grado']}</option>";
            }
            ?>
        </select>
    </div>
</div>


<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Capacidad</th>
            <th>Turno</th>
            <th>Grado</th>
            <th>Periodo</th>
            <th>Salón</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($resultado)) : ?>
            <tr>
                <td><?= $row['idGrupo'] ?></td>
                <td><?= htmlspecialchars($row['nombreGrupo']) ?></td>
                <td><?= $row['capacidad'] ?></td>
                <td><?= ucfirst($row['turno']) ?></td>
                <td><?= $row['grado'] ?></td>
                <td><?= ucfirst($row['periodo']) ?></td>
                <td><?= htmlspecialchars($row['salon']) ?></td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="editarGrupo(<?= $row['idGrupo'] ?>)">Editar</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="eliminarGrupo(<?= $row['idGrupo'] ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
