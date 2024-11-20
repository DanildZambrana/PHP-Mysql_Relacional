<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Pedido</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Eliminar Pedido</h1>
<?php
include 'db_connection.php';

$id_pedido = $_GET['id_pedido'];

// Eliminar el pedido
$sql = "DELETE FROM pedidos WHERE id_pedido = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pedido);
if ($stmt->execute()) {
    echo "Pedido eliminado exitosamente.";
} else {
    echo "Error al eliminar el pedido: " . $stmt->error;
}
$stmt->close();
$conn->close();

// Redirigir de vuelta a la página de detalles del cliente
header("Location: detalles.php?email=" . urlencode($_GET['email']));
exit();
?>
</body>
</html>