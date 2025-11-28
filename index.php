<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nivelación Servidor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }
        .contenedor {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Estado de Servicios del Servidor</h2>

  
    <p><strong>Fecha y hora del servidor:</strong></p>
    <p style="font-size:18px; color:blue;">
        <?php
            date_default_timezone_set("America/Bogota");
            echo date("Y-m-d H:i:s");
        ?>
    </p>

   
    <form method="post">
        <label for="servicio">Seleccione el servicio que presenta fallas:</label>
        <select name="servicio" id="servicio">
            <option value="Apache fuera de línea">Servidor Web Apache fuera de línea</option>
            <option value="MySQL fuera de línea">Base de datos MySQL fuera de línea</option>
            <option value="FTP no disponible">Servidor FTP no disponible</option>
            <option value="Correo SMTP caído">Servicio de Correo SMTP caído</option>
        </select>

        <button type="submit">Reportar falla</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<p style='margin-top:20px; color:red;'>
                <strong>Falla reportada:</strong> " . $_POST["servicio"] . "
              </p>";
    }
    ?>
</div>

</body>
</html>
