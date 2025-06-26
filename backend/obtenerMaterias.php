<?php
session_start();
    require "../bd/conection/conn.php";
    #header('Content-Type: application/json');

    $conexion = conectarBD();

    if (!isset($_GET['grado'])) {
        http_response_code(400);
        echo json_encode(['error' => 'No se especificó un grado.']);
        desconectarBD($conexion);
        exit;
    }
    $grado_id = mysqli_real_escape_string($conexion, $_GET['grado']);


   
    function recuperarMaterias($conexion, $grado_id)
    {
        $query = "SELECT m.idMateria, m.nombre, m.tipo, g.nombre AS nombreGrupo, g.idGrado 
                  FROM Materia AS m
                  JOIN Grupo AS g ON m.idGrupo = g.idGrupo
                  WHERE g.idGrado = '$grado_id'";
                  
        $resultado = mysqli_query($conexion, $query);
        $materias = array();

       
        if(mysqli_num_rows($resultado) > 0)
        {
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $materias[] = $fila;
            }
            return $materias;
        }
        else
        {
           echo "Error al recuperar Materias de la BD: " . mysqli_error($conexion);
            return null;
        }
    }
    
    $fetchMaterias = recuperarMaterias($conexion, $grado_id);
    $response = array('materias' => $fetchMaterias);
    desconectarBD($conexion);
    header('Content-Type: application/json');
    echo json_encode($response);
?>