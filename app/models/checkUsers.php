<?php
require_once __DIR__ . './../helpers/db.php';
require_once __DIR__ . './../helpers/auth.php';

$logFile = __DIR__ . '/../../logs/checkUsers.log';
$action = $_POST['action'] ?? null;
//Si action no es igual a checkUserExists no se está autentificando un usuario
if ($action!='checkUserExists') {
    // Obtener la lista de usuarios y sus roles
    $db = Database::connect();
    try {
        $stmt = $db->query(
            "SELECT u.id_usuario, u.nombre, u.apellido, r.nombre_rol, d.email
            FROM usuarios u 
            JOIN roles r ON u.id_rol = r.id_rol
            JOIN datos_personales d ON u.id_usuario = d.id_usuario
            ORDER BY apellido"
        );
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $logMessage = date('Y-m-d H:i:s') . " checkUsers - Listado de usuarios mostrado\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        
    } catch (Exception $e) {
        $logMessage = date('Y-m-d H:i:s') . " checkUsers - Error: " . $e->getMessage() . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        //die("Error: " . $e->getMessage());
    }
} else {
    $email = $_POST['email'] ?? '';
    $password = trim($_POST['password']) ?? '';
    
    header('Content-Type: application/json'); //Establece el encabezado para devolver JSON para controlar el error en login
    // Verificar si el usuario existe
    $db = Database::connect();
    try {
        // Preparar la consulta para obtener los datos del usuario
        $stmt = $db->prepare(
            "SELECT u.nombre, u.password, r.nombre_rol, e.email, u.id_usuario
            FROM usuarios u 
            JOIN roles r ON u.id_rol = r.id_rol 
            JOIN datos_personales e ON u.id_usuario = e.id_usuario
            WHERE e.email = :email" //Solo buscamos por email ya que no puede repetirse.
        );
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //Recuperar el hash de la base de datos
        $hash = $usuario['password'];
        $nombrebd = $usuario['nombre'];
        $emailbd = $usuario['email'];
        $id_usuario = $usuario['id_usuario'];
    
        if ($usuario) {
            //Verificar la contraseña usando verifyPassword
            if (password_verify($password, $hash)) {
                //Contraseña correcta, guardar datos en sesión
                loginUser($nombrebd, $usuario['nombre_rol'], $emailbd, $id_usuario);
  
                // Registrar en el log
                $logMessage = date('Y-m-d H:i:s') . " checkUsers - Usuario: " . $nombrebd . " Rol: " . $usuario['nombre_rol'] . " Email: " . $emailbd . "\n";
                file_put_contents($logFile, $logMessage, FILE_APPEND);

            } else {
                //Contraseña incorrecta
                $logMessage = date('Y-m-d H:i:s') . " checkUsers - Contraseña incorrecta para usuario " . $nombrebd . " con email " . $email . " hash de bbdd " . $hash . " password del post " . $password . "\n";
                file_put_contents($logFile, $logMessage, FILE_APPEND);
                
                echo json_encode(['success' => false, 'message' => 'La contraseña es incorrecta. Prueba de nuevo']);
                exit();
            }
        } else {
            //Usuario no encontrado
            $logMessage = date('Y-m-d H:i:s') . " checkUsers - Usuario no encontrado: " . $nombrebd . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            
            echo json_encode(['success' => false, 'message' => 'El usuario no existe.']);
            exit();
            //echo "Usuario o contraseña incorrectos.";
        }
    } catch (Exception $e) {
        //Manejar errores
        $logMessage = date('Y-m-d H:i:s') . " checkUsers - Error: " . $e->getMessage() . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        die("Error: " . $e->getMessage());
    }
}
?>