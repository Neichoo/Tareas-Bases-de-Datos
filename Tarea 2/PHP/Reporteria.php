<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hotel La Diversión</title>
    <link rel="stylesheet" href="../CSS/Navbar.css"> 
    <link rel="stylesheet" href="../CSS/Reporteria.css">
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
        <?php
        $server = "localhost";
        $user = "root";
        $pass = "";
        $db = "hotel_la_diversion";
        $conn = new mysqli($server, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        //View
        $sql = "SELECT * FROM vista_calificaciones_promedio";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="FormB">Número de habitación: ' . $row["num_habitacion"]. " - Promedio de calificación: " . $row["promedio_calificacion"]. "</div>" . "<br>";
            }
        } else {
            echo '<div class="FormB">No hay resultados' . "</div>";
        }
        ?>
        <div class="FormB">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="num_habitacion"><br>Número de Habitación:</label>
            <input type="number" id="num_habitacion" name="num_habitacion" min="1" max="1200" required>
            <button type="submit" name="ver_detalles">Ver Detalles</button>
        </div>
        <?php
        if(isset($_POST["ver_detalles"])) {
            $num_habitacion = $_POST["num_habitacion"];
            $sql_ind = "SELECT num_habitacion, calificacion, fecha_checkout, dinero_de_tours FROM calificacion_habitaciones WHERE num_habitacion = $num_habitacion"; // Cambia el nombre de la tabla según corresponda
            $result_ind = $conn->query($sql_ind);
            if ($result_ind->num_rows > 0) {
                while($row = $result_ind->fetch_assoc()) {
                    echo '<div class="FormB">' . "Numero de habitación: " . $row["num_habitacion"] . " / Calificación: " . $row["calificacion"]. " / Fecha de Checkout: " . $row["fecha_checkout"]. " / Total de dinero de tours: " . $row["dinero_de_tours"]. "</div>";
                }
            }
        }
        $conn->close();
        ?>
    

</body>
</html>
