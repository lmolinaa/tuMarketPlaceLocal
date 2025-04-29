<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Añadimos la descripción en la cabecera porque es común a todas las páginas de sitio con el fin de mejorar el SEO -->
    <title>Tu Marketplace Local</title>
    <meta name="description" content="¡Somos el buscador de servicios en tu barrio! ¿Buscas un profesional? Tu vecino puede que lo sea.">
    <!-- Bootstrap y CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/cabecera.css">
    <link rel="stylesheet" href="../../../public/css/pie.css">
</head>

<body>
<?php
include_once __DIR__ . '/../../app/config/session.php';
ob_start(); //Inicia el almacenamiento en búfer de salida

/*Usamos el json para iterar las categorías y mostrarlas en el menú
Lo ponemos en la cabecera para que esté disponible en toda la web*/
$jsonFile = __DIR__ . '/../files/servicios.json';

// Leer y decodificar el JSON
$jsonData = file_get_contents($jsonFile);
$servicios = json_decode($jsonData, true); //Decodificamos como array asociativo

$permisosEdit = "";
$offer_services = "";
$usuarioS = "";
$emailS = "";
$id_usuario = "";
$login = "";
// Verifica la sesión del usuario
if (isset($_SESSION['email']) ?? '') {
    verifySession();
   //Llamo a la checkAccess para controlar lo que puede ver el usuario en función del rol
   $permisosEdit = checkAccess('edit_content'); //Verificar los permisos del usuario de edición (administrador)
   $offer_services = checkAccess('offer_services'); //Verificar los permisos del usuario sobre Ofrezco Servicio
   $login  = checkAccess('offer_services'); //Verificar los permisos del usuario sobre Ofrezco Servicio
   $usuarioS = $_SESSION['nombre'];
   $emailS = $_SESSION['email'];
   $id_usuario = $_SESSION['id_usuario'];
   $update_profile = checkAccess('update_profile'); //Verificar los permisos del usuario para modificar su propio perfil
}
?>

<!-- Cabecera -->
<header>
    <img src="/marketplace/public/img/logotipo-sinFondo.png" alt="MarketPlace Logo" data-bs-toggle='tooltipAll' data-bs-placement='top' title='MarketPlace - Tu buscador de servicios locales'>
    <h3 data-bs-toggle='tooltipAll' data-bs-placement='top' title='Uniendo a la Gente'><strong><i>Bringing people together</i></strong></h3>
<nav>
    <ul class="menu">
        <li class="tab"><a href="/marketplace" data-bs-toggle='tooltipAll' data-bs-placement='top' title='Vuelve a la página principal'><img class="iconoMenu" src='/marketplace/public/img/iconos/home-outline.svg'> Home</a></li>
        <li class="dropdown"><a href="/marketplace/app/views/actions/buscoOfrezco.php" data-bs-toggle='tooltipAll' data-bs-placement='top' title='Buscar servicios por ubicación o por categorías'><img class="iconoMenu" src='/marketplace/public/img/iconos/server-outline.svg'>Buscar Servicio</a>
            <ul class="submenu">
                <li><a href="/marketplace/app/views/actions/dashboard.php"><img class="iconoSubmenu" src='/marketplace/public/img/iconos/earth-outline.svg'>Por ubicación</a></li>
                <?php
                    // Iterar sobre las categorías
                    foreach ($servicios as $categoria => $listaServicios) {
                        if (is_string($categoria)) {
                            // Generar el enlace con urlencode
                            $categoriaUrl = urlencode($categoria);
                            $categoriaTexto = ucfirst(str_replace("_", " ", htmlspecialchars($categoria)));
                            echo "<li><a href=\"/marketplace/app/views/actions/buscoOfrezco.php?categoria=$categoriaUrl\"><img class='iconoSubmenu' src='/marketplace/public/img/iconos/checkmark-circle-outline.svg'>$categoriaTexto</a></li>";
                        }
                    }
                ?>               
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" data-bs-toggle='tooltipAll' data-bs-placement='top' title='¿Quiénes somos? ¿Qué te ofrecemos?'><img class="iconoMenu" src='/marketplace/public/img/iconos/information-circle-outline.svg'>Acerca de...</a>
            <ul class='submenu'>    
                <li class="tab"><a href="#" onclick="alert('Esta funcionalidad está pendiente de implementarse en la fase 2.')"><img class="iconoMenu" src='/marketplace/public/img/iconos/chatbox-ellipses-outline.svg'>Nosotros</a></li>
                <li class="tab"><a href="/marketplace/app/views/administracion/ofertasSuscripcion.php"><img class="iconoMenu" src='/marketplace/public/img/iconos/cart-outline.svg'>Nuestras ofertas</a></li>
            </ul>
        </li>
            <li class="dropdown">
        <?php
            if (!$usuarioS){    
                echo "<a href='#' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Usuarios'><img class='iconoMenu' src='/marketplace/public/img/iconos/person-circle-outline.svg'>Usuarios</a>";
            } else {
                echo "<a href='#' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Usuarios'><img class='iconoMenu' src='/marketplace/public/img/iconos/person-circle-outline.svg'>$usuarioS</a>";
            } 
            echo "<ul class='submenu'>";
            if (!$emailS){
                echo "<li><a href='#' data-bs-toggle='modal' data-bs-target='#loginModal'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/log-in-outline.svg'>Soy usuario</a></li>";
                echo "<li><a href='/marketplace/app/views/user/formCreateUsers.php'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/person-add-outline.svg'>Crear cuenta</a></li>";
            } else {
                if ($permisosEdit){
                    echo "<li><a href='#' onclick=\"alert('Esta funcionalidad está pendiente de implementarse en la fase 2.')\"><img class='iconoSubmenu' src='/marketplace/public/img/iconos/id-card-outline.svg'>Lista de usuarios</a></li>";
                    echo "<li><a href='/marketplace/app/views/user/formCreateUsers.php'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/person-add-outline.svg'>Nueva cuenta</a></li>";
                }
                if ($update_profile){
                    echo "<li><a href='/marketplace/app/controllers/userController.php?action=modificarPerfil&id_usuario=$id_usuario' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Configuración de la cuenta'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/construct-outline.svg'>$emailS</a></li>";
                    echo "<li><a href='/marketplace/app/controllers/userController.php?action=leerMensajes&id_usuario=$id_usuario' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Revisar mensajes recibidos'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/mail-unread-outline.svg'>Mensajes</a></li>";
                }
                if ($offer_services){
                    echo "<li><a href='/marketplace/app/controllers/actionsController.php?cardsByIdUsuario=$id_usuario' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Configurar mis Suscripciones de Ofrezco Servicio'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/briefcase-outline.svg'>Mis suscripciones</a></li>";
                }
                echo "<li><a href='/marketplace/app/views/user/logout.php?mensaje=La sesión se ha cerrado correctamente.'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/log-out-outline.svg'>Cerrar sesión</a></li>";
            }
        ?>
            </ul>
        </li>
        <li class="tab"><a href="#" onclick="alert('Esta funcionalidad está pendiente de implementarse en la fase 2.')"><img class="iconoMenu" src='/marketplace/public/img/iconos/mail-open-outline.svg'>Contacto</a></li>
    </ul>
</nav>
</header>
<script src="/marketplace/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
