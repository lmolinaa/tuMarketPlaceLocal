<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php
    $mensaje = $_GET['mensaje'] ?? ''; //Recogemos el mensaje en caso de error en la modificación
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/marketplace/public/js/validacionFormularios.js"></script>
    
</head>
<body>

<h2 class="text-center">Cambio de Contraseña</h2>

<form action="/marketplace/app/controllers/userController.php" method="POST" enctype="multipart/form-data" id="formCambiarPassword" class="control-form">
   
    <div class="container my-5 formu">
        <br>
        <div class="row justify-content-center mb-3">
            <div class="col-md-5">
                <label for="email" class="form-label">Email*:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Tu email" value='<?= $_SESSION['email']?? "" ?>'>
                <div id="requeridoEmail" class="text-danger"></div>
            </div>
            <div class="col-md-5">            
            </div>
        </div>
        
        <div class="row justify-content-center mb-3">
            <div class="col-md-5">
                <label for="password" class="form-label">Contraseña*:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Nueva contraseña">
                <div id="requeridoPassword1" class="text-danger"></div>
            </div>
            <div class="col-md-5">
                <label for="password2" class="form-label">Repite Contraseña*:</label>
                <input type="password" id="password2" name="password2" class="form-control" placeholder="Repite la nueva contraseña">
                <div id="requeridoPassword2" class="text-danger"></div>
                <div id="passNoIgual" class="text-danger"></div>
            </div>
            <input type="hidden" name="action" id="action" value="cambioPass">
        </div>
        <br>
        <div class="text-center">
        <button type="button" class="botonDeco" onclick="validarCambioPass()">Cambiar Contraseña</button>
        </div>
        <?php if (!empty($mensaje)): ?>
            <div id="passNoIgual" class="text-danger"><?= $mensaje ?></div>
        <?php endif ?>
        <br>
        <p class='psmallText'>&#8505; Si estás autenticado, al cambiar la contraseña se cerrará la sesión. Al cambiar la contraseña se debe de volver a entrar con la nueva creada.</p>
    </div>
</form>

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
                include './login.php'; // Incluir el archivo login.php
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
     <!-- Bootstrap JS -->
     <script src="/marketplace/public/js/bootstrap.bundle.min.js"></script>
    </body>
</html>