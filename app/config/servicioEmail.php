<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que todos los campos estén presentes y no estén vacíos
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['mensajeUsuario'])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $mensajeUsuario = htmlspecialchars($_POST['mensajeUsuario']);
        /*Esta variable debe ser igual a $email, se pone email fijo para que no dé error en aquellos correos ficticios
          Se deberá cambiar cuando suba a producción y los datos de los usuarios sean reales*/
          $emailNotificación = 'maluises@gmail.com';

        // Validar el formato del correo electrónico
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $to = $emailNotificación;
            $subject = "Mensaje de contacto de $name";
            $body = "Nombre: $name\nCorreo Electrónico: $email\n\nMensaje:\n$mensajeUsuario";
            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            if (mail($to, $subject, $body, $headers)) {
                echo "<div class='alert alert-success'>Mensaje enviado con éxito.</div>";
            } else {
                echo "<div class='alert alert-danger'>Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Correo electrónico no válido.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Todos los campos son obligatorios.</div>";
    }
}   
?>