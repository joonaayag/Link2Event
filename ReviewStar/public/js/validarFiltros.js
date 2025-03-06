document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('filterButton').addEventListener('click', validarFormulario);
});

function validarFormulario(event) {
    // Eliminar mensajes de error previos y estilos
    document.querySelectorAll('.mensaje-error').forEach(mensaje => mensaje.remove());
    document.querySelectorAll('.borde-error, .borde-correcto').forEach(el => el.classList.remove('borde-error', 'borde-correcto'));

    // Obtener los campos
    let fecha_desde = document.getElementById('fecha_desde');
    let fecha_hasta = document.getElementById('fecha_hasta');
    let precio_min = document.getElementById('precio_min');
    let precio_max = document.getElementById('precio_max');

    let valido = true;
    let hoy = new Date();
    hoy.setHours(0, 0, 0, 0); // Eliminar la hora para comparar solo fechas

    // Validar fecha de inicio (si está ingresada)
    if (fecha_desde.value.trim() !== "") {
        let fechaInicio = new Date(fecha_desde.value);
        if (fechaInicio < hoy) {
            mostrarError(fecha_desde, "La fecha de inicio debe ser mayor o igual a la actual");
            valido = false;
        } else {
            fecha_desde.classList.add('borde-correcto');
        }
    }

    // Validar fecha de fin (si ambas fechas están ingresadas)
    if (fecha_desde.value.trim() !== "" && fecha_hasta.value.trim() !== "") {
        let fechaInicio = new Date(fecha_desde.value);
        let fechaFin = new Date(fecha_hasta.value);

        if (fechaFin <= fechaInicio) {
            mostrarError(fecha_hasta, "La fecha de fin debe ser mayor que la fecha de inicio");
            valido = false;
        } else {
            fecha_hasta.classList.add('borde-correcto');
        }
    }

    // Validar precios (si están ingresados)
    let precioMinNum = parseFloat(precio_min.value);
    let precioMaxNum = parseFloat(precio_max.value);

    if (precio_min.value.trim() !== "") {
        if (isNaN(precioMinNum) || precioMinNum < 0) {
            mostrarError(precio_min, "El precio mínimo debe ser un número positivo");
            valido = false;
        } else {
            precio_min.classList.add('borde-correcto');
        }
    }

    if (precio_max.value.trim() !== "") {
        if (isNaN(precioMaxNum) || precioMaxNum < 0) {
            mostrarError(precio_max, "El precio máximo debe ser un número positivo");
            valido = false;
        } else {
            precio_max.classList.add('borde-correcto');
        }
    }

    // Si ambos precios están ingresados, validar que el máximo sea mayor o igual al mínimo
    if (precio_min.value.trim() !== "" && precio_max.value.trim() !== "") {
        if (precioMaxNum < precioMinNum) {
            mostrarError(precio_max, "El precio máximo debe ser mayor o igual al mínimo");
            valido = false;
        }
    }

    // Si hay errores, prevenir el envío del formulario
    if (!valido) {
        event.preventDefault();
    }
}

function mostrarError(elemento, mensaje) {
    elemento.classList.add('borde-error');
    let mensaje_error = document.createElement('small');
    mensaje_error.textContent = mensaje;
    mensaje_error.classList.add('mensaje-error');
    elemento.parentElement.appendChild(mensaje_error);
}
