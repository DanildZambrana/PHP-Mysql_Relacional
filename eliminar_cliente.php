<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Eliminar Cliente</h1>
<?php
include 'db_connection.php';

$email = $_GET['email'];

// Obtener el id_cliente a partir del email
$sql = "SELECT id_cliente FROM clientes WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$id_cliente = $row['id_cliente'];

// Eliminar los pedidos relacionados
$sql = "DELETE FROM pedidos WHERE id_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();

// Eliminar el cliente
$sql = "DELETE FROM clientes WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
if ($stmt->execute()) {
    echo "Cliente eliminado exitosamente.";
} else {
    echo "Error al eliminar el cliente: " . $stmt->error;
}
$stmt->close();
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: index.php");
exit();
?>
</body>
</html>