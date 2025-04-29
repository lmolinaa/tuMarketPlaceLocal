<?php
//Ruta al archivo JSON
//$jsonFilePath = '/marketplace/public/files/servicios.json';
$jsonFilePath = $_SERVER['DOCUMENT_ROOT'] . '/marketplace/public/files/servicios.json';

$categoria = '';
if (!empty($_POST['categoria'])){
    $categoria = $_POST['categoria'];
}else{
    $categoria = $_POST['categoria1'];
}
$servicio = $_POST['nombreServicio'] ?? '';
$mensaje = ''; 

/*echo $categoria . " - " . $servicio;
die();*/

//Verificar si el directorio existe, si no, crearlo
$directoryPath = dirname($jsonFilePath);
if (!is_dir($directoryPath)) {
    mkdir($directoryPath, 0755, true);
}

//Leer el contenido actual del archivo JSON
if (file_exists($jsonFilePath)) {
    $jsonContent = file_get_contents($jsonFilePath);
    $data = json_decode($jsonContent, true); //Convertir JSON a un array asociativo para trabajar con él

    //Verificar que la decodificación fue bien
    if ($data === null) {
        echo "Error al leer el archivo JSON: " . json_last_error_msg();
    }
    
    if (!empty($categoria) && !empty($servicio) ){
        //Agregar un nuevo servicio a la categoría seleccionada
        $data[$categoria][] = $servicio;
    } else if (!empty($categoria) && empty($servicio)){
        //Agregar una nueva categoría
        $data[$categoria] = [];
    }

    //Guardamos los cambios de vuelta al archivo JSON
    $newJsonContent = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if (file_put_contents($jsonFilePath, $newJsonContent)) {
        header("Location: /marketplace/app/views/actions/buscoOfrezco.php?$mensaje=El archivo JSON se ha actualizado correctamente.");
        exit();
    } else {
        header("Location: /marketplace/app/views/actions/buscoOfrezco.php?$mensaje=Error al guardar el archivo JSON.");
        exit();
    }
} else {
    header("Location: /marketplace/app/views/actions/buscoOfrezco.php?$mensaje=El archivo JSON no existe.");
    exit();
}