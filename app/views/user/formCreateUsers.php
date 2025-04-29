<!-- Cabecera -->
<?php
    include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php
    include_once '../../../app/controllers/actionsController.php';
    require_once '../../../app/models/consultaCP.php';
    $actionController = new ActionController();
    $municipios = $actionController->consultaMunicipios();
    $id_rolSession = '';
    if (isset($_SESSION['rol']) ?? '') {
        $id_rolSession = $_SESSION['rol'];
    }
    //$fechaActual = date('d/m/Y');
    $mensajeResultadoAlta = $_GET['mensajeResultado'] ?? ''; 
    //echo "Hola " . $mensajeResultadoAlta;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario crear usuario</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
    <script src="/marketplace/public/js/controlObligatorio.js"></script>
</head>
<body>
<!-- Formulario modificar usuarios -->
<div class="container my-5 formu" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
    <h2 class="text-center mb-4">Registro de Usuario</h2>
    
    <form action="../../controllers/userController.php" method="POST" enctype="multipart/form-data" id="formCreateUsers" class="control-form">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre*:</label>
                <input type="text" id="nombre" name="nombre" class="form-control">
                <span id="nombre_error" class="error-message"></span>
           </div>
            <div class="col-md-6">
                <label for="apellido" class="form-label">Apellidos*:</label>
                <input type="text" id="apellido" name="apellido" class="form-control">
                <span id="apellido_error" class="error-message"></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email*:</label>
                <input type="email" id="email" name="email" class="form-control" onchange="comprobarEmail(this);" placeholder="ejemplo@ejemplo.com">
                <div id="emailExiste" class="text-danger"></div>
                <span id="email_error" class="error-message"></span>

                <?php if (!empty($mensajeResultadoAlta)): ?>
                <div id="mensaje" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($mensajeResultadoAlta, ENT_QUOTES, 'UTF-8') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif ?>
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Preferiblemente Móvil">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="pais" class="form-label">País:</label>
                <input type="text" id="pais" name="pais" value="España" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" id="direccion" name="direccion" class="form-control">
            </div>
        </div>
        <!-- Cargamos de bbdd los municipios -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="listMunicipios" class="form-label">Localidad*:</label>
                <select id="listMunicipios" name="listMunicipios" onchange="changeCity('listMunicipios')" class="form-select">
                <option value="">Seleccione una localidad</option>
                    <?php foreach ($municipios as $municipio): ?>
                        <option value="<?php echo htmlspecialchars($municipio['municipio']); ?>">
                            <?php echo htmlspecialchars($municipio['municipio']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span id="listMunicipios_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="resultadoCP" class="form-label">Código Postal*:</label>
                <select id="resultadoCP" name="resultadoCP" class="form-select"></select>
                <span id="resultadoCP_error" class="error-message"></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="password" class="form-label">Contraseña*:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="">
                <span id="password_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="id_rol" class="form-label">Qué necesitas*:</label>
                <select id="id_rol" name="id_rol" class="form-select">
                    <option value="" selected>Selecciona Perfil</option>
                    <option value="2">Ofrezco servicio</option>
                    <option value="3">Busco servicio</option>
                    <?php if ($id_rolSession==="administrador"): ?>
                        <option value="1">Administrador</option>
                    <?php endif; ?>
                </select>
                <span id="id_rol_error" class="error-message"></span>
                <input type="hidden" name="action" value="create">
            </div>
        </div>

    <div class="mensajeInadecuado"></div>
    <div class="text-center">
        <button class='botonDeco' type="submit">Registrar</button>
        <p id="mensajeInadecuado"></p>
    </div>
    </form>
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
                include './login.php';
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/marketplace/public/js/geolocalizacion.js"></script>

<!-- Sacamos el servicio en base a la categoría -->
<script>
    // Convertir el array PHP en una variable JavaScript
    var servicios = <?php echo json_encode($servicios); ?>;
</script>
<script src="/marketplace/public/js/categoria_servicios.js"></script>
<script src="/marketplace/public/js/controlPalabrasInadecuadas.js"></script>

</body>
</html>
