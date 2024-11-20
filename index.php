<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Listado de Clientes y Pedidos</h1>
<div class="nav">
    <a href="crear_cliente.php">
        <button>Crear Nuevo Cliente</button>
    </a>
</div>
<div class="container">

    <?php
    include 'db_connection.php';

    // Consultar los datos de los clientes y sus pedidos
    $sql = "SELECT clientes.nombre, clientes.email FROM clientes";
    $result = $conn->query($sql);

    // Mostrar los resultados en una tabla HTML
    echo "<div id='container'> <table border='1'>
<tr>
<th>Nombre</th>
<th>Email</th>
<th>Controles</th>
</tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
<td>" . $row["nombre"] . "</td>
<td>" . $row["email"] . "</td>
<td><a href='detalles.php?email=" . urlencode($row["email"]) . "'><button>Ver Detalles</button></a>
<a href='agregar_pedido.php?email=" . urlencode($row["email"]) . "'><button>Agregar Pedido</button></a>
<a href='eliminar_cliente.php?email=" . urlencode($row["email"]) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este cliente?\");'><button>Eliminar Cliente</button></a></td>
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