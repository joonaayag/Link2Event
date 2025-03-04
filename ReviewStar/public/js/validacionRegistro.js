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
    })


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

    if (nombre.value.trim() === "") {
        nombre.classList.add('error'); //Pongo borde rojo al input
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El nombre es obligatorio";
        mensaje_error.classList.add('mensaje-error'); // pongo el texto de error rojo

        // Inserto el mensaje debajo del input
        nombre.parentElement.appendChild(mensaje_error);

        valido = false;
    } else if (nombre.value.trim().length > 15) {
        nombre.classList.add('error');

        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El nombre no puede tener más de 15 caracteres";
        mensaje_error.classList.add('mensaje-error');

        nombre.parentElement.appendChild(mensaje_error);
        valido = false;
    }


    if (apellidos.value.trim() === "") {
        apellidos.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Los apellidos son obligatorios";
        mensaje_error.classList.add('mensaje-error');
        apellidos.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    if (edad.value.trim() === "" || isNaN(edad.value) || edad.value < 18) {
        edad.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Debes ser mayor de edad";
        mensaje_error.classList.add('mensaje-error');
        edad.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    if (pais.value === "") {
        pais.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Debes seleccionar un país";
        mensaje_error.classList.add('mensaje-error');
        pais.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    if (tipo_identificacion.value !== "DNI" && tipo_identificacion.value !== "NIE") {
        tipo_identificacion.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Selecciona DNI o NIE";
        mensaje_error.classList.add('mensaje-error');
        tipo_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    if (tipo_identificacion.value === "DNI" && !validarDNI(num_identificacion.value)) {
        tipo_identificacion.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "DNI incorrecto";
        mensaje_error.classList.add('mensaje-error');
        num_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (tipo_identificacion.value === "NIE" && !validarNIE(num_identificacion.value)) {
        tipo_identificacion.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "NIE incorrecto";
        mensaje_error.classList.add('mensaje-error');
        num_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    if (num_identificacion.value.trim() === "") {
        num_identificacion.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "El número de identificación es obligatorio";
        mensaje_error.classList.add('mensaje-error');
        num_identificacion.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    // Validar la dirección
    if (direccion.value.trim() === "") {
        direccion.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "La dirección es obligatoria";
        mensaje_error.classList.add('mensaje-error');
        direccion.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    // Validar el correo electrónico
    if (email.value.trim() === "" || !validarEmail(email.value)) {
        email.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Formato de email incorrecto";
        mensaje_error.classList.add('mensaje-error');
        email.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    // Validar las contraseñas
    if (password.value !== password_confirmation.value) {
        password.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "La contraseña no puede estar vacia";
        mensaje_error.classList.add('mensaje-error');
        password.parentElement.appendChild(mensaje_error);
        valido = false;
    } else if (password.value.trim() === "" || password_confirmation.value.trim() === "") {
        password_confirmation.classList.add('error');
        let mensaje_error = document.createElement('small');
        mensaje_error.textContent = "Las contraseñas no coinciden";
        mensaje_error.classList.add('mensaje-error');
        password_confirmation.parentElement.appendChild(mensaje_error);
        valido = false;
    }

    if (!valido) {
        event.preventDefault(); // Si no esta validado no se envía el formulario.
    }
}