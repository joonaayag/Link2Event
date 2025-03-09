$(document).ready(inicio);

function inicio() {

    $('#botonEnviarMensaje').click(enviarCorreo);

    function enviarCorreo(e) {

        let destinatario = "atrovin365@iesfuengirola1.es";

        let emailUsuario = $('#emailUsuario');
        let asunto = $('#asunto');
        let cuerpo = $('#cuerpo');

        // Limpiar mensajes y bordes previos
        $('.mensaje-error').remove();
        emailUsuario.removeClass("borde-error borde-correcto");
        asunto.removeClass("borde-error borde-correcto");

        if (!validarEmail(emailUsuario) | !validarAsunto(asunto)) {
            e.preventDefault();
        } else if (!validarCuerpo(cuerpo)) {
            emailUsuario.removeClass("borde-error borde-correcto");
            asunto.removeClass("borde-error borde-correcto");
            e.preventDefault();
        } else {
            let mailtoLink = `mailto:${destinatario}?cc=${emailUsuario.val()}&subject=${asunto.val()}&body=${cuerpo.val()}`;

            window.location.href = mailtoLink;
            // Elimina estilos de validación y valores una vez se ha abierto la ventana del correo 
            setTimeout(() => {
                asunto.val('');
                cuerpo.val('');

                emailUsuario.removeClass("borde-correcto");
                asunto.removeClass("borde-correcto");
                cuerpo.removeClass("borde-correcto");
            }, 500);

        }
    }

    function validarEmail(emailUsuario) {
        if (emailUsuario.val().trim() === "") {
            emailUsuario.addClass("borde-error");
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "El email es obligatorio";
            mensajeError.classList.add("mensaje-error");
            emailUsuario.parent().append(mensajeError);
            return false;
        }

        let patron = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        if (!patron.test(emailUsuario.val())) {
            emailUsuario.addClass("borde-error");
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "El email no cumple el formato";
            mensajeError.classList.add("mensaje-error");
            emailUsuario.parent().append(mensajeError);
            return false;
        } else {
            emailUsuario.addClass("borde-correcto");
            return true;
        }
    }

    function validarAsunto(asunto) {
        if (asunto.val().trim() === "") {
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "El asunto es obligatorio";
            mensajeError.classList.add("mensaje-error");
            asunto.parent().append(mensajeError);
            return false;
        } else if (asunto.val().trim().length > 25) {
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "El asunto no puede tener más de 25 caracteres";
            mensajeError.classList.add("mensaje-error");
            asunto.parent().append(mensajeError);
            return false;
        } else {
            asunto.addClass("borde-correcto");
            return true;
        }
    }

    function validarCuerpo(cuerpo) {
        if (cuerpo.val().trim() === "") {
            return confirm("¿Deseas enviar un correo sin cuerpo?");
        } else if (cuerpo.val().trim().length > 250) {
            let mensajeError = document.createElement("small");
            mensajeError.textContent = "El cuerpo no puede tener más de 25 caracteres";
            mensajeError.classList.add("mensaje-error");
            cuerpo.parent().append(mensajeError);
            return false;
        } else {
            cuerpo.addClass("borde-correcto");
            return true;
        }
    }
}
