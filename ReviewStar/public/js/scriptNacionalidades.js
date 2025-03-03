window.addEventListener('load', inicio);

const API = `https://api.thecompaniesapi.com/v2/locations/countries`;

function inicio() {

    document.getElementById("nacionalidad").addEventListener("click", mostrarNacionalidad);

}