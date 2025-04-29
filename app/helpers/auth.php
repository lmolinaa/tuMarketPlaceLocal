<?php
class Auth {
    // Método para encriptar una contraseña
    public static function encryptPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Método para verificar una contraseña
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}
?>
