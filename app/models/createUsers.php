<?php
require_once __DIR__ . './../helpers/db.php';
require_once __DIR__ . './../helpers/auth.php';

$logFile = __DIR__ . '/../../logs/createUsers.log';

// Encriptar la contraseña
$hashedPassword = Auth::encryptPassword($password);
$verificarPass = Auth::verifyPassword($password, $hashedPassword);

$nombre_rol = '';
if (isset($_SESSION['rol'])) {
    $nombre_rol = $_SESSION['rol'];

}

$db = Database::connect();

try {
    //Iniciar la transacción
    $db->beginTransaction();

    //Insertar en la tabla usuarios
    $queryUsuario = "INSERT INTO usuarios (nombre, apellido, password, fecha_registro, id_rol) 
                     VALUES (:nombre, :apellido, :password, NOW(), :id_rol)";
    $stmtUsuario = $db->prepare($queryUsuario);
    $stmtUsuario->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':password' => $hashedPassword,
        ':id_rol' => $id_rol,
    ]);

    //Obtenemos el ID del usuario insertado
    $usuario_id = $db->lastInsertId();

    //Verificamos si el email ya existe en la tabla datos_personales
    $queryCheckEmail = "SELECT COUNT(*) FROM datos_personales WHERE email = :email";
    $stmtCheckEmail = $db->prepare($queryCheckEmail);
    $stmtCheckEmail->execute([':email' => $email]);
    $emailExists = $stmtCheckEmail->fetchColumn();

    try {
        if ($emailExists) {
            //Indicamos el error en la variable mensajeResultado
            $mensajeResultado = "El correo electrónico ya existe en el sistema";
            throw new Exception("El correo electrónico ya existe en el sistema");
        } else {
            //Insertamos en la tabla de datos_personales
            $queryDatosPersonales = "INSERT INTO datos_personales (id_usuario, email, telefono, direccion, municipio, pais, codigo_postal) 
                                    VALUES (:id_usuario, :email, :telefono, :direccion, :municipio, :pais, :codigo_postal)";
            $stmtDatosPersonales = $db->prepare($queryDatosPersonales);
            $stmtDatosPersonales->execute([
                ':id_usuario' => $usuario_id,
                ':email' => $email,
                ':telefono' => $telefono,
                ':direccion' => $direccion,
                ':municipio' => $municipio,
                ':pais' => $pais,
                ':codigo_postal' => $codigo_postal,
            ]);
        }

    }catch (Exception $e){
        $errorMessage = $e->getMessage();
        $logMessage = date('Y-m-d H:i:s') . " Inserción Erronea por email repetido:" . $errorMessage . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }

    //Necesito sacar el nombre del id_rol para meterlo en la sesión si el usuario no existe.
    if ($nombre_rol !== 'administrador'){
        $stmt = $db->prepare(
        "SELECT u.nombre, u.password, r.nombre_rol, e.email, u.id_usuario
        FROM usuarios u 
        JOIN roles r ON u.id_rol = r.id_rol 
        JOIN datos_personales e ON u.id_usuario = e.id_usuario
        WHERE e.email = :email" //Solo buscamos por email ya que no puede repetirse.
        );
        $stmt->execute([':email' => $email]);
        $usuarioNuevo = $stmt->fetch(PDO::FETCH_ASSOC);

        loginUser($usuarioNuevo['nombre'], $usuarioNuevo['nombre_rol'], $usuarioNuevo['email'], $usuarioNuevo['id_usuario']);
    }
     
    //Confirmar la transacción, solo si ocurre si todo va bien
     $db->commit();
     //$logMessage = date('Y-m-d H:i:s') . " Inserción satisfactoria - Nombre: " . $nombre . " - creado con ID: " . $usuario_id . " - Nombre Rol: " . $nombre_rol . " - Email: " . $email . " -Municipio " . $municipio . " -CP: " . $codigo_postal . " -Password: " . $verificarPass . "\n";
     $logMessage = date('Y-m-d H:i:s') . " Inserción satisfactoria - Nombre: " . $nombre . " - creado con ID: " . $usuario_id . " - Nombre Rol: " . $nombre_rol . " - Email: " . $email . " -Municipio " . $municipio . " -CP: " . $codigo_postal . "\n";
     file_put_contents($logFile, $logMessage, FILE_APPEND);
} catch (Exception $e) {
     //Revertir la transacción si ocurre un error
     $db->rollBack();
     $logMessage = date('Y-m-d H:i:s') . " Inserción fallida: " . $e->getMessage() . "\n";
     file_put_contents($logFile, $logMessage, FILE_APPEND);
     $mensajeResultado = "Inserción fallida: " . $e->getMessage();
}
?>