window.addEventListener('load', inicio);

function inicio() {
    // Obtenemos los elementos del formulario
    document.getElementById("botonRegistrarse").addEventListener("click", validarFormulario);
}

function validarFormulario(event) {
    //Aquí recojo todos los mensajes de error si los hay
    let mensajes_error = document.querySelectorAll('.mensaje-error');
    //Voy pasando por todos los mensajes y los borro
    mensajes_error.forEach(mensaje => {
        mensaje.remove();
    });

    //Hago lo mismo con la clase del borde error
    let marcos_rojos = document.querySelectorAll(".borde-error");

    marcos_rojos.forEach(marco => {
        marco.classList.remove("borde-error");
    });

    let marcos_verdes = document.querySelectorAll(".borde-correcto");
    marcos_verdes.forEach(marco => {
        marco.classList.remove("borde-correcto");
    });

    let nombre = document.getElementById("nombre");
    let apellidos = document.getElementById("apellidos");
    let edad = document.getElementById("edad");
    let pais = document.getElementById("pais");
    let tipo_identificacion = document.getElementById("tipo_identificacion");
    let num_identificacion = document.getElementById("num_identificacion");
    let direccion = document.getElementById("direccion");
    let password = document.getElementById("password");
    let password_confirmation = document.getElementById("password_confirmation");

    //Hago un booleano y de momento digo que es válido
    let valido = true;

    //Validar nombre
    if (nombre.value.trim() === "") {
        nombre.classList.add('borde-error'); //Pongo borde rojo al input
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El nombre es obligatorio";
        mensaje_error.classList.add('mensaje-error'); // pongo el texto de error rojo

        // Inserto el mensaje debajo del input
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

    //Validar apellidos
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

    //Validar edad
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

    //Validar país
    if (pais.value === "") {
        pais.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Debes seleccionar un país";
        mensaje_error.classList.add('mensaje-error');
        pais.parentElement.appendChild(mensaje_error);
        valido = false;
    } else {
        pais.classList.add("borde-correcto");
    }

    //Validar tipo identificación
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

    // Validar numero identificación
    if (num_identificacion.value.trim() === "") {
        num_identificacion.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El número de identificación es obligatorio";
        mensaje_error.classList.add('mensaje-error');
        num_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (tipo_identificacion.value === "DNI" && !validarDNI(num_identificacion.value)) {
        tipo_identificacion.classList.add('borde-error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "DNI incorrecto";
        mensaje_error.classList.add('mensaje-error');
        num_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (tipo_identificacion.value === "NIE" && !validarNIE(num_identificacion.value)) {
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
    if (email.value.trim() === "" || !validarEmail(email.value)) {
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

    // Validar las contraseñas
    if (password.value.trim() === "" || password_confirmation.value.trim() === "") {
        password.classList.add('borde-error');
        password_confirmation.classList.add('borde-error');

        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Las contraseñas no puede estar vacías";
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

    if (!valido) {
        event.preventDefault(); // Si no esta validado no se envía el formulario.
    }
}

//Funciones para validar expresiones regulares en los campos//
function validarDNI(dni) {
    const expresionDNI = /^[0-9]{8}[TWRAGMYFPDXBNJZSQVHLCKE]$/;
    return expresionDNI.test(dni); //Esto devuelve true si pasa la validacion
}

function validarNIE(nie) {
    const expresionNIE = /^[XYZ][0-9]{7}[A-Z]$/;
    return expresionNIE.test(nie); //Esto devuelve true si pasa la validacion
}

function validarEmail(email) {
    const expresionEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return expresionEmail.test(email); //Esto devuelve true si pasa la validacion
}