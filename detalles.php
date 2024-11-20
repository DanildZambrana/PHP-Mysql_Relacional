<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Cliente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Detalles del Cliente</h1>
<div class="nav">
    <a href="index.php"><button>Inicio</button></a>
</div>
<div class="container">
<?php
include 'db_connection.php';

$email = $_GET['email'];

// Consultar los datos del cliente y sus pedidos
$sql = "SELECT clientes.nombre, clientes.email, pedidos.fecha, pedidos.id_pedido
FROM clientes
LEFT JOIN pedidos ON clientes.id_cliente = pedidos.id_cliente
WHERE clientes.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Mostrar los resultados en una tabla HTML
echo "<div id='container'> <table border='1'>
<tr>
<th>Nombre</th>
<th>Email</th>
<th>Fecha del Pedido</th>
<th>Controles</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
<td>" . $row["nombre"] . "</td>
<td>" . $row["email"] . "</td>
<td>" . $row["fecha"] . "</td>
<td><a href='eliminar_pedido.php?id_pedido=" . urlencode($row["id_pedido"]) . "&email=". urlencode($email) ."' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este pedido?\");'><button>Eliminar Pedido</button></a></td>
</tr>";
    }
    echo "</table> </div>";
} else {
    echo "0 resultados";
}

$conn->close();
?>
</div>
</body>
</html>