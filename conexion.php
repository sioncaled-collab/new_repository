<?php

require __DIR__ . '/vendor/autoload.php'; 

use MongoDB\Client;

try {
    $uri = "mongodb+srv://sioncaled_db_user:1032388086Bv@cluster0.yq4vidk.mongodb.net/?appName=Cluster0";

    // Crear cliente
    $client = new Client($uri);

    // Seleccionar base de datos
    $database = $client->selectDatabase("sistema_red");

} catch (Exception $e) {
    die("Error al conectar a MongoDB Atlas: " . $e->getMessage());
}
?>
