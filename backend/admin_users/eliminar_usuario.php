<?php
require "../../db/conection/conn.php";
$conexion = conectarBD();

$idUsuario = $_POST['idUsuario'] ?? null;

if (!$idUsuario) {
    echo "ID inválido";
    exit;
}

// Obtener tipo para borrar de tabla específica
$result = mysqli_query($conexion, "SELECT tipo FROM Usuario WHERE idUsuario = $idUsuario");
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Usuario no encontrado";
    exit;
}
$tipo = mysqli_fetch_assoc($result)['tipo'];

// Borrar de tabla secundaria
switch ($tipo) {
    case 'admin':
        mysqli_query($conexion, "DELETE FROM Administrador WHERE idUsuario = $idUsuario");
        break;
    case 'docente':
        mysqli_query($conexion, "DELETE FROM Docente WHERE idUsuario = $idUsuario");
        break;
    case 'estudiante':
        mysqli_query($conexion, "DELETE FROM Estudiante WHERE idUsuario = $idUsuario");
        break;
    case 'tutor':
        mysqli_query($conexion, "DELETE FROM Tutor WHERE idUsuario = $idUsuario");
        break;
}

// Borrar de tabla principal
mysqli_query($conexion, "DELETE FROM Usuario WHERE idUsuario = $idUsuario");

desconectarBD($conexion);
echo "OK";
