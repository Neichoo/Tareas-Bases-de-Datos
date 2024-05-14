<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "hotel_la_diversion";
$conn = new mysqli($server, $user, $pass, $db);
function EsHoraDePagar($num_habitacion, $fecha_checkout){
    $end_date = new DateTime($fecha_checkout);
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "hotel_la_diversion";
    $conn = new mysqli($server, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $sql = "SELECT fecha_check_in, fecha_check_out, tipo_habitacion FROM reservas_habitacion WHERE num_habitacion = $num_habitacion";
    $result = $conn->query($sql);
    $dias_totales = 0;
    $precio_total = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tipo_habitacion = $row['tipo_habitacion'];
            $start_date = new DateTime($row['fecha_check_in']);
            $interval = new DateInterval('P1D');
            $date_range = new DatePeriod($start_date, $interval, $end_date);
            foreach ($date_range as $date) {
                $dias_totales++;
            }
        }
    }
    $noches_totales = $dias_totales - 1;
    switch($tipo_habitacion){
        case 'Single':
            $precio_total += $noches_totales * 75000;
            break; 
        case 'Double':
            $precio_total += $noches_totales * 100000;
            break;  
        case 'King':
            $precio_total += $noches_totales * 125000; 
            break; 
        default:
        break;
    }
    $sql_reservas_tour = "SELECT id_tour FROM reservas_tour WHERE num_habitacion = $num_habitacion";
    $result_reservas_tour = $conn->query($sql_reservas_tour);
    if ($result_reservas_tour->num_rows > 0) {
        while ($row = $result_reservas_tour->fetch_assoc()) {
            $id_tour = $row['id_tour'];
            $sql_precio_tour = "SELECT precio_tour FROM tours WHERE id_tour = $id_tour";
            $result_precio_tour = $conn->query($sql_precio_tour);
            if ($result_precio_tour->num_rows > 0) {
                $row_precio_tour = $result_precio_tour->fetch_assoc();
                $precio_tour = $row_precio_tour['precio_tour'];
                $precio_total += $precio_tour;
            }
        }
    }
    return ($precio_total);
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
            <h2>Ingrese los siguientes datos para el Checkout</h2>
            <label for="num_habitacion">Número de habitación:</label>
            <input type="number" id="num_habitacion" name="num_habitacion" min="1" max="1200" required>
            <label for="fecha_checkout">Fecha del Checkout:</label>
            <input type="date" id="fecha_checkout" name="fecha_checkout" required>
            <br><br>
            <button type="submit" name="calcular_total">Calcular Total</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }
            if(isset($_POST["calcular_total"])) {
                $fecha_checkout = $_POST["fecha_checkout"];
                $num_habitacion = $_POST["num_habitacion"];
                $precio_total = EsHoraDePagar($num_habitacion, $fecha_checkout);
                echo '<p>Precio total a pagar: ' . $precio_total . '</p><br>';
            }
        }
        ?>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="fecha_checkout" value="<?php echo isset($_POST["fecha_checkout"]) ? $_POST["fecha_checkout"] : ''; ?>">
            <input type="hidden" name="num_habitacion" value="<?php echo isset($_POST["num_habitacion"]) ? $_POST["num_habitacion"] : ''; ?>">
            <button type="submit" name="detalles">Ver Detalles<br></button>
        </form>
        <?php
            if(isset($_POST["detalles"])) {
                $fecha_checkout = $_POST['fecha_checkout'];
                $mensaje_checkout = "Fecha realización Checkout:" . $fecha_checkout . "<br>";
                $mensaje = "";
                $mensaje_tours = "";
                $num_habitacion = $_POST["num_habitacion"];
                $contador_tours = 0;
                $sql_contador_tours = "SELECT total_tours FROM reservas_habitacion WHERE num_habitacion = $num_habitacion";
                $result_contador_tours = $conn->query($sql_contador_tours);
                if ($result_contador_tours->num_rows > 0) {
                    $row = $result_contador_tours->fetch_assoc();
                    $contador_tours = $row['total_tours'];
                    }
                //Vista
                $sql = "SELECT * FROM vista_total_habitacion WHERE num_habitacion = $num_habitacion";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                            $mensaje = "Fecha Check-In: " . $row['fecha_check_in'] . "<br>" . "Fecha Check-Out: " . $row['fecha_check_out'] . "<br>" . "Tipo de Habitación: " . $row['tipo_habitacion'] . "<br>";
                            if($contador_tours >= 1){
                                $mensaje_tours .= "ID del Tour: " . $row['id_tour'] . "<br>" . "Precio del Tour: " . $row['precio_tour'] . "<br>";
                            } elseif($contador_tours == 0){
                                $mensaje_tours = "";
                            }
                    }
                    $mensaje_f = $mensaje . $mensaje_tours . "<hr>";
                    echo $mensaje_checkout . $mensaje_f;
                } else {
                    echo "No se encontraron detalles de la habitación.";
                }
            }
        ?>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="num_habitacion" value="<?php echo isset($_POST["num_habitacion"]) ? $_POST["num_habitacion"] : ''; ?>">
            <input type="hidden" name="fecha_checkout" value="<?php echo isset($_POST["fecha_checkout"]) ? $_POST["fecha_checkout"] : ''; ?>">
            <label for="calificacion">Calificación (0-10):</label>
            <input type="number" id="calificacion" name="calificacion" min="0" max="10" required>
            <button type="submit" name="finalizar_checkout">Finalizar Checkout</button>
        </form>
        <?php
            if(isset($_POST["finalizar_checkout"])) {
                $calificacion = $_POST["calificacion"];
                $num_habitacion = $_POST["num_habitacion"]; 
                $fecha_checkout = $_POST["fecha_checkout"];
                $sql_calcular_precio_tours = "SELECT calcular_precio_total_tours($num_habitacion) AS precio_tours";
                $result_calcular_precio_tours = $conn->query($sql_calcular_precio_tours);
                if ($result_calcular_precio_tours) {
                    $row = $result_calcular_precio_tours->fetch_assoc();
                    $ganadoConTours = $row['precio_tours'];
                }
                $sql = "INSERT INTO calificacion_habitaciones (num_habitacion, fecha_checkout, calificacion, dinero_de_tours) 
                VALUES ('$num_habitacion', '$fecha_checkout', '$calificacion', '$ganadoConTours')";
                if ($conn->query($sql) === TRUE) {
                    echo 'Calificación guardada exitosamente!';
                } else {
                    echo '<div class="error">Error: ' . $sql . '<br>' . $conn->error . '</div>';
                }
                $sql_delete = "DELETE FROM reservas_habitacion WHERE num_habitacion = $num_habitacion"; 
                if ($conn->query($sql_delete) === TRUE) {
                    echo '<div class="exito">Checkout realizado con éxito.</div>';
                } else {
                    echo '<div class="error">Error al realizar el Checkout: ' . $conn->error . '</div>';
                }
            }
        ?>
    </div>
    <br>
    <br>
    <br>
</body>
</html>
