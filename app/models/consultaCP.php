<?php
require_once __DIR__ . './../helpers/db.php';
$logFile = __DIR__ . '/../../logs/consultaCP.log';

$db = Database::connect();
try {
    $codigoPostal = $_POST['codigoPostal'] ?? '';

    // Preparar la consulta SQL
    $stmt = $db->prepare(
        "SELECT cp2.codigo_postal
        FROM codigos_postales cp1
        JOIN codigos_postales cp2 ON cp1.municipio = cp2.municipio
        WHERE cp1.codigo_postal = :codigoPostal order by cp2.codigo_postal"
    );
    $stmt->execute([':codigoPostal' => $codigoPostal]);
    $codigosPostales = $stmt->fetchAll(PDO::FETCH_ASSOC); // Array de resultados

    // Registrar log del resultado
    $logMessage = date('Y-m-d H:i:s') . " consultaCP - Listado de códigos Postales mostrado: " 
                  . implode(', ', array_column($codigosPostales, 'codigo_postal')) . "\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
    
} catch (Exception $e) {
    file_put_contents($logFile, date('Y-m-d H:i:s') . " consultaCP - Error: " . $e->getMessage() . "\n", FILE_APPEND);
    $codigosPostales = []; // En caso de error, devolvemos un array vacío
}
?>