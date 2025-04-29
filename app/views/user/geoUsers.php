<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicación</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>
<body>

<?php
// Verifica tiempo de inactividad
verifySession();
require_once '../../models/consultaCP.php'; //Este sistema no me gusta, ataca directamente al modelo (buscar cambio)
require_once '../../controllers/actionsController.php';
$actionController = new ActionController();
$municipios = $actionController->consultaMunicipios();
?>

<div class="container-fluid">
        <div class="row">
            <!-- Mapa -->
            <div class="col-md-6">
                <div id="map"></div>
            </div>

            <!-- Información del usuario -->
            <div class="col-md-6">
                <div class="info">
                <img class="iconoSubmenu" src='/marketplace/public/img/iconos/earth-outline.svg'>
                    <strong>Ubicación del Usuario Detectada:</strong>
                    <div id="postalCode">
                        <strong>Código Postal:</strong> <span>No disponible</span>
                    </div>
                    <div id="city">
                        <strong>Ciudad:</strong> <span>No disponible</span>
                    </div>
                    <div id="location">
                        <strong>Google Maps:</strong> <span id="coords">Desconocida</span>
                    </div>
                </div>

                <!-- Municipios y Códigos Postales -->
                <div class="localidades mt-3">
                    <strong>Selecciona un Código Postal dónde quieras buscar:</strong>
                    <img width="24px" height="24" src="/marketplace/public/img/iconos/help-circle-outline.svg" 
                        data-bs-toggle="tooltipAll" data-bs-placement="top" 
                        title="Si seleccionas otro código postal, distinto del del mapa, te llevaremos a 'BuscarOfrecer Servicios' cercanos al elegido.">
                    <div class="mt-2">
                        <label for="municipio" class="form-label">Localidad:</label>
                        <select id="municipios" name="municipios" onchange="changeCity('municipios')" class="form-select">
                            <option id='localidad'></option>
                            <?php foreach ($municipios as $municipio) { ?>
                                <option value="<?php echo htmlspecialchars($municipio['municipio']); ?>">
                                    <?php echo htmlspecialchars($municipio['municipio']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="codigo_postal" class="form-label">Código Postal:</label>
                        <select id="resultadoCP" name="resultadoCP" class="form-select"></select>
                    </div>
                    <div class="mt-3 centro">
                        <div class="centrarB">
                        <button class='botonDecoMin' id="ir" onclick="javascript:getSelectedValue()">
                            Ir
                        </button>
                        </div>
                    </div>
                    <div class="mensajeAlerta"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="/marketplace/public/js/geolocalizacion.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>