<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php
    unset($_SESSION['detalleByCard']);//borramos de la session el detalle
    $mensaje = $_GET['mensaje'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de categorías/servicios</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
    <link rel="stylesheet" href="/marketplace/public/css/cardsStyle.css">
</head>
<body>
<?php
    include_once __DIR__ . '/../../../app/controllers/actionsController.php';
    //Si GET['municipio'] es '' quiere decir que no se busca por ubicación sino por categoría y servicio
    if (!isset($_GET['municipio']) ?? '') {
        $servicioSeleccionado = htmlspecialchars_decode($_GET['servicio']) ?? '';
        $categoriaSeleccionada = htmlspecialchars_decode($_GET['categoria']) ?? '';
        
        $actionController = new ActionController();
        $cardsByServicio = $actionController->consultaCards($servicioSeleccionado, $categoriaSeleccionada);
        /*echo "<pre>";
            print_r($cardsByServicio);
            echo "</pre>";
            die();*/
    ?>

    <br>
    <h2><a href="./buscoOfrezco.php?categoria=<?= htmlspecialchars($categoriaSeleccionada) ?>">    
        <img class="iconoMenu" src='/marketplace/public/img/iconos/play-skip-back-outline.svg' data-bs-toggle="tooltipAll" data-bs-placement="top" title='Volver a la pantalla anterior.'>
        <?= htmlspecialchars($categoriaSeleccionada) ?></a></h2>
        <br>
        <?php if (!empty($mensaje)): ?>
            
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $mensaje ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <br>

    <div class="container">
        <?php foreach ($cardsByServicio as $cards): ?>
            <div class="card">
                <a href='/marketplace/app/controllers/actionsController.php?id_usuario_ofrece=<?= htmlspecialchars($cards["id_usuario_ofrece"]) ?>&id_usuario=<?= htmlspecialchars($cards["id_usuario"]) ?>&categoria=<?= htmlspecialchars($categoriaSeleccionada) ?>&servicio=<?= htmlspecialchars($servicioSeleccionado) ?>&id_suscripcion=<?= htmlspecialchars($cards["id_suscripcion"])?>&isUbicacion=categoriaServicio'>
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
        <?php endforeach; ?>
    </div>
    <?php
    //Sino es que se está buscando por ubicación (en principio lo hacemos solo por municipio)
    } else {
        $municipio =  htmlspecialchars_decode($_GET['municipio']) ?? '';
        $actionController = new ActionController();
        $cardsByMunicipio = $actionController->consultaCardsByMunicipio($municipio);
    ?>
        <br>
        <h2><a href="./buscoOfrezco.php">    
            <img class="iconoMenu" src='/marketplace/public/img/iconos/play-skip-back-outline.svg' data-bs-toggle="tooltipAll" data-bs-placement="top" title='Volver a la pantalla anterior.'>
            Categorías / Servicios en <?php echo $municipio ?></a>
        </h2>
        <div class="container">
            <?php foreach ($cardsByMunicipio as $cards): ?>
                <div class="card">
                    <a href='/marketplace/app/controllers/actionsController.php?id_usuario_ofrece=<?= htmlspecialchars($cards["id_usuario_ofrece"]) ?>&id_usuario=<?php echo $cards["id_usuario"]; ?>&categoria=<?php echo $cards["categoria"]; ?>&servicio=<?php echo $cards["servicio"]; ?>&isUbicacion=municipio'>
                        <img src="<?php echo $cards['imagen']; ?>" data-bs-toggle="tooltipAll" data-bs-placement="top" title="<?php echo $cards['titulo']; ?>">
                    </a>
                    <div class="card-content">
                        <h3 class="card-title"><?php echo $cards['servicio']; ?></h3>
                        <div class='card-info'>
                            <img class="iconoSubmenu" src='/marketplace/public/img/iconos/reader-outline.svg'>
                            <strong>Ofrezco: </strong><?php echo $cards['titulo']; ?><br>
                            <img class="iconoSubmenu" src='/marketplace/public/img/iconos/earth-outline.svg'>
                            <strong>Lugar: </strong><?php echo $cards['municipio']; ?><br>
                            <img class="iconoSubmenu" src='/marketplace/public/img/iconos/cash-outline.svg'>
                            <strong>Precio apróx.: </strong><?php echo $cards['precio']; ?> €
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php } ?>

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