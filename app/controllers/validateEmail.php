<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Conexión a la base de datos
    require_once __DIR__ . './../helpers/db.php';
    $db = Database::connect();

    // Verificar si el email ya existe en la base de datos
    $query = "SELECT COUNT(*) FROM datos_personales WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->execute([':email' => $email]);
    $emailExists = $stmt->fetchColumn() > 0;

    // Devolvemos el resultado como JSON
    echo json_encode(['exists' => $emailExists]);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>
