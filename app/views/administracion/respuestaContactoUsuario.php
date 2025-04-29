<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder al usuario</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
</head>
<body>
   
   <div class="login">
    <br>
   <h2>Enviar Respuesta</h2>
    <div id="error-message" class="alert alert-danger d-none"></div>    
    <form id="contactarForm" class="control-form" action="/marketplace/app/controllers/actionsController.php" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" readonly>
        </div>
        <div class="row mb-3">
            <label for="mensaje" class="form-label">Mensaje*</label>
            <textarea id="mensaje" name="mensaje" class="form-control" rows="4" maxlength="300" placeholder="Sea lo más preciso posible, pero no se exceda de 300 caracteres." required style="max-width: 96%;"></textarea>
        </div>
        <div class="text-center">
  
        <!-- enviamos al controlador los datos de emisor y del receptor, así como el mensaje y título del formulario -->
        <input type="hidden" name="action" id="action" value="responUser">
        <input type="hidden" id="id_mensaje_seleccionado" name="id_mensaje_seleccionado">
        <input type="hidden" name="id_emisor" id="id_emisor">
        <input type="hidden" name="id_receptor" id="id_receptor">
        <div class="mensajeInadecuado"></div>
            <div class="text-center">
                <button type="submit" class='botonDeco'>Enviar</button>
                <p id="mensajeInadecuado"></p>
            </div>
        </div>
    </form>
    </div>
    <script src="/marketplace/public/js/controlPalabrasGenerico.js"></script>
</body>
</html>
