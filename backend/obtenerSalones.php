<?php
    require "../db/conection/conn.php";

    $conexion = conectarBD();

    #Función que recupera los salones de la BD y los retorna en formato JSON
    #1-Crea conexión con la base
    #2-Se define función que prepara el QUERY necesario para recuperar salones y los retorna en el arreglo $salones[]
    #3- Se manda el arreglo $salones[] con el nombre "salones" en formato JSON
    function recuperarSalones($conexion)
    {
        $query = "SELECT * FROM Salon;";
        $resultado = mysqli_query($conexion,$query);
        $salones = array();

        if(mysqli_num_rows($resultado) > 0)
        {
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $salones[] = $fila;
            }
            return $salones;
        }
        else
        {
            echo "Error al recuperar Salones de la BD: " . mysqli_error($conexion);
            return null;
        }
    }
    
    $fetchSalones = recuperarSalones($conexion);
    $response = array('salones' => $fetchSalones);
    desconectarBD($conexion);
    header('Content-Type: application/json');
    echo json_encode($response);
?>

