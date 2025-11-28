<?php
// Incluir la conexión a MongoDB
require 'conexion.php';

// Seleccionar la colección "administradores"
$collection = $database->selectCollection("administradores");

// Obtener todos los documentos
$cursor = $collection->find(
    [],
    [
        'sort' => ['fecha_registro' => -1] // Ordenar del más reciente al más antiguo (opcional)
    ]
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Administradores de Red</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }
        h2 {
            text-align: center;
        }
        .contenedor {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: auto;
            width: 800px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .volver {
            margin-top: 15px;
            display: inline-block;
            padding: 8px 15px;
            background: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Administradores de Red Registrados</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre del administrador</th>
                <th>Rol / Área</th>
                <th>Nivel de acceso</th>
                <th>Fecha de asignación</th>
                <th>Fecha de registro</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Recorrer todos los documentos y mostrarlos en filas
            foreach ($cursor as $doc) {

                // Campos tal como los guardamos en registro_admin.php
                $nombre = $doc['nombre_administrador'] ?? '';
                $rol    = $doc['rol_responsabilidad'] ?? '';
                $nivel  = $doc['nivel_acceso'] ?? '';
                $fecha_asignacion = $doc['fecha_asignacion'] ?? '';

                // Fecha de registro: puede venir como MongoDB\BSON\UTCDateTime
                $fecha_registro = '';
                if (isset($doc['fecha_registro']) && $doc['fecha_registro'] instanceof MongoDB\BSON\UTCDateTime) {
                    $fecha_registro = $doc['fecha_registro']->toDateTime()->format('Y-m-d H:i:s');
                }

                echo "<tr>";
                echo "<td>" . htmlspecialchars($nombre) . "</td>";
                echo "<td>" . htmlspecialchars($rol) . "</td>";
                echo "<td>" . htmlspecialchars($nivel) . "</td>";
                echo "<td>" . htmlspecialchars($fecha_asignacion) . "</td>";
                echo "<td>" . htmlspecialchars($fecha_registro) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="registro_admin.php" class="volver">← Volver al formulario</a>
</div>

</body>
</html>
