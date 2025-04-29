<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; //Incluir el archivo cabecera.php

    //detalleByCard es un array que contiene los datos de la tarjeta seleccionada guardados en la sesión
    if (isset($_SESSION['detalleByCard'])) {
        $detalleByCard = $_SESSION['detalleByCard'];
        $isUbicacion = $_SESSION['isUbicacion'];

        /*echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";
            die();*/
    }
    $mensaje = $_GET['mensaje'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjeta detalle</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
    <link rel="stylesheet" href="/marketplace/public/css/detalleOfreceStyle.css">
</head>
<body>

    <?php foreach ($detalleByCard as $card): 
        $date = new DateTime($card['fecha']);
        $dateSuscripcion = new DateTime($card['fecha_suscripcion']);
    ?>
        <h2>
            <?php
            //Controlamos adonde debe volver, si es por ubicación o por categoría/servicio
                if ($isUbicacion === "categoriaServicio"){
            ?>
            <a href="./serviciosCards.php?servicio=<?= htmlspecialchars($card['servicio']) ?>&categoria=<?= htmlspecialchars($card['categoria']) ?>">    
            <?php } else if ($isUbicacion === "municipio"){ ?>
                <a href="./serviciosCards.php?municipio=<?= htmlspecialchars($card['municipio']) ?>">
            <?php } else if ($isUbicacion === "cardUsuario"){ ?>
                <a href="/marketplace/app/controllers/actionsController.php?cardsByIdUsuario=<?= htmlspecialchars($card['id_usuario']) ?>">
            <?php } else if ($isUbicacion === "landingPage"){ ?>
                <a href="./buscoOfrezco.php">
            <?php } ?>

            <img class="iconoMenu" src='/marketplace/public/img/iconos/play-skip-back-outline.svg' data-bs-toggle="tooltipAll" data-bs-placement="top" title='Volver a la pantalla anterior.'>
            <?= htmlspecialchars($card['categoria']) ?> / <?= htmlspecialchars($card['servicio']) ?></a>
        </h2>
        <br>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $mensaje ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

    <div class="container">
        <div class="card">
            <img class= 'card-img' src="<?= htmlspecialchars($card['imagen']) ?>" alt="Imagen de <?= htmlspecialchars($card['titulo']) ?>">
            <div class="card-contact">
            <div class="card-title">Contacta</div>
                <img class="iconoSubmenu" src='/marketplace/public/img/iconos/man-outline.svg'>
                <strong>Contacto:</strong> <?= htmlspecialchars($card['nombre']) ?> <?= htmlspecialchars($card['apellido']); ?><br>
                <img class="iconoSubmenu" src='/marketplace/public/img/iconos/storefront-outline.svg'>
                <strong>Empresa:</strong> <?= htmlspecialchars($card['empresa']) ?><br>
                <img class="iconoSubmenu" src='/marketplace/public/img/iconos/call-outline.svg'>
                <strong>Teléfono de contacto:</strong> <?= htmlspecialchars($card['telefono']) ?><br>
                <img class="iconoSubmenu" src='/marketplace/public/img/iconos/mail-open-outline.svg'>
                <strong>Email de contacto:</strong> <?= htmlspecialchars($card['email']) ?><br>
                
                <!-- Solo mostramos la opción de contactar si el usuario no es propietario de la tarjeta -->
                <?php if ($_SESSION['id_usuario']!=$card['id_usuario']): ?>
                    <a href='#' data-bs-toggle='modal' data-bs-target='#contactoModal'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/paper-plane-outline.svg' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Contactar con <?= htmlspecialchars($card['nombre']) ?> <?= htmlspecialchars($card['apellido']); ?>'>
                    <strong>Contacta ahora:</strong></a><br><br>
                <?php endif; ?>
                
                <?php if (($_SESSION['id_usuario']===$card["id_usuario"]) || ($_SESSION['rol']==="administrador")): ?>
                    <img class="iconoSubmenu" src='/marketplace/public/img/iconos/calendar-number-outline.svg'>
                    <strong>Fecha suscripción:</strong> <?= htmlspecialchars($dateSuscripcion->format('d/m/Y')) ?><br>
                    <img class="iconoSubmenu" src='/marketplace/public/img/iconos/alarm-outline.svg'>
                    <strong>Duración:</strong> <?= htmlspecialchars($card['tiempo_suscripcion']) ?> meses<br>
                    <img class="iconoSubmenu" src='/marketplace/public/img/iconos/cash-outline.svg'>
                    <strong>Cuota satisfecha:</strong> <?= htmlspecialchars($card['valor']) ?> €<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href='/marketplace/app/controllers/actionsController.php?id_card_update=<?= htmlspecialchars($card["id_usuario_ofrece"]) ?>'><img class='iconoSubmenu' src='/marketplace/public/img/iconos/pencil-outline.svg' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Editar datos tarjeta'></a>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0);" onclick="avisoEliminar(<?= $card['id_usuario_ofrece'] ?>,<?= $card['id_usuario'] ?>);"><img class='iconoMenu' src='/marketplace/public/img/iconos/trash-outline.svg' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Eliminar tarjeta'></a>
                <?php endif; ?>
                
            </div>
            <div class="card-content">
                <div class="card-title"><?= htmlspecialchars($card['titulo']) ?></div>
                <div class="card-detail"><?= htmlspecialchars($card['detalle']) ?></div>
                <div class="card-footer">
                    <img class='iconoSubmenu' src='/marketplace/public/img/iconos/megaphone-outline.svg'>
                    <strong>Activo desde:</strong> <?= htmlspecialchars($date->format('d/m/Y')) ?><br>
                    <img class="iconoSubmenu" src='/marketplace/public/img/iconos/earth-outline.svg'>
                    <strong>Municipio del servicio:</strong> <?= htmlspecialchars($card['municipio']) ?><br>
                    <img class="iconoSubmenu" src='/marketplace/public/img/iconos/cash-outline.svg'>
                    <strong>Precio aproximado:</strong> <?= htmlspecialchars($card['precio']) ?> €<br>
                </div> <br><br>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <br><br>

  

<!-- Modal de inicio de sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                include '../user/login.php';
                ?>
            </div>
        </div>
    </div>
</div> 

<!-- Modal envío mensaje al usuario que ofrece servicio -->
<div class="modal fade" id="contactoModal" tabindex="-1" aria-labelledby="contactoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Cambiado para un modal más grande -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactoModalLabel">Contactar con Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                include '../administracion/contactoUsuario.php';
                ?>
            </div>
        </div>
    </div>
</div>  

    <!-- Pie de página -->
    <footer>
        <p>
            <?php
                include '../../../public/plantillas/pie.php';
            ?>
        </p>
    </footer>
     <!-- Bootstrap y control de palabras inapropiadas JS -->
     <script src="/marketplace/public/js/bootstrap.bundle.min.js"></script>
     <script src="/marketplace/public/js/mensajesAviso.js"></script>
    
    </body>
</html>