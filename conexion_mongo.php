<?php
require 'conexion.php';

echo "<h2>Conexión a MongoDB Atlas exitosa</h2>";

try {
    // Probar consulta
    $documento = $collection->findOne();
    
    echo "<p><strong>Conexión comprobada:</strong> OK</p>";
    echo "<p>Documento encontrado (si existe):</p>";
    echo "<pre>";
    print_r($documento);
    echo "</pre>";

} catch (Exception $e) {
    echo "Error al consultar MongoDB: " . $e->getMessage();
}
?>
