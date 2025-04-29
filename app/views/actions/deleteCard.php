<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php

/*** El borrado de la tarjeta implica eliminar por id_card (id_usuario_ofrece) tanto los datos de la tabla "usuario_ofrece" como lo de la tabla "suscripción" ***/

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
    <link rel="stylesheet" href="/marketplace/public/css/detalleOfreceStyle.css">
</head>
<body>
<?php
$id_card = '';
if (isset($_GET['id_card'])) {
    $id_card = $_GET['id_card'];
}

echo $id_card;
?>

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