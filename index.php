<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketPlace - Servicios Locales</title>

    <link rel="stylesheet" href="./public/css/styleLandingPage.css">
    <link rel="stylesheet" href="./public/css/cabecera.css">
    <link rel="stylesheet" href="./public/css/imagenLandingPage.css">
    <link rel="stylesheet" href="./public/css/pie.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
        function buscarPalabras() {
            const buscarPalabras = document.getElementById("buscarPalabras").value;
            window.location.href = './app/controllers/actionsController.php?buscarPalabras=' + buscarPalabras;

        }
    </script>

</head>
<body>
    <?php
        //Cabecera
        include './public/plantillas/cabecera.php';
    ?>
    <!-- Imagen con buscador -->
<div class="hero">
        <div class="search-container">
            <input type="text" id="buscarPalabras" name="buscarPalabras" placeholder="Busca servicios..." data-bs-toggle='tooltipAll' data-bs-placement='top' title='Buscar por municipio, servicio, categoría, empresa, precio o alguna palabra clave.'>
            <button onclick="javascript:buscarPalabras()"><img width="24px" height="24" src='/marketplace/public/img/iconos/search-outline.svg'></button>
        </div>
    </div>
<br>
<!-- Contenido principal -->
<h2>¡Somos el buscador de servicios en tu barrio!</h2>
<div class="landing-container" style="display: flex; justify-content: space-between; align-items: center;">
    
<!-- Sección izquierda -->
<div class="left-section" style="flex: 1; padding-right: 30px;">
    <h3>¿Buscas un profesional? Tu vecino puede que lo sea.</h3>   
    <p>
        Bienvenido a <strong>MarketPlace</strong>, la plataforma que conecta a personas que necesitan servicios con todos los profesionales de tu zona. 
        Regístrate hoy y descubre cómo podemos ayudarte a satisfacer tus necesidades o expandir tu negocio.
    </p>

    <p>
        <strong>¿Cuál es nuestro objetivo?</strong><br>
        Nuestro logo representa <strong>un mundo interconectado</strong>, un planeta de personas que interactúan unas con otras para alcanzar aquello que realmente necesitan.
        MarketPlace es la plataforma diseñada para ayudarte a lograrlo. ¿Tienes un negocio y ofreces un servicio? Entonces, a qué esperas para darte de alta en 
        <?php if (!isset($_SESSION['id_usuario'])): ?>
            <a href="./app/views/user/formCreateUsers.php"><strong>MarketPlace</strong></a>
        <?php else: ?>
            <strong>MarketPlace</strong>
        <?php endif; ?>
        y así encontrar a <strong>tu próximo cliente.</strong><br>
        ¿Buscas un servicio en tu zona? Pues date de alta en 
        <?php if (!isset($_SESSION['id_usuario'])): ?>
            <a href="./app/views/user/formCreateUsers.php"><strong>MarketPlace</strong></a>
        <?php else: ?>
            <strong>MarketPlace</strong>
        <?php endif; ?>
        y <strong>contacta con tu profesional más cercano.</strong>
        <img src="./public/img/logotipoOriginal.jpg" alt="logotipo marketplace">
        Nuestro objetivo es interconectar a las personas que necesitan algo con aquellas que ofrecen ese algo, tales como 
        <strong>Servicios del hogar, clases particulares, cuidado de mascotas, reparaciones en general, eventos, transportes y mudanzas, etc. </strong>
        Y todo al alcance de tu mano de forma rápida y sencilla.
    <br>
        Empieza a buscar y/u ofrecer servicios de todo tipo en tu barrio.
    <?php if (!isset($_SESSION['id_usuario'])): ?>
        <a href="./app/views/user/formCreateUsers.php"><strong>¡Regístrate ahora!</strong></a>
    <?php else: ?>
        <strong>¡Regístrate ahora!</strong>
    <?php endif; ?>
    </p>
</div>

    <!-- Sección derecha -->
    <div class="right-section" style="flex: 1; text-align: center;">
        <h3>Y si ya estás registrado, mira nuestras ofertas de suscripción</h3>
        <a href="/marketplace/app/views/administracion/ofertasSuscripcion.php">Nuestras ofertas <img class="iconoMenu" src='/marketplace/public/img/iconos/cart-outline.svg'></a>
        <br>
        <!-- Imagen representativa de la app -->
        <img src="./public/img/imagen_portada.png" alt="Imagen representativa de servicios locales">
        <!-- Mostramos el botón de crear cuenta solo si No hay sesión iniciada -->
        <?php if (!isset($_SESSION['id_usuario'])): ?>
            <button class='botonDeco' id="crear_cuenta">
                Crear una cuenta
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- Modal de inicio de sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Mensaje de error dinámico -->
                <?php
                include './app/views/user/login.php'; // Incluir el archivo login.php
                ?>
            </div>
        </div>
    </div>
</div>

    <!-- Pie de página -->
    <footer>
        <p>
            <?php
                include './public/plantillas/pie.php';
            ?>
        </p>
    </footer>

    <script>
        // Lógica para el botón de Log In/Log Out
        document.getElementById('crear_cuenta').addEventListener('click', function() {
                window.location.href = './app/views/user/formCreateUsers.php';
        });
    </script>
    <!-- Incluir JS de Bootstrap y sus dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

</body>
</html>