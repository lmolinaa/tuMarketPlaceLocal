<?php
//usuario pruebas paypal: marketplacelma@customerlma.com - lmacustomer

     //Cabecera, controlador y modelo
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php
    include_once '../../../app/controllers/actionsController.php';
    require_once '../../../app/models/consultaCP.php';

    $actionController = new ActionController();
    $municipios = $actionController->consultaMunicipios();
    $id_rolSession = '';
    $suscripcion = '';
    $precio = '';
    
    if (isset($_GET['mensaje']) ?? '') {
        $mensaje = $_GET['mensaje']; 
    }
    if (isset($_SESSION['rol']) ?? '') {
        $id_rolSession = $_SESSION['rol'];
    }      
    if (isset($_GET['suscripcion'])) {
        $suscripcion = $_GET['suscripcion'];
        if ($suscripcion==='1'){
            $precio = '15';
        } else if ($suscripcion==='3'){
        $precio = '40';
        } else if ($suscripcion==='6'){
            $precio = '75';
        } else if ($suscripcion==='12'){
            $precio = '140';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Suscripción</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
    <script src="/marketplace/public/js/controlObligatorioSuscripcion.js"></script>
</head>
<body>

<div class="container my-5 formu" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
    <h2 class="text-center mb-4">Datos para Suscripción</h2>
    <?php if (!empty($mensaje)): ?><br>
    <div id="mensaje" class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div><br>
<?php endif ?>
    <form onsubmit="return validateForbiddenWords(this);" class="control-form" action="../../controllers/userController.php" id="formSuscripcion" method="POST" enctype="multipart/form-data">
    <div id="serviceForm" class="row mb-3">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="categoria" class="form-label">Categoría*:</label>
                <select id="categoria" name="categoria" class="form-select">
                    <option value="">Selecciona una categoría</option>
                    <?php
                        //Iterar sobre las categorías
                        foreach ($servicios as $categoria => $listaServicios) {
                            if (is_string($categoria)) { 
                                echo "<option value='$categoria'>$categoria</option>";
                            }
                        }
                    ?>    
                </select>
                <span id="categoria_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="servicio" class="form-label">Tipo servicio*:</label>
                <select id="servicio" name="servicio" class="form-select">
                    <option value="">Selecciona un servicio</option>
                </select>
                <span id="servicio_error" class="error-message"></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="titulo" class="form-label">Título del Servicio*:</label>
                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="EJ: Motaje de muebles">
                <span id="titulo_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha desde la que se podrá prestar el servicio*:</label>
                <input type="date" id="fecha" name="fecha" class="form-control">
                <span id="fecha_error" class="error-message"></span>
            </div>
        </div>

        <div class="col-md-12">
            <label for="detalle" class="form-label">Detalle del servicio*:</label>
            <textarea id="detalle" name="detalle" class="form-control" rows="4" maxlength="300" placeholder="Sea lo más preciso posible, pero no se exceda de 300 caracteres."></textarea>
            <span id="detalle_error" class="error-message"></span>
            <div id="detalle_counter" class="char-counter">0/300</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="imagen" class="form-label">Imagen representativa*:</label>
                <input type="file" id="imagen" name="imagen" class="form-control" accept=".jpg, .jpeg, .png">
                <span id="imagen_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="precio" class="form-label">Precio aproximado (si se sabe):</label>
                <input type="text" id="precio" name="precio" class="form-control" placeholder="En € o €/h">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="empresa" class="form-label">Empresa:</label>
                <input type="text" id="empresa" name="empresa" class="form-control">
            </div>
            <div class="col-md-6">
            <label for="serviceMunicipio" class="form-label">Municipio donde se prestará el servicio*:</label>
            <select id="serviceMunicipio" name="serviceMunicipio" class="form-select">
                <option value="">Selecciona una localidad</option>
                <?php foreach ($municipios as $municipio): ?>
                    <option value="<?php echo htmlspecialchars($municipio['municipio']); ?>">
                        <?php echo htmlspecialchars($municipio['municipio']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span id="serviceMunicipio_error" class="error-message"></span>
            </div>
        </div>
    </div>
    <h2 class="text-center mb-4">Datos de Pago <?= $suscripcion ?> meses</h2>
    <div class="row mb-3">
            <div class="col-md-6">
                <label for="iban" class="form-label">IBAN:</label>
                <input type="text" id="iban" name="iban" class="form-control" maxlength="24" placeholder="Nº IBAN - Evite introducir espacios" oninput="pagoInformado()">
                <span id="iban_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="tarjeta" class="form-label">Número de tarjeta:</label>
                <input type="text" id="tarjeta" name="tarjeta" class="form-control" maxlength="19" pattern="\d{13,19}" placeholder="Nº Tarjeta - Evite introducir espacios" oninput="pagoInformado()">
                <span id="tarjeta_error" class="error-message"></span>
            </div>
        </div>
  
    <div class="mensajeInadecuado"></div>
    <div class="text-center">
        <input type="hidden" name="action" id="action" value="crearCards">
        <input type="hidden" name="suscripcion" id="suscripcion" value="<?= $suscripcion ?>">   
        <button class='botonDeco' id="registrarButton" type="submit" disabled>Registrar</button>
        <button class='botonDeco' type="button" onclick="pagoPaypal()">PayPal</button>
    </div>
    </form>
<br>
</div>

<!-- Pago con PayPal simulado -->
<form id="paypalForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="display: none;">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="marketplacelma@businesslma.com">
    <input type="hidden" name="item_name" value="<?= $suscripcion ?>">
    <input type="hidden" name="amount" value="<?= $precio ?>">
    <input type="hidden" name="currency_code" value="EUR">

    <!-- Aquí hay que poner la url cuando esté online la app, de momento localhost para recibir la respuesta de ok o ko -->
    <input type="hidden" name="return" value="http://http://localhost:8080/marketplace/app/views/administracion/formCreateOfrece.php?pago=ok">
    <input type="hidden" name="cancel_return" value="http://http://localhost:8080/marketplace/app/views/administracion/formCreateOfrece.php?pago=ko">
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
                include './login.php';
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Pie de página -->
<p>
    <?php
        include '../../../public/plantillas/pie.php';
    ?>
</p>

<!-- Bootstrap JS -->
<script src="/marketplace/public/js/bootstrap.bundle.min.js"></script>


<!-- Sacamos el servicio en base a la categoría -->
<script>
    // Convertir el array PHP en una variable JavaScript
    var servicios = <?php echo json_encode($servicios); ?>;
</script>
<script src="/marketplace/public/js/categoria_servicios.js"></script>
<script src="/marketplace/public/js/controlPalabrasInadecuadas.js"></script>


</body>
</html>