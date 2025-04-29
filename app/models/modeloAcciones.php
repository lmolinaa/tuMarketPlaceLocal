<?php
require_once __DIR__ . './../helpers/db.php';

class Acciones {
    public function getMunicipios() {
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT DISTINCT municipio FROM codigos_postales ORDER BY municipio";
        $stmt = $db->prepare($query);

         try {
            $stmt->execute();
            $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $municipios;
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }       
    }

    public function getCpByMunicipio($municipio){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT codigo_postal, municipio FROM codigos_postales WHERE municipio = :municipio ORDER BY codigo_postal";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':municipio', $municipio, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $cpCity = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $cpCity;
        } catch (PDOException $e) {
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }  
    }

    public function getCardsByServicio($servicioSeleccionado, $categoriaSeleccionada){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT a.id_usuario_ofrece, a.id_usuario, a.categoria, a.servicio, a.titulo, a.detalle, a.imagen,
                    a.fecha, a.precio, a.municipio, a.empresa, b.id_suscripcion
                    FROM usuario_ofrece a
                    inner join suscripciones b on a.id_usuario_ofrece = b.id_usuario_ofrece
                    WHERE categoria = :categoria AND servicio = :servicio ORDER BY fecha";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':categoria', $categoriaSeleccionada, PDO::PARAM_STR);
        $stmt->bindParam(':servicio', $servicioSeleccionado, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            $cardsByServicio = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $cardsByServicio;
        } catch (PDOException $e) {
            // Registrar la consulta y los parámetros en el log si hay error
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . " - Params: " . json_encode([':categoria' => $categoriaSeleccionada, ':servicio' => $servicioSeleccionado]) . " - Error: " . $e->getMessage() . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }
    }

    public function getCardByIdUsuarioOfrece($id_usuario_ofrece){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT a.id_usuario_ofrece, a.id_usuario, a.categoria, a.servicio, a.titulo, a.detalle, a.imagen,
                    a.fecha, a.precio, a.municipio, a.empresa, b.id_suscripcion, b.fecha_suscripcion
                    FROM usuario_ofrece a
                    inner join suscripciones b on a.id_usuario_ofrece = b.id_usuario_ofrece
                    WHERE a.id_usuario_ofrece = :id_usuario_ofrece ORDER BY fecha";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_usuario_ofrece', $id_usuario_ofrece, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            $cardByIdUsuarioOfrece = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $cardByIdUsuarioOfrece;
        } catch (PDOException $e) {
            // Registrar la consulta y los parámetros en el log si hay error
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . " - Params: " . json_encode([':categoria' => $id_usuario_ofrece]) . " - Error: " . $e->getMessage() . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }
    }

    public function getCardsByMunicipio($municipio){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT * FROM usuario_ofrece WHERE municipio = :municipio ORDER BY fecha";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':municipio', $municipio, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            $cardsByMunicipio = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $cardsByMunicipio;
        } catch (PDOException $e) {
            // Registrar la consulta y los parámetros en el log si hay error
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . " - Params: " . json_encode([':municipio' => $municipio]) . " - Error: " . $e->getMessage() . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }
    }

    public function getDetalleByCard($id_usuario, $servicioSeleccionado, $categoriaSeleccionada, $id_usuario_ofrece, $id_suscripcion){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT
                    a.id_usuario_ofrece, a.id_usuario, a.categoria, a.servicio, a.titulo, a.detalle, a.imagen,
                    a.fecha, a.precio, a.municipio, a.empresa, b.email, b.telefono, c.nombre, c.apellido, c.id_rol,
                    d.id_suscripcion, d.tiempo_suscripcion, d.valor, d.fecha_suscripcion
		        FROM usuario_ofrece a 
                INNER JOIN datos_personales b ON a.id_usuario = b.id_usuario
                INNER JOIN usuarios c ON a.id_usuario = c.id_usuario
                INNER JOIN suscripciones d ON a.id_usuario = d.id_usuario
                WHERE a.id_usuario = :id_usuario
                    AND a.categoria = :categoria AND a.servicio = :servicio";
                    if ($id_usuario_ofrece !== 'isNull') {
                        $query .= " AND a.id_usuario_ofrece = :id_usuario_ofrece";
                    }
                    if ($id_suscripcion !== 'isNull') {
                        $query .= " AND d.id_suscripcion = :id_suscripcion";
                    }

        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoriaSeleccionada, PDO::PARAM_STR);
        $stmt->bindParam(':servicio', $servicioSeleccionado, PDO::PARAM_STR);
        if ($id_usuario_ofrece !== 'isNull') {
            $stmt->bindParam(':id_usuario_ofrece', $id_usuario_ofrece, PDO::PARAM_STR);
        }
        if ($id_suscripcion !== 'isNull') {
            $stmt->bindParam(':id_suscripcion', $id_suscripcion, PDO::PARAM_STR);
        }

        try{
            $stmt->execute();
            $detalleByCard = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $detalleByCard;
        } catch (PDOException $e){
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . " - Error: " . $e->getMessage() . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }
    } 
    
    public function getBuscarPalabrasByCards($buscarPalabras){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT * 
                        FROM usuario_ofrece 
                        WHERE municipio LIKE :buscarPalabras 
                            OR servicio LIKE :buscarPalabras 
                            OR categoria LIKE :buscarPalabras 
                            OR detalle LIKE :buscarPalabras 
                            OR precio LIKE :buscarPalabras
                            OR empresa LIKE :buscarPalabras";
        $stmt = $db->prepare($query);
        $cualquieraBuscarPalabras = '%' . $buscarPalabras . '%';
        $stmt->bindParam(':buscarPalabras', $cualquieraBuscarPalabras, PDO::PARAM_STR);
       
        try {
            $stmt->execute();
            $buscarPalabrasByCards = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $buscarPalabrasByCards;
        } catch (PDOException $e) {
            // Registrar la consulta y los parámetros en el log si hay error
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . " - Params: " . json_encode(['palabras buscadas' => $buscarPalabras]) . " - Error: " . $e->getMessage() . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }
    }

    public function getCardsByIdUsuario($cardsByIdUsuario){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT b.id_suscripcion, a.id_usuario_ofrece, a.id_usuario, a.categoria, a.servicio,
                        a.titulo, a.detalle, a.imagen, a.fecha, a.precio, a.municipio, a.empresa
                        FROM usuario_ofrece a
                        inner join suscripciones b on a.id_usuario_ofrece = b.id_usuario_ofrece
                        WHERE a.id_usuario = :id_usuario";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_usuario', $cardsByIdUsuario, PDO::PARAM_STR);   
       
        try {
            $stmt->execute();
            $idCardsByIdUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $idCardsByIdUsuario;
        } catch (PDOException $e) {
            // Registrar la consulta y los parámetros en el log si hay error
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . " - Error: " . $e->getMessage() . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }
    }

    public function getCardByIdUpdate ($id_card){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "SELECT b.id_suscripcion, a.id_usuario_ofrece, a.id_usuario, a.categoria, a.servicio,
                        a.titulo, a.detalle, a.imagen, a.fecha, a.precio, a.municipio, a.empresa
                        FROM usuario_ofrece a
                        inner join suscripciones b on a.id_usuario_ofrece = b.id_usuario_ofrece                    
                        WHERE a.id_usuario_ofrece = :id_usuario_ofrece";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_usuario_ofrece', $id_card, PDO::PARAM_STR);   
       
        try {
            $stmt->execute();
            $idCardIdSuscripcionModif = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $idCardIdSuscripcionModif;

        } catch (PDOException $e) {
            //Registrar la consulta y los parámetros en el log si hay error
            $logMessage = date('Y-m-d H:i:s') . " Consulta fallida: " . $query . " - Error: " . $e->getMessage() . "\n";
            if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
                error_log("No se pudo escribir en el archivo de log: $logFile");
            }
            return false;
        }
    }
    
    public function guardarMensaje($id_emisor, $id_receptor, $titulo, $mensaje, $id_mensaje){
        $logFile = __DIR__ . '/../../logs/modeloAcciones.log';
        $db = Database::connect();
        $query = "INSERT INTO mensajes (id_emisor, id_receptor, titulo, mensaje, fecha_envio, leido, id_respuesta) VALUES (:id_emisor, :id_receptor, :titulo, :mensaje, NOW(), 0, :id_mensaje)";
    
        //Si id_mensaje es null, guardamos 0
        $id_respuesta = $id_mensaje ?? 0;

        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_emisor', $id_emisor, PDO::PARAM_INT);
            $stmt->bindParam(':id_receptor', $id_receptor, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
            $stmt->bindParam(':id_mensaje', $id_respuesta, PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            //Registramos error en el log
            $logMessage = date('Y-m-d H:i:s') . " - Error al guardar mensaje: " . $e->getMessage() . "\n";
            $logMessage .= "Consulta: $query\n";
            $logMessage .= "Parámetros: " . json_encode([
                'id_emisor' => $id_emisor,
                'id_receptor' => $id_receptor,
                'titulo' => $titulo,
                'mensaje' => $mensaje,
                'id_respuesta' => $id_respuesta
            ]) . "\n\n";

            file_put_contents($logFile, $logMessage, FILE_APPEND);
            return false;
        }
    }
}