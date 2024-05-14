<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hotel La Diversión</title>
    <link rel="stylesheet" href="../CSS/Navbar.css"> 
    <link rel="stylesheet" href="../CSS/Inicio.css">
    <link rel="stylesheet" href="../CSS/GestionReservas.css">
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
    <h1>Gestión de Reservas - Hotel La Diversión</h1>
    <h2>Acciones:</h2>
    <button class="agregar" onclick="location.href='AgregarReserva.php'">Agregar Reserva de Habitación</button>
    <button class="editar" onclick="location.href='EditarReserva.php'">Editar Reserva de Habitación</button>
    <button class="eliminar" onclick="location.href='EliminarReserva.php'">Eliminar Reserva de Habitación</button>
</body>