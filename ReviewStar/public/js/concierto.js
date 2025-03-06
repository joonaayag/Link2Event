// Escuchar el clic del botón de filtro
document.getElementById('filterButton').addEventListener('click', function() {
    // Recoger los valores de los filtros
    const filtros = {
        nombre: document.getElementById('nombre').value,
        ciudad: document.getElementById('ciudad').value,
        fecha_desde: document.getElementById('fecha_desde').value,
        fecha_hasta: document.getElementById('fecha_hasta').value,
        genero: document.getElementById('genero').value,
        precio_min: document.getElementById('precio_min').value,
        precio_max: document.getElementById('precio_max').value,
    };

    // Llamar a la función fetchConcerts para realizar la búsqueda con los filtros
    fetchConcerts(filtros);
});

// Función para obtener los conciertos con los filtros aplicados
async function fetchConcerts(filtros = {}) {
    try {
        const apiKey = "NaABMVnPL3zTNZQa5eaP5AEuVTf4V0Aw";
        let url = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${apiKey}`;
        
        // Mapear los filtros para que coincidan con la API de Ticketmaster
        if (filtros.ciudad) {
            url += `&city=${encodeURIComponent(filtros.ciudad)}`;
        }
        
        if (filtros.genero) {
            url += `&classificationName=${encodeURIComponent(filtros.genero)}`;  
        }

        if (filtros.fecha_desde) {
            url += `&startDateTime=${encodeURIComponent(filtros.fecha_desde)}T00:00:00Z`;
        }

        if (filtros.fecha_hasta) {
            url += `&endDateTime=${encodeURIComponent(filtros.fecha_hasta)}T23:59:59Z`;
        }

        if (filtros.precio_min && filtros.precio_max) {
            url += `&priceRangeFrom=${encodeURIComponent(filtros.precio_min)}&priceRangeTo=${encodeURIComponent(filtros.precio_max)}`;
        }
        
        const response = await fetch(url);
        if (!response.ok) throw new Error("Error al obtener datos de la API");

        const data = await response.json();
        console.log("Conciertos obtenidos:", data);

        if (data._embedded && data._embedded.events) {
            // Mostrar conciertos directamente en el HTML
            displayConcerts(data._embedded.events);
        } else {
            document.getElementById('results-container').innerHTML = '<p>No se encontraron eventos</p>';
        }
    } catch (error) {
        console.error("Error al obtener conciertos:", error);
        document.getElementById('results-container').innerHTML = `<p>Error: ${error.message}</p>`;
    }
}

function displayConcerts(concerts) {
    const container = document.getElementById('results-container');
    container.innerHTML = '';  // Limpiar resultados previos

    if (concerts.length === 0) {
        container.innerHTML = '<p>No se encontraron conciertos</p>';
        return;
    }
// Crear HTML para mostrar los conciertos
const concertList = concerts.map(concert => {
    return `
        <div class="col-md-4 col-sm-6 mb-4"> <!-- 3 columnas en pantallas grandes, 2 en medianas, 1 en móviles -->
            <div class="card h-100 shadow-sm">
                <img src="${concert.images ? concert.images[0].url : 'https://via.placeholder.com/300'}" class="card-img-top" alt="${concert.name}">
                <div class="card-body">
                    <h5 class="card-title">${concert.name}</h5>
                    <p class="card-text"><strong>Fecha:</strong> ${concert.dates.start.dateTime ? new Date(concert.dates.start.dateTime).toLocaleString() : 'Fecha no disponible'}</p>
                    <p class="card-text"><strong>Lugar:</strong> ${concert._embedded.venues[0].name}</p>
                    <p class="card-text"><strong>Ciudad:</strong> ${concert._embedded.venues[0].city.name}</p>
                    <p class="card-text"><strong>Género:</strong> ${concert.classifications && concert.classifications.length > 0 ? concert.classifications[0].genre.name : 'No disponible'}</p>
                    <p class="card-text"><strong>Precio:</strong> Desde $${concert.priceRanges ? concert.priceRanges[0].min : 'No disponible'}</p>
                    <a href="${concert.url}" target="_blank" class="btn btn-primary w-100">Comprar Entradas</a>

                    <button type="button" class="btn btn-primary btn-modal" data-target="#modal_${concert.id}">
                        Ver detalles
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal_${concert.id}" tabindex="-1" role="dialog" aria-labelledby="modalTitle_${concert.id}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Más información sobre ${concert.name}</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="col-4">
                                        <img src="${concert.images ? concert.images[0].url : 'https://via.placeholder.com/300'}" alt="Imagen del evento">
                                    </div>
                                    <div class="col-8">
                                        <p>Ciudad: ${concert._embedded.venues[0].city.name}</p>
                                        <p>Lugar: ${concert._embedded.venues[0].name}</p>
                                        <p>Fecha de inicio:  ${concert.dates.start.dateTime ? new Date(concert.dates.start.dateTime).toLocaleString() : 'Fecha no disponible'}</p>
                                        <p>Hora de inicio:  ${concert.dates.start.dateTime ? new Date(concert.dates.start.dateTime).toLocaleTimeString() : 'Hora no disponible'}</p>
                                        <p>Fecha entradas disponibles:  ${concert.sales.public.startDateTime ? new Date(concert.sales.public.startDateTime).toLocaleString() : 'Fecha no disponible'}</p>
                                        <p>Dirección:  ${concert._embedded.venues[0].address.line1}</p>
                                        <p>Género:  ${concert.classifications && concert.classifications.length > 0 ? concert.classifications[0].genre.name : 'No disponible'}</p>
                                        <p>Precio minimo:  ${concert.priceRanges ? concert.priceRanges[0].min : 'No disponible'}</p>
                                        <p>Precio maximo:  ${concert.priceRanges ? concert.priceRanges[0].max : 'No disponible'}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    `;
}).join('');

//Abrir modal
$(document).on("click", ".btn-modal", function () {
    let target = $(this).data("target"); // Obtiene el ID de la modal
    $(target).modal("show"); // Abre la modal manualmente
});

//Cerrar modal
$(document).on("click", ".close, .btn-secondary", function () {
    $(this).closest(".modal").modal("hide");
});

container.innerHTML = `<div class="row">${concertList}</div>`;

}
async function fetchGenres() {
    try {
        const apiKey = "NaABMVnPL3zTNZQa5eaP5AEuVTf4V0Aw";
        const url = `https://app.ticketmaster.com/discovery/v2/classifications.json?apikey=${apiKey}`;

        const response = await fetch(url);
        if (!response.ok) throw new Error("Error al obtener géneros de la API");

        const data = await response.json();

        if (data._embedded && data._embedded.classifications) {
            const genres = data._embedded.classifications
                .filter(classification => classification.segment && classification.segment.name) // Filtrar elementos sin nombre
                .map(classification => classification.segment.name); // Extraer los nombres de género

            populateGenreSelect(genres);
        }
    } catch (error) {
        console.error("Error al obtener géneros:", error);
    }
}

// Función para llenar el <select> de géneros dinámicamente
function populateGenreSelect(genres) {
    const genreSelect = document.getElementById("genero");

    // Limpiar el select antes de agregar nuevos valores
    genreSelect.innerHTML = `<option value="">-- Todos --</option>`;

    // Agregar los géneros obtenidos de la API
    genres.forEach(genre => {
        const option = document.createElement("option");
        option.value = genre;
        option.textContent = genre;
        genreSelect.appendChild(option);
    });
}

// Llamar a la función al cargar la página
document.addEventListener("DOMContentLoaded", fetchGenres);


// Asegurarse de que la función esté en el ámbito global
window.fetchConcerts = fetchConcerts;
