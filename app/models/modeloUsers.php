<?php
require_once __DIR__ . './../helpers/db.php';
require_once __DIR__ . './../helpers/auth.php';

//Controlamos que la session esté activa
if (session_status() == PHP_SESSION_NONE) {
    include __DIR__ . '/../config/session.php';
}

class Users {
    public function getDataUser($id_usuario) {
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        $db = Database::connect();
        $query = "SELECT a.id_usuario, a.nombre, a.apellido, a.id_rol, a.password, b.direccion,
                        c.nombre_rol, b.email, b.telefono, b.municipio, b.codigo_postal, b.pais
                    FROM marketplace.usuarios a
                    INNER JOIN marketplace.datos_personales b ON a.id_usuario = b.id_usuario
                    INNER JOIN marketplace.roles c ON a.id_rol = c.id_rol
                    WHERE a.id_usuario = :id_usuario";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);

         try {
            $stmt->execute();
            $allDataUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $allDataUser;
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            return false;
        }
    }

    public function updateDataUser($datosUsuario) {
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        $db = Database::connect();
        
        try {
            // Iniciar la transacción
            $db->beginTransaction();
    
            // Update para tabla usuarios
            $queryUsuarios = "UPDATE usuarios SET
                                nombre = :nombre,
                                apellido = :apellido,
                                id_rol = :id_rol,
                                password = :password
                              WHERE id_usuario = :id_usuario";
            
            $stmtUsuario = $db->prepare($queryUsuarios);
            $stmtUsuario->execute([
                ':nombre' => $datosUsuario['nombre'],
                ':apellido' => $datosUsuario['apellido'],
                ':id_rol' => $datosUsuario['id_rol'],
                ':password' => $datosUsuario['password'],
                ':id_usuario' => $datosUsuario['id_usuario']
            ]);
    
            // Update para tabla datos_personales
            $queryDatosPersonales = "UPDATE datos_personales SET
                                        codigo_postal = :codigo_postal,
                                        direccion = :direccion,
                                        email = :email,
                                        telefono = :telefono,
                                        municipio = :municipio,
                                        pais = :pais
                                     WHERE id_usuario = :id_usuario";
    
            $stmtDatosPersonales = $db->prepare($queryDatosPersonales);
            $stmtDatosPersonales->execute([
                ':codigo_postal' => $datosUsuario['codigo_postal'],
                ':direccion' => $datosUsuario['direccion'],
                ':email' => $datosUsuario['email'],
                ':telefono' => $datosUsuario['telefono'],
                ':municipio' => $datosUsuario['municipio'],
                ':pais' => $datosUsuario['pais'],
                ':id_usuario' => $datosUsuario['id_usuario']
            ]);

            //die($queryUsuarios . " <br> " . $queryDatosPersonales . "<br>" . print_r($datosUsuario, true));
            //Confirmar la transacción, solo ocurre si todo va bien
            $db->commit();
            return true;
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " Update fallido en modeloUser->updateUser para usuario " . $datosUsuario['id_usuario'] . ": " . $e->getMessage() . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            $db->rollBack(); // Revertir la transacción si ocurre un error
            return false;
        }
    }

    public function updatePassUser($email, $password){
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        $db = Database::connect();
        //Filtramos por email para sacar el id_usuario y así modificar su password
        $queryUsuario = "SELECT id_usuario FROM datos_personales WHERE email = :email";
        $stmt = $db->prepare($queryUsuario);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $id_usuario = $result['id_usuario'];
            } else {
                throw new PDOException("Usuario no encontrado");
            }
        }catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " Consulta por email fallida: " . $e->getMessage() . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            return false;
        }

        //Encriptamos la nueva password
        $hashedPassword = Auth::encryptPassword($password);
        $queryUpdatePass = "UPDATE usuarios SET password = :password
                    WHERE id_usuario = :id_usuario";
        $stmt = $db->prepare($queryUpdatePass);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);

         try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " Update Password fallida: " . $e->getMessage() . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            return false;
        }       
    }

    public function createSuscripcion($datosSuscripcion) {
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        $db = Database::connect();
        
        /************ ESTO HABRÍA QUE MONTARLO EN UN JSON O SIMILAR ***************/
        $valor = "";
        if ($datosSuscripcion['suscripcion'] === "1"){
            $valor = 15;
        }else if ($datosSuscripcion['suscripcion'] === "3"){
            $valor = 40;

        }else if ($datosSuscripcion['suscripcion'] === "6"){
            $valor = 75;

        }else if ($datosSuscripcion['suscripcion'] === "12"){
            $valor = 140;

        }

        try {
            // Iniciar la transacción
            $db->beginTransaction();
            //Insertamos en la tabla de usuario_ofrece si el id_rol es 2
            $query = "INSERT INTO usuario_ofrece (id_usuario, categoria, servicio, titulo, detalle, empresa, imagen, fecha, precio, municipio) 
                                VALUES (:id_usuario, :categoria, :servicio, :titulo, :detalle, :empresa, :imagen, :fecha, :precio, :serviceMunicipio)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                ':id_usuario' => $datosSuscripcion['id_usuario'],
                ':categoria' => $datosSuscripcion['categoria'],
                ':servicio' => $datosSuscripcion['servicio'],
                ':titulo' => $datosSuscripcion['titulo'],
                ':detalle' => $datosSuscripcion['detalle'],
                ':empresa' => $datosSuscripcion['empresa'],
                ':imagen' => $datosSuscripcion['imagen'],
                ':fecha' => $datosSuscripcion['fecha'],
                ':precio' => $datosSuscripcion['precio'],
                ':serviceMunicipio' => $datosSuscripcion['serviceMunicipio']
            ]);

            //Obtenemos el id_usuario_ofrece que acabamos de insertar para meterlo en la tabla suscripciones
            $id_usuario_ofrece = $db->lastInsertId();

            //Modificamos datos_pesonales del usuario sobre iban y tarjeta
            //El resto de datos se capturan por si en un futuro se permiten modificaciones desde aquí
            $queryDatosPersonales = "UPDATE datos_personales SET
                /*id_usuario = :codigo_postal,
                direccion = :direccion,
                email = :email,
                telefono = :telefono,
                municipio = :municipio,
                pais = :pais*/
                iban = :iban,
                tarjeta = :tarjeta,
                update_fecha = :update_fecha
                                            WHERE id_usuario = :id_usuario";

            $stmtDatosPersonales = $db->prepare($queryDatosPersonales);
            $stmtDatosPersonales->execute([
            /*':codigo_postal' => $datosUsuario['codigo_postal'],
            ':direccion' => $datosUsuario['direccion'],
            ':email' => $datosUsuario['email'],
            ':telefono' => $datosUsuario['telefono'],
            ':municipio' => $datosUsuario['municipio'],
            ':pais' => $datosUsuario['pais'],*/
            ':id_usuario' => $datosSuscripcion['id_usuario'],
            ':iban' => $datosSuscripcion['iban'],
            ':tarjeta' => $datosSuscripcion['tarjeta'],
            ':update_fecha' => $datosSuscripcion['update_fecha']
            ]);

            $querySuscripcion = "INSERT INTO suscripciones (tiempo_suscripcion, valor, fecha_suscripcion, id_usuario, id_usuario_ofrece) 
                                VALUES (:tiempo_suscripcion, :valor, :fecha_suscripcion, :id_usuario, :id_usuario_ofrece)";
            $stmt = $db->prepare($querySuscripcion);
            $stmt->execute([
                ':tiempo_suscripcion' => $datosSuscripcion['suscripcion'],
                ':valor' => $valor,
                ':fecha_suscripcion' => $datosSuscripcion['update_fecha'],
                ':id_usuario' => $datosSuscripcion['id_usuario'],
                ':id_usuario_ofrece' => $id_usuario_ofrece
            ]);

            if ($datosSuscripcion['id_rol'] != 1) {
                $queryRol = "UPDATE usuarios SET id_rol=2 WHERE id_usuario = :id_usuario";
                $stmt = $db->prepare($queryRol);
                $stmt->execute([
                    ':id_usuario' => $datosSuscripcion['id_usuario']
                ]);
            }

            // Confirmar la transacción, solo ocurre si todo va bien
            $db->commit();

            /*Ahora llamamos a la función loginUser de la session para actualizar los valores del usuario
            Si la actualización fuese mayor, habría que consultar bbdd u obligar al usuario a iniciar sesió de nuevo,
            como solo actualizamos en session en rol, lo pasamos hardcodeado*/
            loginUser($_SESSION['nombre'], 'Ofrezco servicio', $_SESSION['email'], $_SESSION['id_usuario']);
            return true;
        }catch(PDOException $e){
            $logMessage = date('Y-m-d H:i:s') . " Insert o update fallida en suscripción: " . $e->getMessage() . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            $db->rollBack(); // Revertir la transacción si ocurre un error
            return false;
        }
    }

    public function updateUsuarioOfrece($datosActualizadosSuscripcion) {
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        $db = Database::connect();
    
        // Construir la consulta de actualización dinámicamente
        $queryUpdateCard = "UPDATE usuario_ofrece SET titulo = :titulo, detalle = :detalle, empresa = :empresa, precio = :precio, municipio = :municipio";
        
        // Verificar si el campo imagen no está vacío
        if (!empty($datosActualizadosSuscripcion['imagen'])) {
            $queryUpdateCard .= ", imagen = :imagen";
        }
        
        //en el where modificamos el id_usuario_ofrece (puede modificarlo tanto el usuario propietario como el admin)
        $queryUpdateCard .= " WHERE id_usuario_ofrece = :id_usuario_ofrece";
        
        $stmt = $db->prepare($queryUpdateCard);
        
        // Preparar los parámetros de la consulta
        $params = [
            //':id_usuario' => $datosActualizadosSuscripcion['id_usuario'],
            ':id_usuario_ofrece' => $datosActualizadosSuscripcion['id_usuario_ofrece'],
            ':titulo' => $datosActualizadosSuscripcion['titulo'],
            ':detalle' => $datosActualizadosSuscripcion['detalle'],
            ':empresa' => $datosActualizadosSuscripcion['empresa'],
            ':precio' => $datosActualizadosSuscripcion['precio'],
            ':municipio' => $datosActualizadosSuscripcion['municipio']
        ];
        
        // Agregar el parámetro imagen si no está vacío
        if (!empty($datosActualizadosSuscripcion['imagen'])) {
            $params[':imagen'] = $datosActualizadosSuscripcion['imagen'];
        }
        
        $stmt->execute($params);
    
        // Actualizar los datos específicos en la sesión
        $_SESSION['detalleByCard'][0]['titulo'] = $datosActualizadosSuscripcion['titulo'];
        $_SESSION['detalleByCard'][0]['detalle'] = $datosActualizadosSuscripcion['detalle'];
        $_SESSION['detalleByCard'][0]['empresa'] = $datosActualizadosSuscripcion['empresa'];
        $_SESSION['detalleByCard'][0]['precio'] = $datosActualizadosSuscripcion['precio'];
        $_SESSION['detalleByCard'][0]['municipio'] = $datosActualizadosSuscripcion['municipio'];
        
        // Actualizar el campo imagen en la sesión solo si no está vacío
        if (!empty($datosActualizadosSuscripcion['imagen'])) {
            $_SESSION['detalleByCard'][0]['imagen'] = $datosActualizadosSuscripcion['imagen'];
        }
    
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " La modificación en modeloUsers de usuario ofrece ha resultado fallida: " . $e->getMessage() . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            return false;
        }
    }

    public function deleteUsuarioOfrece($id_usuario_ofrece) {
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        $db = Database::connect();
    
        //Iniciar una transacción
        $db->beginTransaction();
    
        // Elminamos primero de la tabla suscripciones para que no haya problemas de clave foránea y luego eliminamos de usuario_ofrece
        try {
            // Eliminar de la tabla suscripciones
            $querySuscripcion = "DELETE FROM suscripciones WHERE id_usuario_ofrece = :id_usuario_ofrece";
            $stmtSuscripcion = $db->prepare($querySuscripcion);
            $stmtSuscripcion->bindParam(':id_usuario_ofrece', $id_usuario_ofrece, PDO::PARAM_STR);
            $stmtSuscripcion->execute();

            //Eliminar de la tabla usuario_ofrece
            $query = "DELETE FROM usuario_ofrece WHERE id_usuario_ofrece = :id_usuario_ofrece";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_usuario_ofrece', $id_usuario_ofrece, PDO::PARAM_STR);
            $stmt->execute();
        
            //Confirmamos la transacción una vez que todo ha ido bien
            $db->commit();
            return true;
        } catch (PDOException $e) {
            //Revertir la transacción en caso de error
            $db->rollBack();
            $logMessage = date('Y-m-d H:i:s') . " La eliminación en modeloUsers de usuario ofrece ha resultado fallida: " . $e->getMessage() . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            return false;
        }
    }

    public function getMensajesUsuario($id_usuario){
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        //usamos un flag si la consulta de mensajes ha ido bien o no y desde el controlador redirigir donde corresponda
        $flagMensajes = false;
        $db = Database::connect();
        $query = "SELECT a.id_mensaje, a.id_emisor, a.titulo, a.mensaje, a.fecha_envio, a.leido, b.email, c.nombre, c.apellido
                    FROM mensajes a
                    INNER JOIN datos_personales b ON a.id_emisor = b.id_usuario
                    INNER JOIN usuarios c ON a.id_emisor = c.id_usuario
                    WHERE a.id_receptor = :id_usuario
                    ORDER BY a.fecha_envio DESC";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);

         try {
            $stmt->execute();
            $allMessage = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['mensajesUsuario'] = $allMessage;
            $flagMensajes = true;
            UserController::mostrarMensajesUsuario($flagMensajes);
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            UserController::mostrarMensajesUsuario($flagMensajes);
        }
    }

    public function modifMensajesUsuario($id_mensaje, $id_usuario, $mensajeLeido){
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        $db = Database::connect();
        $cambioEstado = '';

        if ($mensajeLeido === '0'){
            $cambioEstado = 1;
        } else {
            $cambioEstado = 0;
        }
    
        //Modificamos el estado del mensaje y si va bien llamamos a la función de consulta de menajes
        $queryUpdateMensaje = "UPDATE mensajes SET leido = $cambioEstado WHERE id_mensaje = :id_mensaje";
        $stmt = $db->prepare($queryUpdateMensaje);
        $stmt->bindParam(':id_mensaje', $id_mensaje, PDO::PARAM_STR);

        try {
            $stmt->execute();
            //Instanciar la clase Users para llamar a la función de consulta de mensajes
            $usersModel = new Users();
            $usersModel->getMensajesUsuario($id_usuario);
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " La modificación en modeloUsers de usuario ofrece ha resultado fallida: " . $e->getMessage() . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            return false;
        }
    }

    public function getMensajeById($id_mensaje){
        $logFile = __DIR__ . '/../../logs/modeloUsers.log';
        $db = Database::connect();

        $query = "SELECT id_emisor, id_receptor, titulo, mensaje FROM mensajes WHERE id_mensaje = :id_mensaje";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_mensaje', $id_mensaje, PDO::PARAM_STR);

         try {
            $stmt->execute();
            $mensajeSeleccionado = $stmt->fetch(PDO::FETCH_ASSOC);
            //$mensajeSeleccionado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $mensajeSeleccionado;
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . "\n";
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            return false;
        }
    }
}
?>