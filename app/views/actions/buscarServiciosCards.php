<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php
    unset($_SESSION['detalleByCard']);//borramos de la session el detalle
    /*echo "<pre>";
        print_r($_SESSION);
    echo "</pre>";
    die();*/

    $mensaje = $_GET['mensaje'] ?? '';
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
    <link rel="stylesheet" href="/marketplace/public/css/cardsStyle.css">
</head>
<body>  
   <br>
        <h2><a href="./buscoOfrezco.php">    
            <img class="iconoMenu" src='/marketplace/public/img/iconos/play-skip-back-outline.svg' data-bs-toggle="tooltipAll" data-bs-placement="top" title='Volver a la pantalla anterior.'>
            Categorías / Servicios</a></h2>

        <br>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $mensaje ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <br>
        
        <div class="container">
            <?php 
            //Entra aquí cuando buscamos por palabras desde el buscador del landingPage (index)
            if (isset($_SESSION['buscarPalabrasByCards']) ?? '') {
                $buscarPalabrasByCards = $_SESSION['buscarPalabrasByCards'];
                
                foreach ($buscarPalabrasByCards as $cards): ?>
                <div class="card">
                    <a href='/marketplace/app/controllers/actionsController.php?id_usuario=<?= htmlspecialchars($cards["id_usuario"]) ?>&categoria=<?= htmlspecialchars($cards["categoria"]) ?>&servicio=<?= htmlspecialchars($cards["servicio"]) ?>&isUbicacion=landingPage&id_usuario_ofrece=<?= htmlspecialchars($cards["id_usuario_ofrece"])?>'>
                        <img src="<?= htmlspecialchars($cards['imagen']) ?>" data-bs-toggle="tooltipAll" data-bs-placement="top" title="<?= htmlspecialchars($cards['titulo']) ?>">
                    </a>
                    <div class="card-content">
                        <h3 class="card-title"><?= htmlspecialchars($cards['servicio']) ?></h3>
                        <div class='card-info'>
                            <img class="iconoSubmenu" src='/marketplace/public/img/iconos/reader-outline.svg'>
                            <strong>Ofrezco: </strong><?= htmlspecialchars($cards['titulo']) ?><br>
                            <img class="iconoSubmenu" src='/marketplace/public/img/iconos/earth-outline.svg'>
                            <strong>Lugar: </strong><?= htmlspecialchars($cards['municipio']) ?><br>
                            <img class="iconoSubmenu" src='/marketplace/public/img/iconos/cash-outline.svg' data-bs-toggle="tooltipAll" data-bs-placement="top" title="Los precios son en €">
                            <strong>Precio apróx.: </strong><?= htmlspecialchars($cards['precio']) ?>
                        </div>
                    </div>
                </div>
            <?php 
                endforeach;
                unset($_SESSION['buscarPalabrasByCards']);
              //Entramos aquí en caso de estar buscando tarjetas por id_usuario (las tarjetas propias) 
            } else if (isset($_SESSION['idCardsByIdUsuario']) ?? '') {
                $idCardsByIdUsuario = $_SESSION['idCardsByIdUsuario'];
                
             //Recorremos el array de tarjetas por id_usuario, id_usuario_ofrece e id_suscripcion...
                foreach ($idCardsByIdUsuario as $cards): ?>
                <div class="card">
                        <a href='/marketplace/app/controllers/actionsController.php?id_usuario=<?= htmlspecialchars($cards["id_usuario"]) ?>&categoria=<?= htmlspecialchars($cards["categoria"]) ?>&servicio=<?= htmlspecialchars($cards["servicio"]) ?>&isUbicacion=cardUsuario&id_usuario_ofrece=<?= htmlspecialchars($cards["id_usuario_ofrece"])?>&id_suscripcion=<?= htmlspecialchars($cards["id_suscripcion"])?>'>
                            <img src="<?= htmlspecialchars($cards['imagen']) ?>" data-bs-toggle="tooltipAll" data-bs-placement="top" title="<?= htmlspecialchars($cards['titulo']) ?>">
                        </a>
                        <div class="card-content">
                            <h3 class="card-title"><?= htmlspecialchars($cards['servicio']) ?></h3>
                            <div class='card-info'>
                                <img class="iconoSubmenu" src='/marketplace/public/img/iconos/reader-outline.svg'>
                                <strong>Ofrezco: </strong><?= htmlspecialchars($cards['titulo']) ?><br>
                                <img class="iconoSubmenu" src='/marketplace/public/img/iconos/earth-outline.svg'>
                                <strong>Lugar: </strong><?= htmlspecialchars($cards['municipio']) ?><br>
                                <img class="iconoSubmenu" src='/marketplace/public/img/iconos/cash-outline.svg'>
                                <strong>Precio apróx.: </strong><?= htmlspecialchars($cards['precio']) ?> €
                            </div>
                        </div>
                    </div>
                <?php 
                    endforeach;
                    unset($_SESSION['idCardsByIdUsuario']);
                }
                ?>
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
                include '../user/login.php'; // Incluir el archivo login.php
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

</body>
</html>