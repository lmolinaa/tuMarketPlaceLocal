<!-- Cabecera -->
<?php
    include __DIR__ . '/../../../public/plantillas/cabecera.php';
    include_once __DIR__ . '/../../../app/config/session.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurar usuario</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
</head>
<body>

<?php

//include __DIR__ . '/../../../app/controllers/userController.php';

$id_rolSession = '';
if (isset($_SESSION['rol']) ?? '') {
    $id_rolSession = $_SESSION['rol'];
}

$nombre = '';
$apellido = '';
$id_rol = '';
$nombre_rol = '';
$email = '';
$telefono = '';
$municipio = '';
$codigo_postal = '';
$pais = '';
$direccion = '';
$password = '';
$id_usuario = "";
$id_usuario_sesion = "";


if (isset($_GET['mensaje']) ?? '') {
    $mensaje = $_GET['mensaje']; 
}
if (isset($_SESSION['id_usuario']) ?? '') {
    $id_usuario_sesion = $_SESSION['id_usuario']; 
}

// Verificamos que los datos de los arrays enviados desde el controlador existan en la sesión
$allDataUser = $_SESSION['allDataUser'] ?? null;
$allMunicipios = $_SESSION['allMunicipios'] ?? null;
$id_usuario_modif = $allDataUser[0]['id_usuario'];

        /*echo "<pre>";
        print_r($_SESSION['allDataUser']);
        echo "</pre>";*/
        //die($allDataUser[0]['id_usuario']);

//unset($_SESSION['allDataUser'], $_SESSION['allMunicipios']);

    foreach ($allDataUser as $datosUsuario){
        $nombre=htmlspecialchars($datosUsuario['nombre']);
        $apellido=htmlspecialchars($datosUsuario['apellido']);
        $id_rol=htmlspecialchars($datosUsuario['id_rol']);
        $nombre_rol=htmlspecialchars($datosUsuario['nombre_rol']);
        $email=htmlspecialchars($datosUsuario['email']);
        $telefono=htmlspecialchars($datosUsuario['telefono']);
        $municipio=htmlspecialchars($datosUsuario['municipio']);
        $codigo_postal=htmlspecialchars($datosUsuario['codigo_postal']);
        $pais=htmlspecialchars($datosUsuario['pais']);
        $direccion=htmlspecialchars($datosUsuario['direccion']);
        $password=htmlspecialchars($datosUsuario['password']);
    }
//}

//Verificamos si el usuario que llega desde el controlador es el mismo que el que está en sesión
if ($id_usuario_modif === $id_usuario_sesion) { ?>
<!-- Formulario modificar usuarios -->
<div class="container my-5 formu" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
    <h2 class="text-center mb-4">Modificar Datos de Usuario</h2>
    <br>
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $mensaje ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <br>
    <?php endif; ?>
    
    <form action="../../controllers/userController.php" id="consultaUser" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre*:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $nombre ?>" class="form-control">
                <span id="nombre_error" class="error-message"></span>
           </div>
            <div class="col-md-6">
                <label for="apellido" class="form-label">Apellidos*:</label>
                <input type="text" id="apellido" name="apellido" value="<?= $apellido ?>" class="form-control">
                <span id="apellido_error" class="error-message"></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email*:</label>
                <input type="email" id="email" name="email" value="<?= $email ?>" class="form-control">
                <span id="email_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?= $telefono ?>" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="pais" class="form-label">País:</label>
                <input type="text" id="pais" name="pais" value="<?= $pais ?>" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?= $direccion ?>" class="form-control">
            </div>
        </div>

           <!-- Cargamos de bbdd los municipios -->
           <div class="row mb-3">
            <div class="col-md-6">
                <label for="localidad" class="form-label">Localidad*:</label>
                <select id="localidad" name="localidad" onchange="changeCity('localidad')" class="form-select">
                <option value="<?= $municipio ?>"><?= $municipio ?></option>
                    <?php foreach ($allMunicipios as $municipio1): ?>
                        <option value="<?php echo htmlspecialchars($municipio1['municipio']); ?>">
                            <?php echo htmlspecialchars($municipio1['municipio']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span id="listMunicipios_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="resultadoCP" class="form-label">Código Postal*:</label>
                <select id="resultadoCP" name="resultadoCP" class="form-select">
                    <option value="<?= $codigo_postal ?>"><?= $codigo_postal ?></option>
                </select>
                <span id="resultadoCP_error" class="error-message"></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 input-pass">
                <label for="password" class="form-label">Contraseña*:</label>
                <input type="password" id="password" name="password" value="<?= $password ?>" class="form-control" readonly>
                <a href="../user/passOlvidada.php">
                <img class="iconoMenu" src='/marketplace/public/img/iconos/information-circle-outline.svg' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Para modificar la contraseña debe hacerlos desde la opción de Cambio de contraseña. Si lo desea haga clic en el icono &#8505;'>
                </a>
                <span id="password_error" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="id_rol" class="form-label">Qué necesitas*:</label>
                <input type="text" id="nombre_rol" name="nombre_rol" value="<?= $nombre_rol ?>" class="form-control" readonly>
                <span id="id_rol_error" class="error-message"></span>
                <input type="hidden" id='action' name="action" value="update">
                <input type="hidden" id='id_usuario' name="id_usuario" value="<?= $id_usuario_modif ?>">
                <input type="hidden" id='id_rol' name="id_rol" value="<?= $id_rol ?>">
            </div>
        </div>
        <div class="text-center">
            <button class='botonDeco' type="submit">Actualizar</button>
        </div>
    </form>
</div>
<br><br>

<?php } else { ?>
    <br>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
            No tienes permisos para acceder a esta página.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <br>
<?php }
    unset($_SESSION['allDataUser'], $_SESSION['allMunicipios']);
 ?>

<br>
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

<!-- Pie de página -->
   <footer>
        <p>
            <?php
                include '../../../public/plantillas/pie.php';
            ?>
        </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="/marketplace/public/js/geolocalizacion.js"></script>
    <script src="/marketplace/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>