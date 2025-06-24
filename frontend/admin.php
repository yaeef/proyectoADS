<?php
    session_start();
    if(!isset($_SESSION['session']) || $_SESSION['session'] != 'admin')
    {
        header("location:login.php?notif=4");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/tbs.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Admin</title>
</head>
<body>
    <header class="header">
        <h1 class="header__titulo centrar-texto"><span></span>MODULO <span>ESCOLAR</span></h1>
        <img src="img/menu-resp.png" alt="Burger-Menu" class="menu-resp">
        
    </header>
    <nav class="nav">
        <div class="nav__barra contenedor">
            <a class="nav__enlace" href="index.php">Inicio</a>
            <a class="nav__enlace" href="#">Registro</a>
            <a class="nav__enlace" href="#">Acceso</a>
            <a class="nav__enlace boton--seleccion" href="../backend/logout.php" style="background-color: var(--rojo);">logout</a>
        </div>
    </nav>
    <main>
        <section  class="contenedor sombra">
            <h2 class="titulo-form">DASHBOARD</h2>
            <div class="container" >
                <div class="row">
                    <!-- Card de presentación -->
                    <div class="col-md-2 mb-4">
                        <div class="card" >
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Usur:<strong><?php echo "@".$_SESSION['usuario']; ?></strong></li>
                                    <li class="list-group-item">name: <strong><?php echo $_SESSION['nombre']; ?></strong></li>
                                    <li class="list-group-item">idEmp: <strong><?php echo $_SESSION['noEmpleado']; ?></strong></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">MENU DASHBOARD</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><a href="#" onclick="alert('Haz hecho clic en el enlace');" class="card-link">Usuarios</a></li>
                                    <li class="list-group-item"><a href="#" onclick="cargarEntidad('Salones')" class="card-link">Salones</a></li>
                                    <li class="list-group-item"><a href="#" class="card-link">Grupos</a></li>
                                    <li class="list-group-item"><a href="#" class="card-link">Horarios</a></li>
                                    <li class="list-group-item"><a href="#" class="card-link">Materias</a></li>
                                    <li class="list-group-item"><a href="#" class="card-link">Sanciones</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Card dinámico para vaciar con ajax -->
                    <div class="col-md-10 mb-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <!-- Div dinámico para vaciar con ajax. En este div es donde se mostrara el contenido dinámico -->
                                <div id="divDinamico">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal para CRUD, es una plantilla vacia que se llena dependiendo del modal necesario -->
        <div id="modalCRUD" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="modalContentCRUD">
            <!-- Aquí se carga contenido dinámico dependiendo de la función del CRUD-->
            </div>
        </div>
        </div>
        
    </main>
    <footer>
        <div class="footer contenedor">
            <div class="footer__logos">
                <a href="http://www.ipn.mx/" target="_blank"><img src="img/IPN-Logo.png" alt="Logotipo del IPN"></a>
                <a href="http://www.escom.ipn.mx/" target="_blank"><img src="img/logoESCOMBlanco.png" alt="Logotipo de ESCOM"></a>
                
            </div>
            <div class="footer__texto">
            <p>Módulo de Gestión Escolar | ESCOM IPN |Todos los derechos reservados ©</p>
            </div>
        </div>
    </footer>
    <script src="js/admin_salones.js"></script>   <!-- Este es el archivo JS donde se encuentra la lógica para mostrar los salones y modales de forma dinámica-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>