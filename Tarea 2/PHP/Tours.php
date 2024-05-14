<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hotel La Diversión</title>
    <link rel="stylesheet" href="../CSS/Navbar.css"> 
    <link rel="stylesheet" href="../CSS/EditarReserva.css">
    <link rel="stylesheet" href="../CSS/Inicio.css">
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
        <h1>Ingrese ID del Tour:</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="number" name="id_tour" min="1" max="7" required>
            <button type="submit" name="buscar_tour">Buscar</button>
        </form>
    </div>
    <?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "hotel_la_diversion";
    $conn = new mysqli($server, $user, $pass, $db);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["buscar_tour"])) {
            $t1 = 'La hora de inicio es a las 09:00 horas y la hora de retorno estimada al hotel es a las 17:30 horas.<br>Únete a nosotros en una emocionante aventura en el impresionante Fiordo de Reloncaví, donde tendrás la oportunidad de presenciar de cerca la majestuosidad de las ballenas en su hábitat natural. Embarcaremos en una cómoda embarcación y nos adentraremos en las aguas cristalinas de este fiordo, rodeados por imponentes paisajes montañosos y exuberante vegetación.<br>Durante el recorrido, tendrás la oportunidad única de avistar ballenas jorobadas, orcas y otras especies de cetáceos que habitan estas aguas. Nuestro equipo de guías expertos estará a tu disposición para brindarte información sobre la vida marina local y responder a todas tus preguntas.<br>Prepárate para vivir una experiencia inolvidable mientras te sumerges en la belleza natural del Fiordo de Reloncaví y te maravillas con la fascinante vida marina que habita en estas aguas. No olvides tu cámara para capturar momentos inolvidables de este emocionante avistamiento de ballenas. ¡Te esperamos para una aventura única e inolvidable en Los Lagos, Chile!';
            $t2 = 'La hora de inicio es a las 08:00 horas y la hora de retorno estimada al hotel es a las 18:00 horas.<br>Desde el bus, hasta que se llegue al puerto, en donde se encuentra el Catamarán, transcurrirán 1 hora y 30 minutos, luego el resto del viaje es en Catamarán, una vez a bordo, se les indicarán todas las instrucciones de seguridad.<br>A bordo podrán disfrutar ya sea sentados, o cuando la tripulación lo indique, parados en la cubierta superior o inferior, de todas las vistas panorámicas del lago y los majestuosos picos montañosos que lo rodean.<br>Dentro del catamarán tendrán una cafetería en donde podrán comprar sándwiches, queques, muffins o pasteles, y para beber cafés, bebidas gaseosas o algunas bebidas alcohólicas con hielos de la zona.<br>A medida que se avance se podrán ver distintas construcciones antiguas y animales de la zona, posteriormente se dará tiempo para que la gente baje, tendrás tiempo para explorar los alrededores, realizar caminatas o simplemente relajarte en la orilla del lago y disfrutar de la tranquilidad del entorno natural.<br> Importante!! Se tiene que estar de vuelta en el Catamarán a las 14:30 horas. ';
            $t3 = 'La hora de inicio es a las 08:30 horas y la hora de retorno estimada al hotel es a las 16:00 horas.<br>Prepárate para una experiencia inolvidable mientras nos aventuramos en el corazón del Bosque Lagunas del Sur. Partiendo temprano en la mañana, te embarcarás en un emocionante viaje a bordo de un Jeep 4x4, diseñado para andar por los terrenos más desafiantes.<br>A medida que nos adentramos en el bosque, seremos testigos de la asombrosa diversidad de flora y fauna que habita esta región. Desde majestuosos árboles centenarios hasta algunas lagunas escondidas, cada rincón del bosque revela una nueva maravilla por descubrir, también habrán encuentros con diversos animales de la zona.<br>Durante nuestro recorrido, tendremos la oportunidad de detenernos en puntos estratégicos para disfrutar de vistas panorámicas impresionantes y capturar fotografías memorables. También cuenta con un asistente el cual irá narrando acerca de la flora y fauna del lugar.<br>Se disfrutará de un delicioso almuerzo estilo picnic en un entorno natural, donde podrás recargar energías rodeado de la tranquilidad del bosque.<br>Se recomienda llevar ropa que se pueda mojar! Se pasa terrenos en donde salpica mucha agua.';
            $t4 = 'La hora de inicio es a las 10:00 horas y la hora de retorno estimada al hotel es a las 19:00 horas.<br>Embárcate en una experiencia emocionante mientras nos aventuramos en las turbulentas aguas del Río Los Papus. Desde emocionantes rápidos hasta paisajes impresionantes, este tour te llevará a través de una de las rutas de rafting más emocionantes de la región.<br>Comenzaremos nuestro viaje temprano en la mañana desde el Hotel La Diversión, en un cómodo autobús que nos llevará hasta el punto de partida en el Río Los Papus. Una vez allí, te equiparemos con todo el equipo necesario y recibirás una sesión informativa sobre seguridad y técnicas de remo.<br>Entonces, subiremos a nuestras balsas inflables y nos aventuraremos en el río, enfrentando emocionantes rápidos y disfrutando de la emoción de navegar por aguas turbulentas. Con la guía de nuestros expertos instructores de rafting, navegarás por los rápidos más desafiantes mientras disfrutas de las impresionantes vistas del paisaje circundante.<br>Durante el recorrido, tendremos la oportunidad de detenernos en lugares pintorescos para disfrutar de un refrescante chapuzón en las aguas cristalinas del río y admirar la belleza natural que nos rodea.<br>Después de una emocionante jornada en el río, regresaremos al hotel con corazones llenos de emociones y recuerdos inolvidables de esta aventura de rafting en el Río Los Papus.';
            $t5 = 'La hora de inicio es a las 08:00 horas y la hora de retorno estimada al hotel es a las 17:00 horas.<br>Prepárate para un encuentro inolvidable con los adorables pingüinos en la maravillosa Isla Pingu-Isla. Partiendo temprano en la mañana desde el Hotel La Diversión, nos embarcaremos en un cómodo autobús que nos llevará al puerto, donde nos espera una emocionante travesía en lancha.<br>Navegaremos a través de las aguas cristalinas hacia la Isla Pingu-Isla, hogar de una gran variedad de especies de pingüinos. A medida que nos acercamos a la isla, podrás admirar la belleza natural de sus costas escarpadas y sus playas de arena blanca.<br>Una vez en la isla, desembarcaremos y seremos recibidos por un guía local que nos llevará a explorar los diversos hábitats de los pingüinos. Tendrás la oportunidad de observar a estas fascinantes aves mientras nadan en el mar, juegan en la playa y cuidan de sus crías.<br>Durante la visita, aprenderás sobre la vida y el comportamiento de los pingüinos, así como sobre los esfuerzos de conservación para proteger su hábitat. También tendrás tiempo para explorar la isla por tu cuenta, tomar fotografías y disfrutar de la belleza natural que te rodea.<br>Después de una experiencia inolvidable en la Isla Pingu-Isla, regresaremos al hotel con corazones llenos de recuerdos felices y la satisfacción de haber presenciado la belleza de la vida salvaje en su estado más puro.';
            $t6 = 'La hora de inicio es a las 09:00 horas y la hora de retorno estimada al hotel es a las 14:00 horas.<br>Embárcate en una emocionante aventura a través del Sendero La Diversión, un refugio natural creado por los propietarios del hotel para aquellos que buscan una conexión más profunda con la naturaleza. Este sendero serpentea a través de exuberantes bosques, arroyos cristalinos y paisajes pintorescos, ofreciendo una experiencia de senderismo única en la región.<br>Partiendo desde el Hotel La Diversión, comenzaremos nuestra caminata temprano en la mañana, guiados por expertos locales que conocen cada rincón del sendero. A medida que avanzamos, seremos testigos de la diversidad de la flora y fauna que habita este hermoso entorno natural.<br>El Sendero La Diversión ofrece una variedad de terrenos, desde suaves colinas hasta empinadas pendientes, lo que lo convierte en el lugar perfecto para aventurarse y explorar. Durante nuestra caminata, tendremos la oportunidad de detenernos en puntos estratégicos para admirar las impresionantes vistas panorámicas y capturar fotografías memorables.<br>Además, aprenderemos sobre la historia y la ecología del área mientras exploramos las antiguas ruinas y descubrimos los secretos que se esconden en los rincones más remotos del sendero. También disfrutaremos de un delicioso almuerzo picnic en un entorno natural, donde podremos recargar energías rodeados de la tranquilidad del bosque.';
            $t7 = 'La hora de inicio es a las 07:30 horas y la hora de retorno estimada al hotel es a las 19:30 horas.<br>Únete a nosotros en un viaje hacia la serenidad y el rejuvenecimiento en las hermosas Termas de Puyuhuapi. Situadas en un entorno natural de belleza incomparable, estas aguas termales te invitan a sumergirte en un oasis de relajación y bienestar.<br>Partiremos en autobús hacia este idílico destino, atravesando paisajes pintorescos y exuberantes bosques. Una vez allí, nos embarcaremos en una tranquila lancha que nos llevará a través de las aguas cristalinas de la región, brindándonos vistas impresionantes de los fiordos y montañas que nos rodean.<br>Al llegar a las Termas de Puyuhuapi, tendrás tiempo para disfrutar de sus piscinas termales al aire libre, alimentadas por las cálidas aguas subterráneas que emanan de las profundidades de la tierra. Sumérgete en las piscinas y deja que el calor te envuelva mientras te relajas y renuevas cuerpo y mente.<br>Además de las aguas termales, tendrás la oportunidad de explorar los alrededores a tu propio ritmo, caminando por senderos naturales, observando la flora y fauna local, o simplemente disfrutando de la tranquilidad y belleza del entorno.';
            $tour_id = $_POST["id_tour"];
            //Procedimiento Almacenado
            $sql = "CALL ObtenerDetallesTour($tour_id)";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="FormB">';
                    echo "<p><b>Tour ID:</b> " . $row["id_tour"]. "</p>";
                    echo "<p><b>Fecha:</b> " . $row["fecha"]. "</p>";
                    echo "<p><b>Lugar:</b> " . $row["lugar"]. "</p>";
                    echo "<p><b>Medio de Transporte:</b> " . $row["medio_transporte"]. "</p>";
                    switch($tour_id){
                        case 1:
                            echo "<p class='textos'><b>Descripción:</b> " . $t1 . "</p>";
                            break;
                        case 2:
                            echo "<p class='textos'><b>Descripción:</b> " . $t2 . "</p>";
                            break;
                        case 3:
                            echo "<p class='textos'><b>Descripción:</b> " . $t3 . "</p>";
                            break;
                        case 4:
                            echo "<p class='textos'><b>Descripción:</b> " . $t4 . "</p>";
                            break;
                        case 5:
                            echo "<p class='textos'><b>Descripción:</b> " . $t5 . "</p>";
                            break;
                        case 6:
                            echo "<p class='textos'><b>Descripción:</b> " . $t6. "</p>"; 
                            break;
                        case 7:
                            echo "<p class='textos'><b>Descripción:</b> " . $t7 . "</p>"; 
                            break;
                        default:
                            break;
                    } 
                    echo '<img src="../IMG/' . $row["imagen_ref"] . '" alt="Imagen del Tour" style="max-width: 340px; height:auto;">';
                    echo '</div>';
                }
            } else {
                echo "No se encontraron tours con el ID proporcionado.";
            }
        }
    }
    ?>
</body>
</html>
