<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/tbs.png" type="image/x-icon">
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
            <a class="nav__enlace boton--seleccion" href="admin.php">login</a>
        </div>
    </nav>
    <main>
        <section class="contenedor sombra">
        <h2 class="titulo-form">Módulo de Gestión Escolar</h2>
        <form action="#" class="formulario" method="post">
            <fieldset>
                <legend>Inicio de sesión:</legend>
                <div class="contenedor-campos">
                    <div class="formulario__campo">
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" id="usuario" required>
                    </div>
                    <div class="formulario__campo">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    </div>
                    <div class="formulario__boton">
                        <input class="boton" type="reset" value="Limpiar">
                        <input class="boton" type="submit" value="login">
                    </div>
                </fieldset>
            </form>
        </section>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>