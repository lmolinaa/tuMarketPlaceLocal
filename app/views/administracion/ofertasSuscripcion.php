<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php
    $haySession = false;
    if (session_status() == PHP_SESSION_NONE) {
          $haySession = false;
    }
    if (session_status() == PHP_SESSION_ACTIVE && !empty($_SESSION)) {
      $haySession = true;
    }
    if (isset($_GET['mensaje']) ?? '') {
      $mensaje = $_GET['mensaje']; 
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suscripciones</title>
  <link rel="stylesheet" href="/marketplace/public/css/style.css">
  <link rel="stylesheet" href="/marketplace/public/css/cardsStyle.css">
  
</head>
<body>
<h2>Nuestras Mejores Ofertas para ti</h2>
<?php if (!empty($mensaje)){ ?>
      <div id="mensaje" class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
<?php }else{ ?>
      <div id="mensaje" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Atención!!!</strong> Las suscripciones que no se cancelen, serán renovadas automáticamente por un precio y tiempo igual al de la suscripción actual.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
<?php } ?>
<div class="container">
  <!-- Card 1 Mes -->
  <div class="card">
    <div class="card-header">Suscripción 1 Mes</div>
        <div class="card-body">
            <p><img class="iconoMenu" src='/marketplace/public/img/iconos/card-outline.svg'>Precio:<strong> 15€</strong></p>
            <p><img class="iconoMenu" src='/marketplace/public/img/iconos/calendar-number-outline.svg'>Publica tus ofertas de servicios en tu zona y atrae clientes cercanos por un mes.</p>
        </div>
        <div class="card-footer">
          <?php if ($haySession){ ?>
                <a href='/marketplace/app/views/administracion/formCreateOfrece.php?suscripcion=1'>Suscribirme ahora</a>
          <?php } else { ?>
                <a href='/marketplace/app/views/user/formCreateUsers.php'>Suscribirme ahora</a>
          <?php } ?>
        </div>
    </div>

  <!-- Card 3 Meses -->
  <div class="card">
    <div class="card-header">Suscripción 3 Meses</div>
    <div class="card-body">
      <p><img class="iconoMenu" src='/marketplace/public/img/iconos/card-outline.svg'>Precio:<strong> 40€</strong></p>
      <p><img class="iconoMenu" src='/marketplace/public/img/iconos/calendar-number-outline.svg'>Publica tus ofertas de servicios en tu zona y atrae clientes cercanos por tres meses.</p>
    </div>
    <div class="card-footer">
          <?php if ($haySession){ ?>
                <a href='/marketplace/app/views/administracion/formCreateOfrece.php?suscripcion=3'>Suscribirme ahora</a>
          <?php } else { ?>
                <a href='/marketplace/app/views/user/formCreateUsers.php'>Suscribirme ahora</a>
          <?php } ?>
        </div>
  </div>

  <!-- Card 6 Meses -->
  <div class="card">
    <div class="card-header">Suscripción 6 Meses</div>
    <div class="card-body">
      <p><img class="iconoMenu" src='/marketplace/public/img/iconos/card-outline.svg'>Precio:<strong> 75€</strong></p>
      <p><img class="iconoMenu" src='/marketplace/public/img/iconos/calendar-number-outline.svg'>Publica tus ofertas de servicios en tu zona y atrae clientes cercanos por seis meses.</p>
    </div>
    <div class="card-footer">
          <?php if ($haySession){ ?>
                <a href='/marketplace/app/views/administracion/formCreateOfrece.php?suscripcion=6'>Suscribirme ahora</a>
          <?php } else { ?>
                <a href='/marketplace/app/views/user/formCreateUsers.php'>Suscribirme ahora</a>
          <?php } ?>
        </div>
  </div>

  <!-- Card 12 Meses -->
  <div class="card">
    <div class="card-header">Suscripción 12 Meses</div>
    <div class="card-body">
      <p><img class="iconoMenu" src='/marketplace/public/img/iconos/card-outline.svg'>Precio:<strong> 140€</strong></p>
      <p><img class="iconoMenu" src='/marketplace/public/img/iconos/calendar-number-outline.svg'>Publica tus ofertas de servicios en tu zona y atrae clientes cercanos por un año.</p>
    </div>
    <div class="card-footer">
          <?php if ($haySession){ ?>
                <a href='/marketplace/app/views/administracion/formCreateOfrece.php?suscripcion=12'>Suscribirme ahora</a>
          <?php } else { ?>
                <a href='/marketplace/app/views/user/formCreateUsers.php'>Suscribirme ahora</a>
          <?php } ?>
        </div>
  </div>

<br><br>
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
                <?php
                include '../user/login.php';
                ?>
            </div>
        </div>
    </div>
</div>  

  <footer>
        <p>
            <?php
                include '../../../public/plantillas/pie.php';
            ?>
        </p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
