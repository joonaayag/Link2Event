window.addEventListener('load', inicio);

const API = `https://restcountries.com/v3.1/region/europe`;
const iconoCargando = $("#iconoCargando");


function inicio() {
    document.getElementById("pais").addEventListener("click", mostrarPaises);
    iconoCargando.hide();
}

function mostrarPaises() {

    $.ajax({
        url: API,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            iconoCargando.show();
        },
        success: function (response) {
            let paises = [];//Hago un array para poner todos los paises y ordenarlos luego
            iconoCargando.hide();
            response.forEach(pais => {
                paises.push(pais.translations.spa.common);
            });
            paises.sort();//Ordenamos los paises
            console.log(response);
            paises.forEach(pais => {
                let opcion = document.createElement("option");
                opcion.setAttribute("value", pais);
                let textoOpcion = document.createTextNode(pais);
                opcion.appendChild(textoOpcion);
                $("#pais").append(opcion);
            });
        },
        error: function () {
            console.error("error en la petición");
        }
    });
}