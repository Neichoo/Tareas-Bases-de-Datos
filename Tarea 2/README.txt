Nombre:
Ignacio Gómez G
Sebastián Muñoz G


Instrucciones:
· Descargar los archivos correspondientes y descargar el programa Xampp para poder lograr una correcta ejecución de la tarea.
· En la carpeta de la aplicación Xampp, se ingresa a la subcarpeta "htdocs", se crea una nueva carpeta dentro, que puede ser por
ejemplo: "TareaBDD". Dentro irán las carpetas "PHP", "CSS", "IMG", "JS" y el README.txt
· Luego se abre el panel de control de Xampp, se debe clickear en "Start" para "Apache" y "MySQL"
· Después se ingresa a la vista de admin de MySQL con: "http://localhost/phpmyadmin/" o clickeando "Admin" en el panel de control
de Xampp,  seguido a esto, se debe importar la base de datos. Una vez importada se pueden revisar las tablas, entre otras cosas.
· Posteriormente se procede a ingresar a las páginas web, usando el formato "http://localhost/NombreCarpeta/NombreArchivo.php",
se recomienda iniciar la vista en la página "Inicio.php", ya que como lo indica el nombre, es el inicio.

Supuestos Utilizados:
· Una habitación no puede estar reservada más de una vez al mismo tiempo, esto para garantizar que, si el cliente quiere cambiar
su fecha de check-out a una posterior a la que tiene actualmente, se pueda realizar sin problemas y se pueda extender todo lo que necesite.
· Los trabajadores del hotel, si ven que no hay una habitación reservada, no intentarán editar ni eliminar reservas. Tampoco intentarán eliminar 
tours de habitaciones que no están reservadas en el hotel. 
· Los trabajadores del hotel, al realizar el checkout, no pondrán una fecha anterior a la del check in.
· Los trabajadores del hotel, al realizar el registro de la habitación, no pondrán una fecha de check out anterior a la del check in.
· Los trabajadores del hotel, no intentarán registrar nuevamente una habitación en el mismo tour que se encuentran registrados.

Incluimos en la base de datos:
Procedimiento almacenado: Usado en el archivo "Tours.php" en la línea 45
Vista: Usado en el archivo "Checkout.php" en la línea 155
Vista: Usado en el archivo "Reporteria.php" en la línea 32
Function: Usado en el archivo "Checkout.php" en la línea
Trigger(s): Usado en la tabla "reservas_tour"

 
