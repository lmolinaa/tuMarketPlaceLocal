<?php
//Clase para manejar la conexión a la base de datos utilizando PDO.
class Database {
    private static $connection = null;

    public static function connect() {
        if (self::$connection === null) {
            $config = require __DIR__ . './../config/database.php';
            try {
                self::$connection = new PDO(
                    "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}",
                    $config['username'],
                    $config['password']
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
?>