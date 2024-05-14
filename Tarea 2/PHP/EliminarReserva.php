<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "hotel_la_diversion";
$conn = new mysqli($server, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if(isset($_POST["buscar_reserva"])) {
        $num_habitacion_buscar = $_POST["buscar_num_habitacion"];
        $sql_busqueda = "SELECT * FROM reservas_habitacion WHERE num_habitacion = $num_habitacion_buscar";
        $result_busqueda = $conn->query($sql_busqueda);
        if ($result_busqueda->num_rows > 0) {
            while($row = $result_busqueda->fetch_assoc()) {
                echo '<div class="exito">Está reservada la habitación número: ' . $row["num_habitacion"] . '<br>Es posible eliminar la reserva.' . '</div>';
            }
        } else {
            echo '<div class="error">No existe una reserva para la habitación número: ' . $num_habitacion_buscar . '<br>No hay nada que eliminar aquí.' . '</div>';
        }
    }
    if(isset($_POST["eliminar_reserva"])) {
        $num_habitacion = $_POST["num_habitacion"];
        $sql_delete = "DELETE FROM reservas_habitacion WHERE num_habitacion = $num_habitacion"; 
        if ($conn->query($sql_delete) === TRUE) {
            echo '<div class="exito">Reserva eliminada con éxito.</div>';
        } else {
            echo '<div class="error">Error al eliminar la reserva: ' . $conn->error . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hotel La Diversión</title>
    <link rel="stylesheet" href="../CSS/Navbar.css"> 
    <link rel="stylesheet" href="../CSS/Inicio.css">
    <link rel="stylesheet" href="../CSS/EditarReserva.css">
    <link rel="stylesheet" href="../CSS/EliminarReserva.css">
</head>

<body>
    <nav>
        <img src="../IMG/IconoHotel.png" alt="IconoHotel" class="IconoHotel">
        <span class="nombreHotel">La Diversión</span>
        <ul>
            <li><a href="Inicio.php">Inicio</a></li>
            <li><a href="GestionReservas.php">Reservas</a></li>
            <li><a href="GestionTours.php">Tours</a></li>
            <li><a href="Checkout.php">Checkout</a></li>
            <li><a href="Reporteria.php">Reportería</a></li>
        </ul>
    </nav>
    <div class="FormB">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="Busqueda">
                <h2>Búsqueda de reserva por habitación</h2>
                <label for="buscar_num_habitacion">Buscar por número de habitación:</label>
                <input type="number" id="buscar_num_habitacion" name="buscar_num_habitacion" min="1" max="1200">
                <button type="submit" name="buscar_reserva">Buscar Reserva</button>
            </div>
        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="num_habitacion"><br>Número de habitación a la cual se le desea eliminar la reserva actual:</label>
            <input type="number" id="num_habitacion" name="num_habitacion" min="1" max="1200">
            <button type="submit" name="eliminar_reserva">Eliminar Reserva</button>
        </form>
            
    </div>
    <br>
    <br>
    <br>
</body>
</html>