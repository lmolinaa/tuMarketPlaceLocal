<?php
$logFile = __DIR__ . '/../../logs/actionController.log';
include __DIR__ . '/../models/modeloAcciones.php';

class ActionController {
    public static function consultaCP() {
        global $logFile;
        include __DIR__ . '/../models/consultaCP.php';
        
        // Registrar log de entrada
        $logMessage = date('Y-m-d H:i:s') . " [consultaCP] - Inicio\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        // Registrar log de la operación
        $logMessage = date('Y-m-d H:i:s') . " [consultaCP] - Resultado: " . json_encode($codigosPostales) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    
        // Devolver los resultados como JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'codigosPostales' => $codigosPostales]);
        exit();
    }

    public function consultaMunicipios() {
        global $logFile;

        $modeloAcciones = new Acciones();
        $allCities = $modeloAcciones->getMunicipios();

        $logMessage = date('Y-m-d H:i:s') . " [consultaMunicipios] - Resultado: " . json_encode($allCities) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        return $allCities;  
    }

    public static function consultaCPbyCity($municipio) {
        global $logFile;
        $modeloAcciones = new Acciones();
        $cpCity = $modeloAcciones->getCpByMunicipio($municipio);

        $logMessage = date('Y-m-d H:i:s') . " [consultaCPbyCity] - Resultado: " . json_encode($cpCity) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'codigosPostales' => $cpCity]);
        exit();
    }

    public function consultaCards($servicioSeleccionado, $categoriaSeleccionada){
        global $logFile;

        $modeloAcciones = new Acciones();
        $cardsByServicio = $modeloAcciones->getCardsByServicio($servicioSeleccionado, $categoriaSeleccionada);

        $logMessage = date('Y-m-d H:i:s') . " [consultaCards] - Resultado: " . json_encode($cardsByServicio) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        return $cardsByServicio;  
    }

    public static function consultaCardByIdUsuarioOfrece(){
        global $logFile;
        $id_usuario_ofrece = $_GET['id_usuario_ofrece'] ?? null; //ID del usuario que ofrece el servicio
        $isUbicacion = $_GET['isUbicacion'] ?? null;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //die($id_usuario_ofrece . " --- " . $isUbicacion);

        $modeloAcciones = new Acciones();
        $cardByIdUsuarioOfrece = $modeloAcciones->getCardByIdUsuarioOfrece($id_usuario_ofrece);

        $_SESSION['detalleByCard'] = $cardByIdUsuarioOfrece;
        $_SESSION['isUbicacion'] = $isUbicacion;

        /*echo "<pre>";
        print_r($cardByIdUsuarioOfrece);
        echo "</pre>";
        die();*/

        $logMessage = date('Y-m-d H:i:s') . " [getCardsByIdUsuarioOfrece] - Resultado: " . json_encode($cardByIdUsuarioOfrece) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        
        //Si no hay sesión iniciada, redirigir al usuario al logout
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: /marketplace/app/views/user/logout.php?mensaje=Lo sentimos pero para acceder a los detalles del servicio, debe de estar autenticado");
            exit();
        }else{
            header("Location: /marketplace/app/views/actions/detalleServicio.php");
            exit();
        }  
    }
     
    public function consultaCardsByMunicipio($municipio){
        global $logFile;
        $logMessage = date('Y-m-d H:i:s') . " [consultaCardsByMunicipio] - Inicio con municipio: $municipio\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        $modeloAcciones = new Acciones();
        $cardsByMunicipio = $modeloAcciones->getCardsByMunicipio($municipio);

        $logMessage = date('Y-m-d H:i:s') . " [consultaCardsByMunicipio] - Resultado: " . json_encode($cardsByMunicipio) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        return $cardsByMunicipio;
    }

    public static function consultaCardsDetalle($id_usuario, $servicioSeleccionado, $categoriaSeleccionada, $isUbicacion, $id_usuario_ofrece, $id_suscripcion){
        global $logFile;
        $id_usuario_ofrece = $_GET['id_usuario_ofrece'] ?? null;
        $logMessage = date('Y-m-d H:i:s') . " [consultaCardsDetalle] - Inicio con id_usuario: $id_usuario, servicio: $servicioSeleccionado, categoría: $categoriaSeleccionada\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $modeloAcciones = new Acciones();
        $detalleByCard = $modeloAcciones->getDetalleByCard($id_usuario, $servicioSeleccionado, $categoriaSeleccionada, $id_usuario_ofrece, $id_suscripcion, $id_usuario_ofrece);
        
        $_SESSION['detalleByCard'] = $detalleByCard;
        $_SESSION['isUbicacion'] = $isUbicacion;

        $logMessage = date('Y-m-d H:i:s') . " [consultaCardsDetalle] - Resultado: " . json_encode($detalleByCard) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        if (!isset($_SESSION['id_usuario'])) {
            header("Location: /marketplace/app/views/actions/serviciosCards.php?servicio=$servicioSeleccionado&categoria=$categoriaSeleccionada&mensaje=Lo sentimos pero para acceder a los detalles del servicio, debe de estar autenticado");
            exit();
        }else{
            header("Location: /marketplace/app/views/actions/detalleServicio.php");
            exit();
        }  
    }

    public static function busarPalabrasIndex($buscarPalabras){
        global $logFile;
        $logMessage = date('Y-m-d H:i:s') . " [busarPalabrasIndex] - Inicio con palabras: $buscarPalabras\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $modeloAcciones = new Acciones();
        $buscarPalabrasByCards = $modeloAcciones->getBuscarPalabrasByCards($buscarPalabras);
        
        $_SESSION['buscarPalabrasByCards'] = $buscarPalabrasByCards;

        $logMessage = date('Y-m-d H:i:s') . " [busarPalabrasIndex] - Resultado: " . json_encode($buscarPalabrasByCards) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        header("Location: /marketplace/app/views/actions/buscarServiciosCards.php");
        exit();  
    }
    
    public static function cardsByIdUsuario($cardsByIdUsuario){
        global $logFile;
        $logMessage = date('Y-m-d H:i:s') . " [cardsByIdUsuario] - Inicio con id_usuario: $cardsByIdUsuario\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $modeloAcciones = new Acciones();
        $idCardsByIdUsuario = $modeloAcciones->getCardsByIdUsuario($cardsByIdUsuario);
        
        $_SESSION['idCardsByIdUsuario'] = $idCardsByIdUsuario;

        $logMessage = date('Y-m-d H:i:s') . " [cardsByIdUsuario] - Resultado: " . json_encode($idCardsByIdUsuario) . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        
        header("Location: /marketplace/app/views/actions/buscarServiciosCards.php");
        exit();  
    }

    public static function consultaCardsDetalleUpdate($id_card){
        global $logFile;
        $logMessage = date('Y-m-d H:i:s') . " [consultaCardsDetalleUpdate] - Inicio con id_card: $id_card\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $logMessage = date('Y-m-d H:i:s') . " [consultaCardsDetalleUpdate] - Redirigiendo a formUpdateCard.php\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        header("Location: /marketplace/app/views/administracion/formUpdateCard.php");
        exit();
    }

    public static function guardarMensaje($mensajeUsuario) {
        global $logFile;
        $logMessage = date('Y-m-d H:i:s') . " [guardarMensaje] - Inicio\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $email_receptor = $_POST['email_receptor'] ?? null; //Email del receptor
        /*Esta variable debe ser igual a $email_receptor, se pone email fijo para que no dé error en aquellos correos ficticios
          Se deberá cambiar cuando suba a producción y los datos de los usuarios sean reales*/
        $emailNotificacion = 'maluises@yahoo.es';
        
        $id_emisor = $_POST['id_emisor'];
        $id_receptor = $_POST['id_receptor'];
        $titulo = $_POST['titulo'];
        $mensaje = $_POST['mensaje'];
        $id_mensaje = $_POST['id_mensaje_seleccionado'] ?? null; //ID del mensaje seleccionado (si aplica)

        $modeloAcciones = new Acciones();
        $guardarMensaje = $modeloAcciones->guardarMensaje($id_emisor, $id_receptor, $titulo, $mensaje, $id_mensaje);

        if ($guardarMensaje){
            if (filter_var($emailNotificacion, FILTER_VALIDATE_EMAIL)) {
                $to = $emailNotificacion; //debe sustituirse por el email del receptor 
                $subject = "Ha recibido un nuevo mensaje de Tu MarketPlace Local";
                $body = $titulo . "\r\n" . $mensaje . "\r\n\r\n";
                $headers = "From: Administrador MarketPlace ES <no-reply@marketplace.com>\r\n";
                $headers .= "X-Mailer: PHP/" . phpversion();
            }
            $logMessage = date('Y-m-d H:i:s') . " [guardarMensaje] - Mensaje guardado correctamente. Usuario del mensaje: $email_receptor \n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);

            //Controlamos de dónde viene la llamada si es contactar o contestar para redirigir a la página correspondiente y enviamos email
            if ($mensajeUsuario === 'contacUser') {
                if (mail($to, $subject, $body, $headers)) {
                    // Registrar log de verificación de usuario
                    $logMessage = date('Y-m-d H:i:s') . " actionController -> email enviado con exito a: " . $email_receptor . "\n";
                    file_put_contents($logFile, $logMessage, FILE_APPEND);
                } else {
                    //Registrar log de error
                    $logMessage = date('Y-m-d H:i:s') . " actionController -> error al enviar email a: " . $email_receptor . "\n";
                    file_put_contents($logFile, $logMessage, FILE_APPEND);
                }
                header("Location: /marketplace/app/views/actions/detalleServicio.php?mensaje=Mensaje enviado correctamente al usuario $email_receptor.");
                exit();
            } else if ($mensajeUsuario === 'responUser') {
                if (mail($to, $subject, $body, $headers)) {
                    // Registrar log de verificación de usuario
                    $logMessage = date('Y-m-d H:i:s') . " actionController -> email enviado con exito a: " . $email_receptor . "\n";
                    file_put_contents($logFile, $logMessage, FILE_APPEND);
                } else {
                    //Registrar log de error
                    $logMessage = date('Y-m-d H:i:s') . " actionController -> error al enviar email a: " . $email_receptor . "\n";
                    file_put_contents($logFile, $logMessage, FILE_APPEND);
                }
                header("Location: /marketplace/app/controllers/userController.php?action=leerMensajes&id_usuario=$id_emisor");
                exit();
            }
            
        } else {
            $logMessage = date('Y-m-d H:i:s') . " [guardarMensaje] - Error al guardar el mensaje\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            if ($mensajeUsuario === 'contacUser') {
                header("Location: /marketplace/app/views/actions/detalleServicio.php?mensaje=Error al enviar el mensaje. Inténtelo de nuevo, por favor.");
                exit();
            } else if ($mensajeUsuario === 'responUser') {
                header("Location: /marketplace/app/controllers/userController.php?action=leerMensajes&id_usuario=$id_emisor?mensaje=Error al enviar el mensaje al usuario $email_receptor. Inténtelo de nuevo, por favor.");
                exit();
            }
        }
    }
}

//Manejo de solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['codigoPostal'])) {
        $codigoPostal = $_POST['codigoPostal'];
        ActionController::consultaCP();
    } else if (isset($_POST['city'])) {
        $selectedCity = $_POST['city'];
        ActionController::consultaCPbyCity($selectedCity);
    } else if (isset($_POST['action']) && ($_POST['action'] === 'contacUser') || ($_POST['action'] === 'responUser')) {
        //La variable $mensajeUsuario se utiliza para determinar si el mensaje es de contacto o respuesta
        $mensajeUsuario = $_POST['action'];
        ActionController::guardarMensaje($mensajeUsuario);
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
        exit();
    }
    
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['city'])) {
        $selectedCity = $_GET['city'];
        ActionController::consultaCPbyCity($selectedCity);
    } else if (isset($_GET['id_usuario']) && isset($_GET['servicio'])) {
        $id_usuario = $_GET['id_usuario'];
        $servicioSeleccionado = $_GET['servicio'];
        $categoriaSeleccionada = $_GET['categoria'];
        $isUbicacion = $_GET['isUbicacion'];
        $id_usuario_ofrece = '';
       
        if (!empty($_GET['id_usuario_ofrece'])){
            $id_usuario_ofrece = $_GET['id_usuario_ofrece'];
        }else{
            $id_usuario_ofrece = 'isNull';
        }

        $id_suscripcion = '';
        if (!empty($_GET['id_suscripcion'])){
            $id_suscripcion = $_GET['id_suscripcion'];
        }else{
            $id_suscripcion = 'isNull';
        }
        ActionController::consultaCardsDetalle($id_usuario, $servicioSeleccionado, $categoriaSeleccionada, $isUbicacion, $id_usuario_ofrece, $id_suscripcion);
    } else if (isset($_GET['buscarPalabras'])) {
        $buscarPalabras = $_GET['buscarPalabras'];
        ActionController::busarPalabrasIndex($buscarPalabras);
    }else if (isset($_GET['cardsByIdUsuario'])) {
        $cardsByIdUsuario = $_GET['cardsByIdUsuario'];
        ActionController::cardsByIdUsuario($cardsByIdUsuario);
    }else if (isset($_GET['id_card_update'])) {
        $id_card = $_GET['id_card_update'];
        ActionController::consultaCardsDetalleUpdate($id_card);
    } else if (isset($_GET['action']) && ($_GET['action'] === 'cardsByIdUsuarioOfrece')) {
        ActionController::consultaCardByIdUsuarioOfrece();
    }

}
?>