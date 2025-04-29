<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">
</head>
<body>
   
   <div class="login">
    <br>
   <h2>Inicia sesión</h2>
    <div id="error-message" class="alert alert-danger d-none"></div>    
    <form id="loginForm">
        <div class="row mb-3">
            <label for="email" class="form-label">Email*</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="ejemplo@ejemplo.com" required>
        </div>
        <div class="row mb-3">
            <label for="password" class="form-label">Contraseña*</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <p style="font-size: small;"><a href="/marketplace/app/views/user/passOlvidada.php">¿Has olvidado tu contraseña?</a></p>
        </div>
        <div class="text-center">
            
            <input type="hidden" name="action" value="checkUserExists">
            <button type="submit" class='botonDeco'>Iniciar Sesión</button>
        </div>
    </form>
    </div>

     <!-- jQuery (para AJAX) necesitamos consulta asíncrona para que no se cierre la modal en caso de error-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); //Previene el envío del formulario

                // Limpia mensajes de error anteriores
                $('#error-message').addClass('d-none').text('');

                // Enviar datos mediante AJAX
                $.ajax({
                    url: '/marketplace/app/controllers/userController.php', //Ruta al controlador
                    method: 'POST',
                    data: $(this).serialize(), //Serializa los datos del formulario
                    success: function(response) {
                        if (response.success) {
                            //Redirigir si el inicio de sesión es exitoso
                            window.location.href = response.redirect;
                        } else {
                            // Mostrar mensaje de error
                            $('#error-message').removeClass('d-none').text(response.message);
                        }
                    },
                    error: function() {
                        $('#error-message').removeClass('d-none').text('Ocurrió un error en el servidor.');
                    }
                });
            });
        });
    </script>

</body>
</html>
