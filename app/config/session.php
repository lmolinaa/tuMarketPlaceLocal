<?php
// Controlamos la sesión del usuario, guardamos el nombre de usuario, el rol y el tiempo de inactividad
session_start();

// Tiempo máximo de inactividad en segundos (1 hora)
define('SESSION_TIMEOUT', 3600);
$mensaje = "";

// Verifica si la sesión está activa y si se ha excedido el tiempo de inactividad
function verifySession() {
    if (isset($_SESSION['last_activity'])) {
        $inactive_time = time() - $_SESSION['last_activity'];
        if ($inactive_time > SESSION_TIMEOUT) {
            session_unset(); // Limpia las variables de sesión
            session_destroy(); // Destruye la sesión
            header("Location: /marketplace/app/views/user/logout.php?timeout=true");
            exit();
        }
    }
    $_SESSION['last_activity'] = time(); // Actualiza el tiempo de actividad
}

// Inicia sesión para el usuario con datos específicos
function loginUser($nombre, $rol, $email, $id_usuario) {
    //logs
    $logFile = __DIR__ . '/../../logs/session.log';

    $_SESSION['nombre'] = $nombre;
    $_SESSION['rol'] = $rol;
    $_SESSION['email'] = $email;
    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['last_activity'] = time(); // Registra el tiempo actual

    $logMessage = date('Y-m-d H:i:s') . " session - Nombre: " . $nombre . " Rol: " . $rol . " Email: " . $email . " id_usuario " . $id_usuario . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
}

// Cierra sesión
function logoutUser() {
    session_unset();
    session_destroy();
}

//Control de acceso por roles
function checkAccess($requiredPermission) {
    if (!isset($_SESSION['rol'])) {
        header("Location: /marketplace/app/views/user/logout.php?mensaje=No dispone de los permisos necesarios para acceder a esta página."); 
        exit();
    }

    $userRole = $_SESSION['rol'];
  
    //Definimos los permisos de cada rol
    $permissions = [
        'administrador' => [
            'login','dashboard', 'offer_services', 'search_services', 'view_content', 'edit_content', 'delete_content', 'view_messages', 'update_profile',
        ],
        'Ofrezco servicio' => [
            'login','dashboard', 'offer_services', 'view_content', 'view_messages', 'update_profile',
        ],
        'Busco servicio' => [
            'login','dashboard', 'view_content', 'view_messages', 'update_profile',
        ],
    ];

    // Verificar si el rol tiene el permiso requerido
    return isset($permissions[$userRole]) && in_array($requiredPermission, $permissions[$userRole]);
}
?>
