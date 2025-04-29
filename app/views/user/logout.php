    <!-- Cabecera -->
    <?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php
    
    $mensaje = '';
    //Llamamos a la función logoutUser para cerrar la sesión.
    logoutUser();

    if (isset($_GET['mensaje'])) {
        $mensaje = $_GET['mensaje'];
    }
    if(isset($_GET['timeout']) == 'true'){
        $mensaje = 'La sesión ha caducado, por favor, vuelva a hacer el login.';
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de categorías/servicios</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
</head>
<body>
<div class="container mt-5 text-center">
        <div class="alert alert-warning">
            <strong><?php echo $mensaje ?></strong>
        </div>
        <button class='botonDeco' id="Volver al Home" onclick="window.location.href='/marketplace';">
            Volver al Home
        </button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>