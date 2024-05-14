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
                echo '<div class="error">Ya está reservada la habitación número: ' . $row["num_habitacion"] . '</div>';
            }
        } else {
            echo '<div class="exito">No se encontraron reservas para la habitación número: ' . $num_habitacion_buscar . '</div>';
        }
    } elseif(isset($_POST["rut_huesped"], $_POST["num_habitacion"], $_POST["fecha_check_in"], $_POST["fecha_check_out"], $_POST["tipo_habitacion"])) {
        $rut_huesped = $_POST["rut_huesped"];
        $num_habitacion = $_POST["num_habitacion"];
        $fecha_check_in = $_POST["fecha_check_in"];
        $fecha_check_out = $_POST["fecha_check_out"];
        $tipo_habitacion = $_POST["tipo_habitacion"];
        $sql = "INSERT INTO reservas_habitacion (rut_huesped, num_habitacion, fecha_check_in, fecha_check_out, tipo_habitacion) 
                VALUES ('$rut_huesped', '$num_habitacion', '$fecha_check_in', '$fecha_check_out', '$tipo_habitacion')";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="exito">Reserva realizada con éxito</div>';
        } else {
            echo '<div class="error">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hotel La Diversión</title>
    <link rel="stylesheet" href="../CSS/Navbar.css"> 
    <link rel="stylesheet" href="../CSS/Inicio.css">
    <link rel="stylesheet" href="../CSS/AgregarReserva.css">
    <script src="../JS/AgregarReserva.js" defer></script>
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
    </div>
    <div class="Form">
        <h2>Reservar Habitación</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="rut_huesped">RUT Huesped (8 primeros dígitos):</label>
            <input type="number" id="rut_huesped" name="rut_huesped" min="10000000" max="99999999" oninput="limitarRut(this)" required>
            <br>
            <label for="num_habitacion">Número de Habitación:</label>
            <input type="number" id="num_habitacion" name="num_habitacion" min="1" max="1200" oninput="limitarNumeroHabitacion(this)" required>
            <br>
            <label for="fecha_check_in">Fecha de Check-in:</label>
            <input type="date" id="fecha_check_in" name="fecha_check_in" required>
            <br>
            <label for="fecha_check_out">Fecha de Check-out:</label>
            <input type="date" id="fecha_check_out" name="fecha_check_out" required>
            <br>
            <label for="tipo_habitacion">Tipo de Habitación:</label>
            <select id="tipo_habitacion" name="tipo_habitacion" required>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="King">King</option>
            </select>
            <br>
            <input type="submit" value="Reservar">
        </form>
    </div>
    <br>
    <br>
    <br>
</body>
</html>