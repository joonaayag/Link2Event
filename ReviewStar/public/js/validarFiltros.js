document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('filterButton').addEventListener('click', validarFormulario);
});

function validarFormulario(event) {
    // Evitar que el formulario se envíe si hay errores
    let mensajes_error = document.querySelectorAll('.mensaje-error');
    mensajes_error.forEach(mensaje => mensaje.remove());

    let marcos_rojos = document.querySelectorAll('.borde-error');
    marcos_rojos.forEach(marco => marco.classList.remove('borde-error'));

    let marcos_verdes = document.querySelectorAll('.borde-correcto');
    marcos_verdes.forEach(marco => marco.classList.remove('borde-correcto'));

    // Obtener los campos
    let nombre = document.getElementById('nombre');
    let ciudad = document.getElementById('ciudad');
    let fecha_desde = document.getElementById('fecha_desde');
    let fecha_hasta = document.getElementById('fecha_hasta');
    let genero = document.getElementById('genero');
    let precio_min = document.getElementById('precio_min');
    let precio_max = document.getElementById('precio_max');

    let valido = true;

    // Validar nombre
    if (nombre.value.trim() === "") {
        mostrarError(nombre, "El nombre del evento es obligatorio");
        valido = false;
    } else {
        nombre.classList.add('borde-correcto');
    }

    // Validar ciudad
    if (ciudad.value.trim() === "") {
        mostrarError(ciudad, "La ciudad es obligatoria");
        valido = false;
    } else {
        ciudad.classList.add('borde-correcto');
    }

    // Validar fechas
    if (fecha_desde.value.trim() === "") {
        mostrarError(fecha_desde, "La fecha de inicio es obligatoria");
        valido = false;
    } else {
        fecha_desde.classList.add('borde-correcto');
    }

    if (fecha_hasta.value.trim() === "") {
        mostrarError(fecha_hasta, "La fecha de fin es obligatoria");
        valido = false;
    } else {
        fecha_hasta.classList.add('borde-correcto');
    }

    // Validar género
    if (genero.value === "") {
        mostrarError(genero, "Debe seleccionar un género");
        valido = false;
    } else {
        genero.classList.add('borde-correcto');
    }

    // Validar precio mínimo
    if (precio_min.value.trim() !== "" && isNaN(precio_min.value)) {
        mostrarError(precio_min, "El precio mínimo debe ser un número");
        valido = false;
    } else if (parseFloat(precio_min.value) < 0) {
        mostrarError(precio_min, "El precio mínimo no puede ser negativo");
        valido = false;
    } else {
        precio_min.classList.add('borde-correcto');
    }

    // Validar precio máximo
    if (precio_max.value.trim() !== "" && isNaN(precio_max.value)) {
        mostrarError(precio_max, "El precio máximo debe ser un número");
        valido = false;
    } else if (parseFloat(precio_max.value) < 0) {
        mostrarError(precio_max, "El precio máximo no puede ser negativo");
        valido = false;
    } else {
        precio_max.classList.add('borde-correcto');
    }

    // Si no es válido, prevenir el envío del formulario
    if (!valido) {
        event.preventDefault();
    }
}

function mostrarError(elemento, mensaje) {
    // Mostrar el error debajo del campo
    elemento.classList.add('borde-error');
    let mensaje_error = document.createElement('small');
    mensaje_error.textContent = mensaje;
    mensaje_error.classList.add('mensaje-error');
    elemento.parentElement.appendChild(mensaje_error);
}
