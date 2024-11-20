<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Crear Cliente</h1>
<div class="nav">
    <a href="index.php">
        <button>Inicio</button>
    </a>
</div>
<div class="container">
    <?php
    include 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];

        // Insertar el nuevo cliente
        $sql = "INSERT INTO clientes (nombre, email) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $email);
        if ($stmt->execute()) {
            // Redirigir a la vista de detalles del cliente
            header("Location: index.php");
        } else {
            echo "Error al crear el cliente: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    } else {
        echo "<form method='post' action='crear_cliente.php'>
    <label for='nombre'>Nombre:</label>
    <input type='text' id='nombre' name='nombre' required>
    <label for='email'>Email:</label>
    <input type='email' id='email' name='email' required>
    <button type='submit'>Crear Cliente</button>
    </form>";
    }
    ?>
</div>
</body>
</html>