window.addEventListener('load', inicio);

function inicio() {
    // Obtenemos los elementos del formulario
    document.getElementById("botonEditarPerfil").addEventListener("click", validarFormulario);
}

function validarFormulario(event) {
    let mensajes_error = document.querySelectorAll('.mensaje-error');
    mensajes_error.forEach(mensaje => mensaje.remove());

    let marcos_rojos = document.querySelectorAll(".borde-error");
    marcos_rojos.forEach(marco => marco.classList.remove("borde-error"));

    let marcos_verdes = document.querySelectorAll(".borde-correcto");
    marcos_verdes.forEach(marco => marco.classList.remove("borde-correcto"));

    let nombre = document.getElementById("nombre");
    let apellidos = document.getElementById("apellidos");
    let edad = document.getElementById("edad");
    let pais = document.getElementById("pais");
    let tipo_identificacion = document.getElementById("tipo_identificacion");
    let num_identificacion = document.getElementById("num_identificacion");
    let direccion = document.getElementById("direccion");
    let password = document.getElementById("password");
    let password_confirmation = document.getElementById("password_confirmation");

    let valido = true;

    // Validar nombre
    if (nombre.value.trim() === "") {
        nombre.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El nombre es obligatorio";
        mensaje_error.classList.add('mensaje-error');
        nombre.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (nombre.value.trim().length > 15) {
        nombre.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El nombre no puede tener más de 15 caracteres";
        mensaje_error.classList.add('mensaje-error');
        nombre.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        nombre.classList.add('borde-correcto');
    }

    // Validar apellidos
    if (apellidos.value.trim() === "") {
        apellidos.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Los apellidos son obligatorios";
        mensaje_error.classList.add('mensaje-error');
        apellidos.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (apellidos.value.trim().length > 30) {
        apellidos.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Los apellidos no pueden tener más de 30 caracteres";
        mensaje_error.classList.add('mensaje-error');
        apellidos.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        apellidos.classList.add("borde-correcto");
    }

    // Validar edad
    if (edad.value.trim() === "" || isNaN(edad.value) || edad.value < 18 || edad.value > 120) {
        edad.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Debes ingresar una edad entre 18 y 120";
        mensaje_error.classList.add('mensaje-error');
        edad.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        edad.classList.add("borde-correcto");
    }

    // Validar país
    let paises = JSON.parse(localStorage.getItem("paisesOrdenados")) || [];
    if (pais.value === "") {
        pais.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Debes seleccionar un país";
        mensaje_error.classList.add('mensaje-error');
        pais.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (!paises.includes(pais.value)) {
        pais.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El pais seleccionado no es válido";
        mensaje_error.classList.add('mensaje-error');
        pais.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        pais.classList.add("borde-correcto");
    }

    // Validar tipo identificación
    if (tipo_identificacion.value !== "DNI" && tipo_identificacion.value !== "NIE") {
        tipo_identificacion.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Selecciona DNI o NIE";
        mensaje_error.classList.add('mensaje-error');
        tipo_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        tipo_identificacion.classList.add("borde-correcto");
    }

    // Validar número identificación
    if (num_identificacion.value.trim() === "") {
        num_identificacion.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El número de identificación es obligatorio";
        mensaje_error.classList.add('mensaje-error');
        num_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (tipo_identificacion.value === "DNI" && !ValidarPatrones.validarDNI(num_identificacion.value)) {
        tipo_identificacion.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "DNI incorrecto";
        mensaje_error.classList.add('mensaje-error');
        num_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (tipo_identificacion.value === "NIE" && !ValidarPatrones.validarNIE(num_identificacion.value)) {
        tipo_identificacion.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "NIE incorrecto";
        mensaje_error.classList.add('mensaje-error');
        num_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        num_identificacion.classList.add("borde-correcto");
    }

    // Validar dirección
    if (direccion.value.trim() === "") {
        direccion.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "La dirección es obligatoria";
        mensaje_error.classList.add('mensaje-error');
        direccion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (direccion.value.trim().length > 100) {
        direccion.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "La dirección no puede tener más de 100 caracteres";
        mensaje_error.classList.add('mensaje-error');
        direccion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        direccion.classList.add("borde-correcto");
    }

    // Validar correo
    if (email.value.trim() === "" || !ValidarPatrones.validarEmail(email.value)) {
        email.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Formato de email incorrecto";
        mensaje_error.classList.add('mensaje-error');
        email.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (email.value.trim().length > 50) {
        email.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El email no puede tener más de 50 caracteres";
        mensaje_error.classList.add('mensaje-error');
        email.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        email.classList.add("borde-correcto");
    }

    // Validar contraseñas
    if (password.value.trim() !== "" || password_confirmation.value.trim() !== "") {
        if (password.value.trim() === "") {
            password.classList.add('borde-error');
            let mensaje_error = document.createElement('small');
            mensaje_error.textContent = "La contraseña no puede estar vacía";
            mensaje_error.classList.add('mensaje-error');
            password.parentElement.appendChild(mensaje_error);
            valido = false;
        } else if (password_confirmation.value.trim() === "") {
            password_confirmation.classList.add('borde-error');
            let mensaje_error = document.createElement('small');
            mensaje_error.textContent = "La confirmación de la contraseña no puede estar vacía";
            mensaje_error.classList.add('mensaje-error');
            password_confirmation.parentElement.appendChild(mensaje_error);
            valido = false;
        } else if (password.value.trim() !== password_confirmation.value.trim()) {
            password.classList.add('borde-error');
            password_confirmation.classList.add('borde-error');
            let mensaje_error = document.createElement('small');
            mensaje_error.textContent = "Las contraseñas no coinciden";
            mensaje_error.classList.add('mensaje-error');
            password_confirmation.parentElement.appendChild(mensaje_error);
            valido = false;
        } else if (password.value.trim().length < 6) {
            password.classList.add('borde-error');
            password_confirmation.classList.add('borde-error');
            let mensaje_error = document.createElement('small');
            mensaje_error.textContent = "La contraseña debe tener al menos 6 caracteres";
            mensaje_error.classList.add('mensaje-error');
            password_confirmation.parentElement.appendChild(mensaje_error);
            valido = false;
        } else {
            password.classList.add("borde-correcto");
            password_confirmation.classList.add("borde-correcto");
        }
    }

    if (!valido) {
        event.preventDefault();
    }
}
