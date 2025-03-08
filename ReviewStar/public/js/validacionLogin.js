window.addEventListener("load", inicio);

function inicio() {
    document.getElementById("iniciarSesionLogin").addEventListener("click", validarLogin);

    function validarLogin(e) {
        let email = document.getElementById("email");
        let password = document.getElementById("password");

        // Limpiar mensajes y bordes previos
        let mensajesError = document.querySelectorAll(".mensaje-error");
        mensajesError.forEach(mensaje => mensaje.remove());
        email.classList.remove("borde-error", "borde-correcto");
        password.classList.remove("borde-error", "borde-correcto");

        if (!validarEmail(email) | !validarPassword(password)) {
            e.preventDefault();
        }
    }

    function validarEmail(email) {
        if (email.value.trim() === "") {
            email.classList.add("borde-error");
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "El email es obligatorio";
            mensajeError.classList.add("mensaje-error");
            email.parentElement.appendChild(mensajeError);
            return false;
        }

        
        if (!ValidarPatrones.validarEmail(email.value)) {
            email.classList.add("borde-error");
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "El email no cumple el formato";
            mensajeError.classList.add("mensaje-error");
            email.parentElement.appendChild(mensajeError);
            return false;
        } else {
            email.classList.add("borde-correcto");
            return true;
        }
    }

    function validarPassword(password) {
        if (password.value.trim() === "") {
            password.classList.add("borde-error");
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "La contraseña es obligatoria";
            mensajeError.classList.add("mensaje-error");
            // password.closest(".form-group").append(mensajeError); devuelve errores en ingles
            password.parentElement.parentElement.appendChild(mensajeError);
            return false;
        } else if (password.value.trim().length < 6) {
            password.classList.add("borde-error");
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "La contraseña debe tener al menos 6 caracteres";
            mensajeError.classList.add("mensaje-error");
            // password.closest(".form-group").append(mensajeError); devuelve errores en ingles
            password.parentElement.parentElement.appendChild(mensajeError);
            return false;
        } else {
            password.classList.add("borde-correcto");
            return true;
        }
    }
}
