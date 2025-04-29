<?php
$logFile = __DIR__ . '/../../logs/userController.log';
//Controlamos que la session esté activa
if (session_status() == PHP_SESSION_NONE) {
    include __DIR__ . '/../config/session.php';
}
include __DIR__ . '/../models/modeloUsers.php';
include __DIR__ . '/../models/modeloAcciones.php';

class UserController {
    public static function create() {
        global $logFile;
        //Datos básicos recibidos del formulario de alta
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $pais = $_POST['pais'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        $municipio = $_POST['listMunicipios'] ?? '';
        $codigo_postal = $_POST['resultadoCP'] ?? '';
        $password = $_POST['password'] ?? '';
        $id_rol = $_POST['id_rol'] ?? ''; 

        $mensajeResultado = "";

        // Validar datos obligatorios aunque se controla por javascript en el from
        if (empty($nombre) || empty($email) || empty($password)) {
            die('Nombre, email y contraseña son obligatorios.');
        }

        // Validar formato del email aunque se controla por javascript en el from
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Formato de email no válido.");
        }

        //Crear un nuevo usuario
        include '../models/createUsers.php';
             
        //Registramos log de creación de usuario
        $logMessage = date('Y-m-d H:i:s') . " userController -> create: - Usuario " . $nombre . " creado\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        //Redirigimos en función de si hay error o del tipo de rol con el que se da de alta.
        if (empty($errorMessage)){
            if ($id_rol!='2'){
                header("Location: /marketplace/app/views/actions/buscoOfrezco.php");
                exit();
            }else if ($id_rol==='2'){
                header("Location: /marketplace/app/views/administracion/ofertasSuscripcion.php?mensaje=Seleccione una de nuestras suscripciones.");
                exit();
            }
        }else{
            header("Location: /marketplace/app/views/user/formCreateUsers.php?mensajeResultado=$mensajeResultado");
            exit();
        }
    }

    public static function checkUserExists() {
        global $logFile;
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
  
        //Incluir modelo para verificar usuario
        include '../models/checkUsers.php';
        
        // Registrar log de verificación de usuario
        $logMessage = date('Y-m-d H:i:s') . " userController -> checkUserExists: Verificación de usuario " . $nombre . " Email " . $email . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        
        echo json_encode(['success' => true, 'redirect' => '/marketplace/app/views/actions/buscoOfrezco.php']);
        exit();
    }

    public static function consultaDatosUser($id_usuario, $accion){
        //nos aseguramos de que la sesión esté iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $modeloUsers = new Users();
        $modeloAcciones = new Acciones();
        
       //Consultamos por todos los datos del usuario
       $allDataUser = $modeloUsers->getDataUser($id_usuario);
       
       //consultamos por todos municipios existentes en nuestra base de datos
       $allMunicipios = $modeloAcciones->getMunicipios();

        // Guardar en sesión los arrays asociativos para después sacarlos en el formulario de la vista
        $_SESSION['allDataUser'] = $allDataUser;
        $_SESSION['allMunicipios'] = $allMunicipios;

        if ($accion === 'consultarDatosUsuario'){
            header("Location: /marketplace/app/views/administracion/configUser.php");
            exit();
        } else if ($accion === 'modificarDatosUsuario'){
            header("Location: /marketplace/app/views/administracion/configUser.php?mensaje=Actualización realizada con existo.");
            exit();
        }

    }

    public static function updateUser(){
        global $logFile;
        $accion = 'modificarDatosUsuario';
        //Datos básicos recibidos del formulario update
        $datosUsuario = [
            "nombre" => $_POST['nombre'],
            "apellido"=> $_POST['apellido'],
            "email" => $_POST['email'],
            "telefono" => $_POST['telefono'],
            "pais" => $_POST['pais'],
            "direccion" => $_POST['direccion'],
            "municipio" => $_POST['localidad'],
            "codigo_postal" => $_POST['resultadoCP'],
            "password" => $_POST['password'],
            "id_rol" => $_POST['id_rol'],
            "id_usuario" => $_POST['id_usuario']
        ];

        //Modificar usaurio
        $modeloUsers = new Users();
        $modifOK=$modeloUsers->updateDataUser($datosUsuario);
        
        // Registrar log 
        $logMessage = date('Y-m-d H:i:s') . " userController -> updateUser: - modificación de usuario " . $datosUsuario['nombre'] . " Email " . $datosUsuario['email'] . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        
        if ($modifOK===true){
            UserController::consultaDatosUser($datosUsuario['id_usuario'], $accion);
           
        }else{
            header("Location: ../views/administracion/configUser.php?mensaje=Se ha producido un error en la modificación del usuario. por favor, inténtelo más tarde");
            exit(); 
        }
    }

    public static function cambiarPassword(){
        global $logFile;
        $modeloUsers = new Users();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        /*Esta variable debe ser igual a $email, se pone email fijo para que no dé error en aquellos correos ficticios
          Se deberá cambiar cuando suba a producción y los datos de los usuarios sean reales*/
        $emailNotificacion = 'maluises@yahoo.es';

        $cambioPass = $modeloUsers->updatePassUser($email, $password);

        //Registrar log de verificación de usuario
        $logMessage = date('Y-m-d H:i:s') . " userController -> passOlvidada: Pass Nueva: " . $password . "- Email a restablecer: " . $email . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        if ($cambioPass){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $to = $emailNotificacion; 
                $subject = "Cambio de Contraseña en Marketplace";
                $body = "La contraseña para el usuario: $email ha sido modificada con éxito. \r\n";
                $headers = "From: Administrador MarketPlace ES <no-reply@marketplace.com>\r\n";
                $headers .= "X-Mailer: PHP/" . phpversion();
    
                if (mail($to, $subject, $body, $headers)) {
                    // Registrar log de verificación de usuario
                    $logMessage = date('Y-m-d H:i:s') . " userController -> email enviado con exito a: " . $email . "\n";
                    file_put_contents($logFile, $logMessage, FILE_APPEND);
                } else {
                    //Registrar log de error
                    $logMessage = date('Y-m-d H:i:s') . " userController -> error al enviar email a: " . $email . "\n";
                    file_put_contents($logFile, $logMessage, FILE_APPEND);
                }
                header("Location: /marketplace/app/views/user/logout.php?mensaje=La sesión se ha cerrado. Acceda con su nueva contraseña.");
                exit(); 
            }else{
                header("Location: ../views/user/passOlvidada.php?mensaje=Se ha producido un error en la modificación del password. Por favor, inténtelo más tarde");
                exit(); 
            }
        }
    }

    public static function crearOfreceCard(){
        global $logFile;
        $modeloUsers = new Users();

       //Para la carga de la imagen
       $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/marketplace/public/files/images/';
       $uploadFile = $uploadDir . basename($_FILES['imagen']['name']);
   
       //Verificamos si la carpeta existe, y la creamos si no
       if (!file_exists($uploadDir)) {
           mkdir($uploadDir, 0777, true);
       }

       //Movemos el archivo subido a la carpeca correcta
       if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadFile)) {
           // Guardar la ruta en la base de datos
           $relativePathImg = '/marketplace/public/files/images/' . basename($_FILES['imagen']['name']);
       }

        $datosSuscripcion = [
                'id_usuario' => $_SESSION['id_usuario'],
                'id_rol' => $_SESSION['id_rol'],
                'suscripcion' => $_POST['suscripcion'],
                'categoria' => $_POST['categoria'],
                'servicio' => $_POST['servicio'],
                'titulo' => $_POST['titulo'],
                'fecha' => $_POST['fecha'],
                'detalle' => $_POST['detalle'],
                'imagen' => $relativePathImg,
                'precio' => $_POST['precio'],
                'empresa' => $_POST['empresa'],
                'serviceMunicipio' => $_POST['serviceMunicipio'],
                'iban' => $_POST['iban'],
                'tarjeta' => $_POST['tarjeta'],
                'suscripcion' => $_POST['suscripcion'],
                'update_fecha' => date('Y-m-d H:i:s')
        ];

         $resultadoSuscripcion = $modeloUsers->createSuscripcion($datosSuscripcion);

        $logMessage = date('Y-m-d H:i:s') . " userController -> El usuario: " . $datosSuscripcion['suscripcion'] . " se ha suscrito por: " . $datosSuscripcion['suscripcion'] . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        if ($resultadoSuscripcion){
            header("Location: /marketplace/app/views/administracion/ofertasSuscripcion.php?mensaje=Se ha suscrito satisfactoriamente. Puede suscribirse a tantas ofertas como quiera para distintas ubicaciones.");
            exit(); 
        }else{
            header("Location: ../views/administracion/formCreateOfrece.php?mensaje=Se ha producido un error en la creación de la Suscripción, inténtelo más tarde");
            exit(); 
        }
    }

    public static function modificarOfreceCard(){
        global $logFile;
        $modeloUsers = new Users();

       //Para la carga de la imagen modificada
       $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/marketplace/public/files/images/';
       $uploadFile = $uploadDir . basename($_FILES['imagen']['name']);
   
       //Verificamos si la carpeta existe, y la creamos si no es así
       if (!file_exists($uploadDir)) {
           mkdir($uploadDir, 0777, true);
       }

       //Movemos el archivo subido a la carpeca correcta
       if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadFile)) {
           // Guardar la ruta en la base de datos con el nuevo nombre de la imagen
           $relativePathImg = '/marketplace/public/files/images/' . basename($_FILES['imagen']['name']);
       }

        $datosActualizadosSuscripcion = [
                'id_usuario' => $_SESSION['id_usuario'],
                'id_suscripcion' => $_POST['id_suscripcion'],
                'id_usuario_ofrece' => $_POST['id_usuario_ofrece'],
                'titulo' => $_POST['titulo'],
                'detalle' => $_POST['detalle'],
                'imagen' => $relativePathImg,
                'precio' => $_POST['precio'],
                'empresa' => $_POST['empresa'],
                'municipio' => $_POST['serviceMunicipio']
        ];

        $resultadoModificarOfreceCard = $modeloUsers->updateUsuarioOfrece($datosActualizadosSuscripcion);

        if ($resultadoModificarOfreceCard){
            header("Location: /marketplace/app/views/actions/detalleServicio.php?mensaje=Se ha realizado la modificación satisfactoriamente.");
            exit(); 
        }else{
            $logMessage = date('Y-m-d H:i:s') . " userController -> Error en la modificación de usuarioOfrece \n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            header("Location: ../views/administracion/formUpdateCard.php?mensaje=Se ha producido un error en la modificación de los datos, inténtelo más tarde");
            exit(); 
        }
    }

    public static function eliminarOfreceCard(){
        global $logFile;
        $modeloUsers = new Users();

        $id_usuario_ofrece = $_GET['id_card_delete'] ?? '';
        $id_usuario = $_GET['id_usuario'] ?? '';

        $resultadoEliminarOfreceCard = $modeloUsers->deleteUsuarioOfrece($id_usuario_ofrece);

        if ($resultadoEliminarOfreceCard){
            header("Location: /marketplace/app/controllers/actionsController.php?cardsByIdUsuario=$id_usuario");
            exit(); 
        }else{
            $logMessage = date('Y-m-d H:i:s') . " userController -> Error en la eliminación de usuarioOfrece \n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            header("Location: ../views/actions/detalleServicio.php?mensaje=Se ha producido un error en la eliminación de los datos, inténtelo más tarde");
            exit(); 
        }
    }

    public static function leerMensajesUsuario(){
        $modeloUsers = new Users();

        $id_usuario = $_GET['id_usuario'] ?? '';

        //Consultar mensajes del usuario
        $modeloUsers->getMensajesUsuario($id_usuario);
    }

    public static function mostrarMensajesUsuario($flagMensajes){
        global $logFile;
        
        //si viene a false lo redirigimos mostrando mensaje de error, en cualquier otro caso se va a la vista de mensajes
        if (!$flagMensajes){
            $logMessage = date('Y-m-d H:i:s') . " userController -> Error en la carga de mensajes \n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            header("Location: ../views/actions/buscoOfrezco.php?mensaje=Usted no dispone de mensajes en su bandeja de entrada.");
            exit();  
        } else {
            header("Location: /marketplace/app/views/administracion/viewMessagesUser.php");
            exit();
        }     
    }

    public static function leerMensajeById(){
        $modeloUsers = new Users();

        $id_mensaje = $_POST['id_mensaje'] ?? '';

        //Consultar mensaje por el id
        $mensajeSeleccionado = $modeloUsers->getMensajeById($id_mensaje);
        echo json_encode($mensajeSeleccionado);
    }

    public static function modifMensajesUsuario(){
        global $logFile;
        $modeloUsers = new Users();

        $id_mensaje = $_GET['id_mensaje'] ?? '';
        $id_usuario = $_GET['id_usuario'] ?? '';
        $mensajeLeido = $_GET['mensajeLeido'] ?? '';

        //Modificar estado del mensaje del usuario
        $allMessage = $modeloUsers->modifMensajesUsuario($id_mensaje, $id_usuario, $mensajeLeido);
        
        if ($allMessage){
            //Metemos en la sesión los mensajes del usuario para luego mostrárselos en la vista
            $_SESSION['mensajesUsuario'] = $allMessage;
            header("Location: /marketplace/app/views/administracion/viewMessagesUser.php");
            exit(); 
        }else{
            $logMessage = date('Y-m-d H:i:s') . " userController -> Error en la carga de mensajes \n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            header("Location: /marketplace/app/views/administracion/viewMessagesUser.php?mensaje=Se ha producido un error, por favor inténtelo de nuevo más tarde.");
            exit(); 
        }
    }
}

//Manejo de solicitudes dependerá de lo que llegue en el action se hara una cosa u otra ya venga por el post como por el get
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_POST['action'] ?? $_GET['action'] ?? null;

    switch ($action) {
        //crear usuario
        case 'create':
            UserController::create();
            break;
        //verificar si existe el usuario
        case 'checkUserExists':
            UserController::checkUserExists();
            break;
            //Modificar usuario
        case 'update':
            UserController::updateUser();
            break;
            //cambiar password
        case 'cambioPass':
            UserController::cambiarPassword();
            break;
            //crear tarjeta de oferta
        case 'crearCards':
            UserController::crearOfreceCard();
            break;
            //modificar tarjeta de oferta
        case 'modificarCard':
            UserController::modificarOfreceCard();
            break;
            //eliminar tarjeta de oferta
        case 'eliminarCard':
            UserController::eliminarOfreceCard();
            break;
            //leer todos los mensajes del usuario
        case 'leerMensajes':
            UserController::leerMensajesUsuario();
            break;
            //mostrar estado del mensaje del usuario (leído/no leído)
        case 'modifMensajes':
            UserController::modifMensajesUsuario();
            break;
            //busacar mensaje por id para poder responderlo
        case 'mensajePorId':
            UserController::leerMensajeById();
            break;
        case 'modificarPerfil':
            $id_usuario = $_GET['id_usuario'] ?? '';
            $accion = 'consultarDatosUsuario';
            UserController::consultaDatosUser($id_usuario, $accion);
            break;
            //en caso de entrar por aquí y no existir ningún action, redirigimos al index
        default:
            header("Location: /marketplace");
            exit(); 
            break;
    }
}

?>