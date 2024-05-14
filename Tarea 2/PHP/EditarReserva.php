<?php
function getFechasReservadas($numHabitacion) {
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "hotel_la_diversion";
    $conn = new mysqli($server, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $sql = "SELECT fecha_check_in, fecha_check_out FROM reservas_habitacion WHERE num_habitacion = $numHabitacion";
    $DiasDeHospedaje = 0;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $start_date = new DateTime($row['fecha_check_in']);
            $end_date = new DateTime($row['fecha_check_out']);
            $interval = new DateInterval('P1D'); // Intervalo de 1 día
            $date_range = new DatePeriod($start_date, $interval, $end_date);
            foreach ($date_range as $date) {
                $DiasDeHospedaje += 1;
            }
        }
    }
    $conn->close();
    return array($DiasDeHospedaje, $start_date, $end_date);
}

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
            $datos = getFechasReservadas($num_habitacion_buscar);
            $dias = $datos[0];
            $fecha_i = $datos[1]->format('Y-m-d');
            $fecha_f = $datos[2]->format('Y-m-d');
            while($row = $result_busqueda->fetch_assoc()) {
                echo '<div class="exito">Está reservada la habitación número: ' . $row["num_habitacion"] . '<br>Actualmente la reserva es de ' . $dias . ' días en total, con fecha de inicio "' . $fecha_i . '" y fecha final "' . $fecha_f . '".<br>Se pueden realizar cambios.' . '</div>';
            }
        } else {
            echo '<div class="error">No existe una reserva para la habitación número: ' . $num_habitacion_buscar . '</div>';
        }
    }
    if(isset($_POST["modificar_reserva"])) {
        $num_habitacion = $_POST["num_habitacion_original"];
        $nueva_num_habitacion = $_POST["nueva_num_habitacion"];
        $nueva_fecha_co = $_POST["nueva_fecha_co"];
        $sql_update = "UPDATE reservas_habitacion SET num_habitacion = $nueva_num_habitacion, fecha_check_out = '$nueva_fecha_co' WHERE num_habitacion = $num_habitacion";
        if ($conn->query($sql_update) === TRUE) {
            echo '<div class="exito">Reserva modificada con éxito.</div>';
        } else {
            echo '<div class="error">Error al modificar la reserva: ' . $conn->error . '</div>';
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
            <div class="modificar_reserva">
                <h2>Modificar Reserva</h2>
                    <label for="num_habitacion_original"><br>Número de habitación original:</label>
                    <input type="number" id="num_habitacion_original" name="num_habitacion_original" min="1" max="1200">
                    <label for="nueva_num_habitacion">Nuevo número de habitación:</label>
                    <input type="number" id="nueva_num_habitacion" name="nueva_num_habitacion" min="1" max="1200">
                    <label for="nueva_fecha_co">Nueva fecha de Check-out:</label>
                    <input type="date" id="nueva_fecha_co" name="nueva_fecha_co" >
                    <button type="submit" name="modificar_reserva">Modificar Reserva</button>
            </div>
        </form>
    </div>
    <br>
    <br>
    <br>
</body>
</html>

