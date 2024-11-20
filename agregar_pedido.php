<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pedido</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Agregar Pedido</h1>
<div class="nav">
    <a href="index.php">
        <button>Inicio</button>
    </a>
</div>
<div class="container">
    <?php
    include 'db_connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $fecha = $_POST['fecha'];

        // Obtener el id_cliente a partir del email
        $sql = "SELECT id_cliente FROM clientes WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id_cliente = $row['id_cliente'];

        // Insertar el nuevo pedido
        $sql = "INSERT INTO pedidos (id_cliente, fecha) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $id_cliente, $fecha);
        if ($stmt->execute()) {
            // Redirigir a la vista de detalles del cliente
            header("Location: detalles.php?email=" . urlencode($email));
            exit();
        } else {
            echo "Error al agregar el pedido: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    } else {
        $email = $_GET['email'];
        echo "<form method='post' action='agregar_pedido.php'>
    <input type='hidden' name='email' value='" . htmlspecialchars($email) . "'>
    <label for='fecha'>Fecha del Pedido:</label>
    <input type='date' id='fecha' name='fecha' required>
    <button type='submit'>Agregar Pedido</button>
    </form>";
    }
    ?>
</div>
</body>
</html>