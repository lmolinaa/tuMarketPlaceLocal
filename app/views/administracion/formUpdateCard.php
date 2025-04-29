<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php

    /*** La actualización de la tarjeta puede o no implicar la actualización por id_card (id_usuario_ofrece) tanto los datos de la tabla
    "usuario_ofrece" como lo de la tabla "suscripción" ***/
    
    //Añadimos el actionController para llamar a la función que nos traerá los municipios
    include_once '../../../app/controllers/actionsController.php';
    $actionController = new ActionController();
    $municipios = $actionController->consultaMunicipios();

    $mensaje = $_GET['mensaje'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Modificar datos Cards</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
</head>
<body>
    
<?php
/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";
die();*/

$id_suscripcion='';
$id_usuario_ofrece='';
$id_usuario='';
$categoria='';
$servicio='';
$titulo='';
$detalle='';
$imagen='';
$fecha='';
$precio='';
$municipio='';
$empresa='';
$email='';
$telefono='';
$nombre='';
$apellido='';
$id_rol='';
$tiempo_Suscripcion='';
$valor='';
$fecha_suscripcion='';

//Sacamos los datos de la session de detalleByCard que es donde guardamos los datos de la tarjeta que queremos modificar
if (isset($_SESSION['detalleByCard']) ?? '') {
    $idCardIdSuscripcionModif = $_SESSION['detalleByCard'];
    
    //Traemos todos los datos por si en un futuro se requieren para hacer una modificación más completa desde aquí
    foreach ($idCardIdSuscripcionModif as $cardSuscripcion){
        $id_suscripcion=htmlspecialchars($cardSuscripcion['id_suscripcion']);
        $id_usuario_ofrece=htmlspecialchars($cardSuscripcion['id_usuario_ofrece']);
        $id_usuario=htmlspecialchars($cardSuscripcion['id_usuario']);
        $categoria=htmlspecialchars($cardSuscripcion['categoria']);
        $servicio=htmlspecialchars($cardSuscripcion['servicio']);
        $titulo=htmlspecialchars($cardSuscripcion['titulo']);
        $detalle=htmlspecialchars($cardSuscripcion['detalle']);
        $imagen=htmlspecialchars($cardSuscripcion['imagen']);
        //Extraemos el nombre de la imagen ya que es lo único que le interesa conocer al usuario
        $nombre_imagen = basename($imagen);
        $fecha=htmlspecialchars($cardSuscripcion['fecha']);
        $precio=htmlspecialchars($cardSuscripcion['precio']);
        $municipio=htmlspecialchars($cardSuscripcion['municipio']);
        $empresa=htmlspecialchars($cardSuscripcion['empresa']);
        $email=htmlspecialchars($cardSuscripcion['email']);
        $telefono=htmlspecialchars($cardSuscripcion['telefono']);
        $nombre=htmlspecialchars($cardSuscripcion['nombre']);
        $apellido=htmlspecialchars($cardSuscripcion['apellido']);
        $id_rol=htmlspecialchars($cardSuscripcion['id_rol']);
        $tiempo_Suscripcion=htmlspecialchars($cardSuscripcion['tiempo_suscripcion']);
        $valor=htmlspecialchars($cardSuscripcion['valor']);
        $fecha_suscripcion=htmlspecialchars($cardSuscripcion['fecha_suscripcion']);
        //Formateamos la fecha de suscripción
        $fecha_formateada = date("d-m-Y", strtotime($fecha_suscripcion));
    }
}
?>

<!-- Formulario modificar cards -->
<div class="container my-5 formu" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
    <h2 class="text-center mb-4">Modificar Datos del Servicio ofertado &nbsp;&nbsp;&nbsp;<img class="iconoMenu" src='/marketplace/public/img/iconos/information-circle-outline.svg'
    data-bs-toggle='tooltipAll' data-bs-placement='top' title='En esta página solo se puede modificar lo relativo al servicio ofrecido, el resto se muestran aquí
    tan solo a modo de información. Los datos personales así como la suscrición se deben modificar desde la opción correspondiente.'> </h2>

    <br>
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $mensaje ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <br>

    <form onsubmit="return validateForbiddenWords(this);" action="../../controllers/userController.php" id="modificarCard" method="POST" enctype="multipart/form-data">
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($cardSuscripcion['nombre']) ?>" readonly class="form-control"
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='Los datos personales solo se pueden modificar desde la opción Configuración de la cuenta del menú usuario'>
                <span id="nombre_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="apellido" class="form-label">Apellidos:</label>
                <input type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($cardSuscripcion['apellido']) ?>" readonly class="form-control"
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='Los datos personales solo se pueden modificar desde la opción Configuración de la cuenta del menú usuario'>
                <span id="apellido_error" class="error-message"></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($cardSuscripcion['email']) ?>" readonly class="form-control"
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='Los datos personales solo se pueden modificar desde la opción Configuración de la cuenta del menú usuario'>
                <span id="email_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($cardSuscripcion['telefono']) ?>" readonly class="form-control"
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='Los datos personales solo se pueden modificar desde la opción Configuración de la cuenta del menú usuario'>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="categoria" class="form-label">Categoría:</label>
                <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($cardSuscripcion['categoria']) ?> " readonly class="form-control"
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='La categoría y el servicio no se pueden modificar. Para ello, elimine la tarjeta y cree una nueva'>
            </div>
            <div class="col-md-6">
                <label for="servicio" class="form-label">Servicio:</label>
                <input type="text" id="servicio" name="servicio" value="<?= htmlspecialchars($cardSuscripcion['servicio']) ?>" readonly class="form-control"
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='La categoría y el servicio no se pueden modificar. Para ello, elimine la tarjeta y cree una nueva'>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="titulo" class="form-label">Título*:</label>
                <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($cardSuscripcion['titulo']) ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="detalle" class="form-label">Detalle:</label>
                <textarea id="detalle" name="detalle" class="form-control"><?= htmlspecialchars($cardSuscripcion['detalle']) ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="precio" class="form-label">Precio del Servicio:</label>
                <input type="text" id="precio" name="precio" value="<?= htmlspecialchars($cardSuscripcion['precio']) ?>" class="form-control">
            </div>            
            <div class="col-md-6">
                <label for="imagen" class="form-label">Imagen* (<span style="font-size: smaller;">Imagen actual: <?= $nombre_imagen ?></span>):</label>
                <input type="file" id="imagen" name="imagen" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="empresa" class="form-label">Empresa:</label>
                <input type="text" id="empresa" name="empresa" value="<?= htmlspecialchars($cardSuscripcion['empresa']) ?>" class="form-control">   
            </div>
            <!-- Cargamos de bbdd los municipios -->
            <div class="col-md-6">
            <label for="serviceMunicipio" class="form-label">Municipio donde se presta el servicio*:</label>
            <select id="serviceMunicipio" name="serviceMunicipio" class="form-select">
                <option value="<?= htmlspecialchars($cardSuscripcion['municipio']) ?>"><?= htmlspecialchars($cardSuscripcion['municipio']) ?></option>
                <?php foreach ($municipios as $municipio): ?>
                    <option value="<?php echo htmlspecialchars($municipio['municipio']); ?>">
                        <?php echo htmlspecialchars($municipio['municipio']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fecha_suscripcion" class="form-label">Fecha de Suscripción:</label>
                <input type="text" id="fecha_suscripcion" name="fecha_suscripcion" value="<?= $fecha_formateada ?>" readonly class="form-control"
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='Los datos relativos a la suscripción solo se pueden modificar eliminando la actual tarjeta y/o creando nuevas suscripciones'>
            </div>
            <div class="col-md-6">
                <label for="tiempo_suscripcion" class="form-label">Tiempo de Suscripción <span style="font-size: smaller;">(En Meses)</span></label>
                <input type="text" id="tiempo_suscripcion" name="tiempo_suscripcion" value="<?= htmlspecialchars($cardSuscripcion['tiempo_suscripcion']) ?>" readonly class="form-control"
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='Los datos relativos a la suscripción solo se pueden modificar eliminando la actual tarjeta y/o creando nuevas suscripciones'>
            </div>
            <div class="col-md-6">
                <label for="valor" class="form-label">Precio Suscripción <span style="font-size: smaller;">(En €)</span></label>
                <input type="text" id="valor" name="valor" value="<?= htmlspecialchars($cardSuscripcion['valor']) ?>" class="form-control" readonly
                data-bs-toggle='tooltipAll' data-bs-placement='top' title='Los datos relativos a la suscripción solo se pueden modificar eliminando la actual tarjeta y/o creando nuevas suscripciones'>
            </div>
            <!-- Campos hidden para enviar el action y los id de la suscripción y de la card del servicio que se ofrece, al controlador -->
            <input type="hidden" name="action" id="action" value="modificarCard">
            <input type="hidden" name="id_suscripcion" id="id_suscripcion" value="<?= $cardSuscripcion['id_suscripcion'] ?>">
            <input type="hidden" name="id_usuario_ofrece" id="id_usuario_ofrece" value="<?= $cardSuscripcion['id_usuario_ofrece'] ?>">
        </div>
        <div class="text-center">
            <button class='botonDeco' id="modifButton" type="submit">Actualizar</button>
        </div>
    </form>
    <?php if (!empty($mensaje)): ?>
    <div id="mensaje" class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif ?>
<br>
</div>
<br><br>

   <!-- Pie de página -->
   <footer>
        <p>
            <?php
                include '../../../public/plantillas/pie.php';
            ?>
        </p>
    </footer>
     <!-- control palabras inapropiadas y mostrar categorías JS -->
    <script src="/marketplace/public/js/categoria_servicios.js"></script>
    <script src="/marketplace/public/js/controlPalabrasInadecuadas.js"></script>
    </body>
</html>