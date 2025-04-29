<?php
class Auth {
    // Método para encriptar una contraseña
    public static function encryptPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}

//URL: http://localhost:8080/marketplace/app/helpers/encriptar.php
$password = "roro";
$encryptedPassword = Auth::encryptPassword($password);
echo $encryptedPassword;
?>