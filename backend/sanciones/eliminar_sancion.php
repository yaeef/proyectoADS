
<?php
    require_once "../../db/conection/conn.php";
    $conexion = conectarBD();

    $idSancion = $_POST['idSancion'] ?? null;
    if (!$idSancion) {
        echo "ID de sanción inválido.";
        exit;
    }

    $query = "DELETE FROM Sancion WHERE idSancion = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $idSancion);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error al eliminar la sanción. Es posible que esté asignada a un reporte.";
        exit;
    }

    mysqli_stmt_close($stmt);
    desconectarBD($conexion);
    echo "OK";
?>
