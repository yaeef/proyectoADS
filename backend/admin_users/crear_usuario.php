<?php
    require "../../db/conection/conn.php";
    $conexion = conectarBD();
    $tipo = $_POST['tipo'] ?? '';

    if($tipo === "admin") #Añadir administrador
    {
        $nombre = $_POST['nombre'] ?? '';
        $paterno = $_POST['paterno'] ?? '';
        $materno = $_POST['materno'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $calle = $_POST['calle'] ?? '';
        $colonia = $_POST['colonia'] ?? '';
        $cp = $_POST['cp'] ?? '';
        $nacimiento = $_POST['nacimiento'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $rfc = $_POST['rfc'] ?? '';
        $padecimientos = $_POST['padecimientos'] ?? '';

        if ($tipo === '' || $nombre === '' || $paterno === '' || $materno === '' || $telefono === '' || $calle === '' || $colonia === '' || $cp === '' || $nacimiento === '' || $correo === '' || $rfc === '' || $padecimientos === '') 
        {
            echo "Faltan datos obligatorios";
            exit;
        }
        #Inserción en tabla Usuarios (Se deben generar el usuario y contraseña)
        $usuario = 'A' . rand(100000, 999999);  #Aqui se genera los 6 números aleatorios y se concatenan a "A"
        $contrasena = 'A' . $rfc . rand(100,999);#Aqui se genera la contrasena como A+RFC+3 números aleatorios :)
        $insertUsuario = "INSERT INTO Usuario (usuario, contrasena, tipo) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $insertUsuario);
        mysqli_stmt_bind_param($stmt, "sss", $usuario, $contrasena, $tipo);

        if (!mysqli_stmt_execute($stmt)) 
        {
            echo "Error al insertar en Usuario: " . mysqli_error($conexion);
            exit;
        }

        #Ahora que se inserto el usuario necesitamos recuperar el id con el que se creo para vincularlo con la tabla Administrador
        $idUsuario = mysqli_insert_id($conexion);
        $insertAdmin = "INSERT INTO Administrador(idUsuario,noEmpleado, nombre, paterno, materno, telefono, calle, colonia, CP, fechaNacimiento, correo, RFC, padecimientos) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = mysqli_prepare($conexion, $insertAdmin);
        mysqli_stmt_bind_param($stmt, "issssssssssss", $idUsuario, $usuario, $nombre, $paterno, $materno, $telefono, $calle, $colonia, $cp, $nacimiento, $correo, $rfc, $padecimientos);
        if (!mysqli_stmt_execute($stmt)) 
        {
            echo "Error al insertar en Administrador: " . mysqli_error($conexion);
            exit;
        }
        #Mandamos por correo el user y password :)
        $asunto = 'Bienvenido a nuestro sistema escolar';
        $cuerpo = "Hola, \n\nTu cuenta ha sido creada exitosamente. Aquí están tus credenciales de acceso:\n\n";
        $cuerpo .= "Usuario: $usuario\n";
        $cuerpo .= "Contraseña: $contrasena\n\n";
        $cuerpo .= "Gracias por registrarte con nosotros.\n\n";
        $headers = 'From: noreply@gestionescolar.com';
        mail($correo, $asunto, $cuerpo, $headers);

    }
    else if($tipo === "docente")  #Añadir docente
    {
        $nombre = $_POST['nombre'] ?? '';
        $paterno = $_POST['paterno'] ?? '';
        $materno = $_POST['materno'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $calle = $_POST['calle'] ?? '';
        $colonia = $_POST['colonia'] ?? '';
        $cp = $_POST['cp'] ?? '';
        $nacimiento = $_POST['nacimiento'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $rfc = $_POST['rfc'] ?? '';
        $tipoDocente = $_POST['tipoDocente'];
        $padecimientos = $_POST['padecimientos'] ?? '';

        if ($tipo === '' || $nombre === '' || $paterno === '' || $materno === '' || $telefono === '' || $calle === '' || $colonia === '' || $cp === '' || $nacimiento === '' || $correo === '' || $rfc === '' || $padecimientos === '' || $tipoDocente === '') 
        {
            echo "Faltan datos obligatorios";
            exit;
        }
        #Inserción en tabla Usuarios (Se deben generar el usuario y contraseña)
        $usuario = 'D' . rand(100000, 999999);  #Aqui se genera los 6 números aleatorios y se concatenan a "A"
        $contrasena = $tipoDocente . $rfc . rand(100,999);#Aqui se genera la contrasena como [CA|CB]+RFC+3 números aleatorios :)
        $insertUsuario = "INSERT INTO Usuario (usuario, contrasena, tipo) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $insertUsuario);
        mysqli_stmt_bind_param($stmt, "sss", $usuario, $contrasena, $tipo);

        if (!mysqli_stmt_execute($stmt)) 
        {
            echo "Error al insertar en Usuario: " . mysqli_error($conexion);
            exit;
        }

        #Ahora que se inserto el usuario necesitamos recuperar el id con el que se creo para vincularlo con la tabla Docente
        $idUsuario = mysqli_insert_id($conexion);
        $insertDocente = "INSERT INTO Docente(idUsuario,noEmpleado, nombre, paterno, materno, telefono, calle, colonia, CP, fechaNacimiento, correo, RFC, tipo, padecimientos) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = mysqli_prepare($conexion, $insertDocente);
        mysqli_stmt_bind_param($stmt, "isssssssssssss", $idUsuario, $usuario, $nombre, $paterno, $materno, $telefono, $calle, $colonia, $cp, $nacimiento, $correo, $rfc, $tipoDocente,$padecimientos);
        if (!mysqli_stmt_execute($stmt)) 
        {
            echo "Error al insertar en Docente: " . mysqli_error($conexion);
            exit;
        }
        #Mandamos por correo el user y password :)
        $asunto = 'Bienvenido a nuestro sistema escolar';
        $cuerpo = "Hola, \n\nTu cuenta ha sido creada exitosamente. Aquí están tus credenciales de acceso:\n\n";
        $cuerpo .= "Usuario: $usuario\n";
        $cuerpo .= "Contraseña: $contrasena\n\n";
        $cuerpo .= "Gracias por registrarte con nosotros.\n\n";
        $headers = 'From: noreply@gestionescolar.com';
        mail($correo, $asunto, $cuerpo, $headers);
    }
    else if($tipo === "estudiante")  #Añadir Estudiante
    {
        $nombre = $_POST['nombre'] ?? '';
        $paterno = $_POST['paterno'] ?? '';
        $materno = $_POST['materno'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $calle = $_POST['calle'] ?? '';
        $colonia = $_POST['colonia'] ?? '';
        $cp = $_POST['cp'] ?? '';
        $nacimiento = $_POST['nacimiento'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $curp = $_POST['curp'] ?? '';
        $padecimientos = $_POST['padecimientos'] ?? '';

        if ($tipo === '' || $nombre === '' || $paterno === '' || $materno === '' || $telefono === '' || $calle === '' || $colonia === '' || $cp === '' || $nacimiento === ''  || $correo === '' || $curp === '' || $padecimientos === '') 
        {
            echo "Faltan datos obligatorios";
            exit;
        }
        #Inserción en tabla Usuarios (Se deben generar el usuario y contraseña)
        $randomNum = rand(1000, 9999);                          #Se almacena porque se usara en la contraseña y en la boleta
        $usuario = 'B' . date("Y") . $randomNum;                #Aqui se genera los 4 números aleatorios y se concatenan a "B" junto al año en curso
        $contrasena = substr($nombre, 0, 1) . substr($paterno, 0, 1) . substr($materno, 0, 1) . 'B' . $randomNum;    #Aqui se genera la contrasena como INICIALES+B+NUMEROS ALEATORIOS :)
        $insertUsuario = "INSERT INTO Usuario (usuario, contrasena, tipo) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $insertUsuario);
        mysqli_stmt_bind_param($stmt, "sss", $usuario, $contrasena, $tipo);

        if (!mysqli_stmt_execute($stmt)) 
        {
            echo "Error al insertar en Usuario: " . mysqli_error($conexion);
            exit;
        }

        #Ahora que se inserto el usuario necesitamos recuperar el id con el que se creo para vincularlo con la tabla Docente
        $idUsuario = mysqli_insert_id($conexion);
        $insertEstudiante = "INSERT INTO Estudiante(idUsuario,boleta, nombre, paterno, materno, calle, colonia, CP, fechaNacimiento, correo, CURP, padecimientos) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = mysqli_prepare($conexion, $insertEstudiante);
        mysqli_stmt_bind_param($stmt, "isssssssssss", $idUsuario, $usuario, $nombre, $paterno, $materno, $calle, $colonia, $cp, $nacimiento, $correo, $curp, $padecimientos);
        if (!mysqli_stmt_execute($stmt)) 
        {
            echo "Error al insertar en Estudiante: " . mysqli_error($conexion);
            exit;
        }
        #Mandamos por correo el user y password :)
        $asunto = 'Bienvenido a nuestro sistema escolar';
        $cuerpo = "Hola, \n\nTu cuenta ha sido creada exitosamente. Aquí están tus credenciales de acceso:\n\n";
        $cuerpo .= "Usuario: $usuario\n";
        $cuerpo .= "Contraseña: $contrasena\n\n";
        $cuerpo .= "Gracias por registrarte con nosotros.\n\n";
        $headers = 'From: noreply@gestionescolar.com';
        mail($correo, $asunto, $cuerpo, $headers);
        
    }
    else if($tipo === "tutor")  #Añadir tutor
    {
        $nombre = $_POST['nombre'] ?? '';
        $paterno = $_POST['paterno'] ?? '';
        $materno = $_POST['materno'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $calle = $_POST['calle'] ?? '';
        $colonia = $_POST['colonia'] ?? '';
        $cp = $_POST['cp'] ?? '';
        $nacimiento = $_POST['nacimiento'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $rfc = $_POST['rfc'] ?? '';
        $idEstudiante = $_POST['idEstudiante'];     #Aqui se obtiene el idEstudiante

        /*Necesitamos recuperar la boleta y contraseña del estudiante*/
        $queryEstudiante = "
                            SELECT CONCAT('T', E.boleta) AS boleta, U.contrasena
                            FROM Estudiante E
                            JOIN Usuario U ON E.idUsuario = U.idUsuario
                            WHERE E.idEstudiante = ?
                        ";
                    
        $stmt = mysqli_prepare($conexion, $queryEstudiante);
        mysqli_stmt_bind_param($stmt, "i", $idEstudiante);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $usuario, $password);
        $usuario .= "T";
        if (!mysqli_stmt_fetch($stmt)) 
        {
            echo "Estudiante no encontrado.";
            exit;
        }

        mysqli_stmt_close($stmt);


        if ($tipo === '' || $nombre === '' || $paterno === '' || $materno === '' || $telefono === '' || $calle === '' || $colonia === '' || $cp === '' || $nacimiento === ''  || $correo === '' || $rfc === '') 
        {
            echo "Faltan datos obligatorios";
            exit;
        }
        #Inserción en tabla Tutor
        $contrasena = str_replace("B", "BA", $password);  #Aqui se modifica la contraseña del estudiante
        $insertUsuario = "INSERT INTO Usuario (usuario, contrasena, tipo) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $insertUsuario);
        mysqli_stmt_bind_param($stmt, "sss", $usuario, $contrasena, $tipo);

        if (!mysqli_stmt_execute($stmt)) 
        {
            echo "Error al insertar en Usuario: " . mysqli_error($conexion);
            exit;
        }

        #Ahora que se inserto el usuario necesitamos recuperar el id con el que se creo para vincularlo con la tabla Docente
        $idUsuario = mysqli_insert_id($conexion);
        $insertTutor = "INSERT INTO Tutor(idUsuario, idEstudiante, nombre, paterno, materno, telefono, calle, colonia, CP, correo, RFC, fechaNacimiento) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = mysqli_prepare($conexion, $insertTutor);
        mysqli_stmt_bind_param($stmt, "iissssssssss", $idUsuario, $idEstudiante, $nombre, $paterno, $materno, $telefono ,$calle, $colonia, $cp, $correo, $rfc, $nacimiento);
        if (!mysqli_stmt_execute($stmt)) 
        {
            echo "Error al insertar en Tutor: " . mysqli_error($conexion);
            exit;
        }
        #Mandamos por correo el user y password :)
        $asunto = 'Bienvenido a nuestro sistema escolar';
        $cuerpo = "Hola, \n\nTu cuenta ha sido creada exitosamente. Aquí están tus credenciales de acceso:\n\n";
        $cuerpo .= "Usuario: $usuario\n";
        $cuerpo .= "Contraseña: $contrasena\n\n";
        $cuerpo .= "Gracias por registrarte con nosotros.\n\n";
        $headers = 'From: noreply@gestionescolar.com';
        mail($correo, $asunto, $cuerpo, $headers);
        
    }
    desconectarBD($conexion);
    echo "OK";
?>