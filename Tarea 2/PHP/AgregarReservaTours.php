<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "hotel_la_diversion";
$flag = false;
$conn = new mysqli($server, $user, $pass, $db);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    if(isset($_POST["buscar_reserva"])) {
        $num_habitacion_buscar = $_POST["buscar_num_habitacion"];
        $sql_busqueda_rh = "SELECT * FROM reservas_habitacion WHERE num_habitacion = $num_habitacion_buscar";
        $result_busqueda_rh = $conn->query($sql_busqueda_rh);
        $mensaje_rh = "";
        if ($result_busqueda_rh->num_rows > 0) {
            while($row = $result_busqueda_rh->fetch_assoc()) {
                $mensaje_rh ='<div class="exito">Está reservada la habitación número: ' . $row["num_habitacion"];
                $flag = true;
            }
        } else {
            $mensaje_rh = '<div class="error">No está reservada la habitación número: ' . $num_habitacion_buscar;
        }

        $sql_busqueda_rt = "SELECT * FROM reservas_tour WHERE num_habitacion = $num_habitacion_buscar";
        $result_busqueda_rt = $conn->query($sql_busqueda_rt);
        $contador = 0;
        if($flag == true){
            if ($result_busqueda_rt->num_rows > 0) {
                $mensaje_rt = '<br>ID de tour(s) a los que está asociada la habitación actualmente: ';
                $reservas_totales = "";
                while($row = $result_busqueda_rt->fetch_assoc()) {
                    if($contador >= 1){
                        $reservas_totales .= ", ";
                    }
                    $reservas_totales .= (string)$row["id_tour"];
                    $contador += 1;
                }
                echo $mensaje_rh . $mensaje_rt . $reservas_totales . '<br></div>';
            } else {
                echo $mensaje_rh . '<br>Se pueden registrar tours.' . '</div>';
            }
        }
        else{
            echo $mensaje_rh . '<br>No se pueden registrar tours.' . '</div>';
        }
    }
    if(isset($_POST["reservar_tour"])) {
        $num_habitacion = $_POST["num_habitacion"];
        $id_tour = $_POST["id_tour"];
        $sql = "INSERT INTO reservas_tour (id_tour, num_habitacion) 
        VALUES ('$id_tour', '$num_habitacion')";
        $result_busqueda = $conn->query($sql);
        if ($result_busqueda === TRUE) {
            echo '<div class="exito">Reserva realizada con éxito</div>';
        } else {
            echo '<div class="error">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hotel La Diversión</title>
    <link rel="stylesheet" href="../CSS/Navbar.css"> 
    <link rel="stylesheet" href="../CSS/Inicio.css">
    <link rel="stylesheet" href="../CSS/EditarReserva.css">
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="num_habitacion"><br>Número de Habitación:</label>
            <input type="number" id="num_habitacion" name="num_habitacion" min="1" max="1200" oninput="limitarNumeroHabitacion(this)" required>
            <label for="id_tour">Número del Tour:</label>
            <input type="number" id="id_tour" name="id_tour" min="1" max="7" required>
            <button type="submit" name="reservar_tour">Reservar Tour</button>
        </form>
    </div>
    <br>
    <br>
    <br>
</body>
</html>