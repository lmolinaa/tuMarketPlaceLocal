<!-- Cabecera -->
<?php
include '../../../public/plantillas/cabecera.php'; // Incluir el archivo cabecera.php

//Esta página solo se muestra a los usuarios con permisos para ver mensajes (en principio todos los que estén autenticados)
if (!checkAccess('view_messages')) {

    header("Location: /marketplace/app/views/user/logout.php?mensaje=No tienes permiso para acceder a esta página.");
    exit();
}

$id_usuario = $_SESSION['id_usuario'] ?? null; //Obtener el ID del usuario de la sesión
// Verificar si hay mensajes en la sesión
if (isset($_SESSION['mensajesUsuario'])) {
    $mensajes = $_SESSION['mensajesUsuario'];
    //Limpiamos los mensajes de la sesión después de recuperarlos
    unset($_SESSION['mensajesUsuario']);
} else {
    $mensajes = [];
}

$mensaje = $_GET['mensaje'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <link rel="stylesheet" href="/marketplace/public/css/style.css">

</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">Listado de Mensajes Recibidos</h2>
        <br>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $mensaje ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <br>
        <div class='table-container'>
            <table class="tableUsers table-bordered table-hover">
                <thead class="cabecera">
                    <tr>
                        <th>De</th>
                        <th>Email</th>
                        <th>Título</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Visto</th>
                        <th>Responder</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mensajes as $mensaje) {
                        $date = new DateTime($mensaje['fecha_envio']);
                        $fechaFormateada = $date->format('d-m-Y H:i:s');
                        $mensajeLeido = $mensaje['leido'];
                        $id_mensaje = $mensaje['id_mensaje'];
                        $rowClass = $mensajeLeido === '0' ? 'bg-white' : '';
                    ?>
                        <tr class="<?php echo $rowClass; ?>">
                            <td><?php echo htmlspecialchars($mensaje['nombre']); ?> <?php echo htmlspecialchars($mensaje['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($mensaje['email']); ?></td>
                            <td><?php echo htmlspecialchars($mensaje['titulo']); ?></td>
                            <td class="message-cell"><?php echo htmlspecialchars($mensaje['mensaje']); ?></td>
                            <td><?php echo htmlspecialchars($fechaFormateada); ?></td>
                            <td class="centrarTd">
                                <?php
                                echo "<a href='/marketplace/app/controllers/userController.php?action=modifMensajes&id_mensaje=$id_mensaje&id_usuario=$id_usuario&mensajeLeido=$mensajeLeido'>";
                                //Si es 0 el mensaje no ha sido leído, mostramos un icono de "no leído"
                                if ($mensajeLeido === '0') {
                                    echo "<img class='iconoMenu' src='/marketplace/public/img/iconos/checkmark-circle-outline.svg' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Mensaje no leído.'>";

                                    //Sino será 1 y mostramos un icono de ya "leído"
                                } else {
                                    echo "<img class='iconoMenu' src='/marketplace/public/img/iconos/checkmark-done-circle-outline.svg' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Mensaje leído.'>";
                                }
                                echo "</a>";
                                ?>
                            </td>
                            <td class="centrarTd"><a href='#' onclick='javascript:recogerIdMensaje(<?= $id_mensaje ?>)' data-bs-toggle='modal' data-bs-target='#contactoModal'><img class='iconoMenu' src='/marketplace/public/img/iconos/paper-plane-outline.svg' data-bs-toggle='tooltipAll' data-bs-placement='top' title='Contestar al mensaje del usuario.'></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <!-- Modal envío mensaje al usuario que ofrece servicio -->
    <div class="modal fade" id="contactoModal" tabindex="-1" aria-labelledby="contactoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactoModalLabel">Responder al Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <?php include '../administracion/respuestaContactoUsuario.php'; ?>
                </div>
            </div>
        </div>
    </div>
   
    <footer>
        <p>
            <?php
            include '../../../public/plantillas/pie.php';
            ?>
        </p>
    </footer>

 <!-- jQuery (para AJAX) necesitamos consultar asíncronamente para que no se cierre la modal-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function recogerIdMensaje(id_mensaje) {
        //Guardar el ID en un campo oculto del formulario dentro del modal
        document.getElementById('id_mensaje_seleccionado').value = id_mensaje;

        //Hacemos la llamada AJAX para obtener los detalles del mensaje
        $.ajax({
            url: '/marketplace/app/controllers/userController.php',
            method: 'POST',
            data: {
                action: 'mensajePorId',
                id_mensaje: id_mensaje
            },
            success: function(response) { 
                var mensajeSeleccionado = JSON.parse(response); //Convertimos la respuesta en JSON
                document.getElementById('titulo').value = 'Re: ' + mensajeSeleccionado.titulo; //Usar el campo 'titulo'
                document.getElementById('id_mensaje_seleccionado').value = id_mensaje;
                //Invertimos los campos de receptor y emisor para que el que envía el mensaje sea el que lo recibe y viceversa 
                document.getElementById('id_receptor').value = mensajeSeleccionado.id_emisor; 
                document.getElementById('id_emisor').value = mensajeSeleccionado.id_receptor; 
                console.log(mensajeSeleccionado); //Mostrar el objeto completo en la consola para depuración
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los detalles del mensaje:', error);
            }
        });
    }
</script>

    <script src="/marketplace/public/js/tablaMensajes.js"></script>
    <script src="/marketplace/public/js/bootstrap.bundle.min.js"></script>

</body>

</html>