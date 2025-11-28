<?php
require 'conexion.php'; // Importa la conexión

$mensaje = "";

// Si el usuario envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $rol = $_POST["rol"];
    $nivel = intval($_POST["nivel"]);
    $fecha = $_POST["fecha"];

    // Seleccionar la colección (ahora sí)
    $collection = $database->selectCollection("administradores");

    // Documento que se guardará en Atlas
    $documento = [
        "nombre_administrador" => $nombre,
        "rol_responsabilidad" => $rol,
        "nivel_acceso" => $nivel,
        "fecha_asignacion" => $fecha,
        "fecha_registro" => new MongoDB\BSON\UTCDateTime()
    ];

    // Insertar documento
    try {
        $resultado = $collection->insertOne($documento);
        $mensaje = "Administrador registrado con éxito. ID: " . $resultado->getInsertedId();
    } catch (Exception $e) {
        $mensaje = "Error al registrar: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Administradores de Red</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }
        .formulario {
            background: white;
            width: 400px;
            padding: 20px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, select, button {
            width: 95%;
            padding: 10px;
            margin-top: 12px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: 0;
            cursor: pointer;
        }
        .mensaje {
            color: green;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="formulario">
    <h2>Registro de Administradores de Red</h2>

    <?php
    // Mostrar mensaje si existe
    if ($mensaje != "") {
        echo "<p class='mensaje'>$mensaje</p>";
    }
    ?>

    <form method="POST" action="registro_admin.php">
        <label>Nombre del administrador:</label>
        <input type="text" name="nombre" required>

        <label>Rol o área de responsabilidad:</label>
        <select name="rol" required>
            <option value="Seguridad">Seguridad</option>
            <option value="Base de datos">Base de datos</option>
            <option value="Infraestructura">Infraestructura</option>
            <option value="Soporte">Soporte</option>
        </select>

        <label>Nivel de acceso (1 a 5):</label>
        <select name="nivel" required>
            <option value="1">1 - Bajo</option>
            <option value="2">2 - Medio Bajo</option>
            <option value="3">3 - Medio</option>
            <option value="4">4 - Alto</option>
            <option value="5">5 - Máximo</option>
        </select>

        <label>Fecha de asignación:</label>
        <input type="date" name="fecha" required>

        <button type="submit">Registrar</button>
    </form>
</div>

</body>
</html>
