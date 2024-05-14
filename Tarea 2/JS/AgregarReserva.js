function limitarRut(input) {
    if (input.value.length >= 8) {
        input.value = input.value.slice(0, 8);
    }
}

function limitarNumeroHabitacion(input) {
    if (input.value.length >= 4) {
        input.value = input.value.slice(0, 4);
    }
}

function mostrarAlertaExito() {
    alert("Reserva realizada con éxito");
}

function mostrarAlertaError(mensaje) {
    alert(mensaje);
}
