<?php
require_once "../../db/conection/conn.php";
$conexion = conectarBD();

$idGrupo = $_POST['idGrupo'] ?? 0;

if ($idGrupo) {
    $stmt = $conexion->prepare("DELETE FROM Grupo WHERE idGrupo = ?");
    $stmt->bind_param("i", $idGrupo);

    if ($stmt->execute()) {
        echo "Grupo eliminado.";
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}
