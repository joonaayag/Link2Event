// Variables globales para manejar la paginación
let currentPage = 0;
let lastResponse = null;
let concertsData = {}; // Objeto para almacenar los datos de conciertos por ID

//Cargar todos los eventos por defecto al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    fetchConcerts(); // Llamada sin filtros para obtener todos los eventos
    fetchGenres(); // Cargar los géneros disponibles
    
    // Verificar si hay un elemento meta con csrf-token
    if (!document.querySelector('meta[name="csrf-token"]')) {
        console.warn('Se recomienda agregar un meta tag con csrf-token en tu HTML para las peticiones a Laravel:');
        console.warn('<meta name="csrf-token" content="{{ csrf_token() }}">')
    }
});

// Escuchar el clic del botón de filtro
document.getElementById('filterButton').addEventListener('click', function() {
    // Al aplicar filtros, reiniciamos la paginación
    currentPage = 0;
    
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
    fetchConcerts(filtros, true); // true indica que es una nueva búsqueda
});

// Función para obtener los conciertos con los filtros aplicados
async function fetchConcerts(filtros = {}, newSearch = false) {
    try {
        const apiKey = "NaABMVnPL3zTNZQa5eaP5AEuVTf4V0Aw";
        let url = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${apiKey}&size=20&page=${currentPage}`;
        
        // Validar los filtros antes de añadirlos a la URL
        // Para el nombre/keyword, exigir al menos 2 caracteres
        if (filtros.nombre) {
            if (filtros.nombre.trim().length < 2) {
                showNotification('Por favor, ingresa al menos 2 caracteres para buscar por nombre', 'error');
                return; // Detener la ejecución si no cumple con la validación
            }
            url += `&keyword=${encodeURIComponent(filtros.nombre.trim())}`;
        }
        
        if (filtros.ciudad && filtros.ciudad.trim() !== '') {
            url += `&city=${encodeURIComponent(filtros.ciudad.trim())}`;
        }
        
        if (filtros.genero && filtros.genero.trim() !== '') {
            url += `&classificationName=${encodeURIComponent(filtros.genero.trim())}`;  
        }

        if (filtros.fecha_desde && filtros.fecha_desde.trim() !== '') {
            const fechaDesde = new Date(filtros.fecha_desde);
            if (!isNaN(fechaDesde.getTime())) {
                url += `&startDateTime=${filtros.fecha_desde.trim()}T00:00:00Z`;
            }
        }

        if (filtros.fecha_hasta && filtros.fecha_hasta.trim() !== '') {
            const fechaHasta = new Date(filtros.fecha_hasta);
            if (!isNaN(fechaHasta.getTime())) {
                url += `&endDateTime=${filtros.fecha_hasta.trim()}T23:59:59Z`;
            }
        }

        if (filtros.precio_min && filtros.precio_max && 
            !isNaN(parseFloat(filtros.precio_min)) && !isNaN(parseFloat(filtros.precio_max))) {
            url += `&priceRangeFrom=${encodeURIComponent(filtros.precio_min.trim())}&priceRangeTo=${encodeURIComponent(filtros.precio_max.trim())}`;
        }
        
        console.log("URL de búsqueda:", url);
        
        const response = await fetch(url);
        if (!response.ok) throw new Error("Error al obtener datos de la API");

        const data = await response.json();
        console.log("Conciertos obtenidos:", data);
        
        // Guardar la respuesta para acceder a la información de paginación
        lastResponse = data;

        if (data._embedded && data._embedded.events) {
            // Guardar los conciertos en el objeto de datos
            if (newSearch) {
                concertsData = {}; // Limpiar datos anteriores si es una nueva búsqueda
            }
            
            // Guardar cada concierto en nuestro objeto de datos
            data._embedded.events.forEach(concert => {
                concertsData[concert.id] = concert;
            });
            
            // Mostrar conciertos en el HTML
            displayConcerts(data._embedded.events, newSearch);
            
            // Mostrar botón "Cargar más" solo si hay más páginas
            toggleLoadMoreButton(data.page);
        } else {
            if (newSearch) {
                document.getElementById('results-container').innerHTML = '<p>No se encontraron eventos con los criterios especificados</p>';
                hideLoadMoreButton();
            } else if (currentPage === 0) {
                document.getElementById('results-container').innerHTML = '<p>No se encontraron eventos</p>';
                hideLoadMoreButton();
            }
        }
    } catch (error) {
        console.error("Error al obtener conciertos:", error);
        document.getElementById('results-container').innerHTML = `<p>Error: ${error.message}</p>`;
        hideLoadMoreButton();
    }
}

// Función para mostrar u ocultar el botón "Cargar más" según la información de paginación
function toggleLoadMoreButton(pageInfo) {
    const loadMoreContainer = document.getElementById('load-more-container');
    
    // Crear el contenedor si no existe
    if (!loadMoreContainer) {
        const container = document.createElement('div');
        container.id = 'load-more-container';
        container.className = 'text-center mt-4 mb-4';
        
        const button = document.createElement('button');
        button.id = 'load-more-button';
        button.className = 'btn btn-primary btn-registroBis mt-3';
        button.textContent = 'Cargar más eventos';
        button.addEventListener('click', loadMoreEvents);
        
        container.appendChild(button);
        document.getElementById('results-container').after(container);
    }
    
    // Mostrar u ocultar el botón según si hay más páginas
    if (pageInfo && pageInfo.totalPages > pageInfo.number + 1) {
        document.getElementById('load-more-container').style.display = 'block';
    } else {
        hideLoadMoreButton();
    }
}

// Ocultar el botón "Cargar más"
function hideLoadMoreButton() {
    const loadMoreContainer = document.getElementById('load-more-container');
    if (loadMoreContainer) {
        loadMoreContainer.style.display = 'none';
    }
}

// Función para cargar más eventos
function loadMoreEvents() {
    // Incrementar la página actual
    currentPage++;
    
    // Recoger los filtros actuales
    const filtros = {
        nombre: document.getElementById('nombre').value,
        ciudad: document.getElementById('ciudad').value,
        fecha_desde: document.getElementById('fecha_desde').value,
        fecha_hasta: document.getElementById('fecha_hasta').value,
        genero: document.getElementById('genero').value,
        precio_min: document.getElementById('precio_min').value,
        precio_max: document.getElementById('precio_max').value,
    };
    
    // Llamar a fetchConcerts para cargar más eventos
    fetchConcerts(filtros, false); // false indica que no es una nueva búsqueda
}

function displayConcerts(concerts, newSearch) {
    const container = document.getElementById('results-container');
    
    // Limpiar resultados previos solo si es una nueva búsqueda
    if (newSearch) {
        container.innerHTML = '';
    }

    if (!concerts || concerts.length === 0) {
        if (newSearch) {
            container.innerHTML = '<p>No se encontraron conciertos</p>';
        }
        return;
    }
    
    // Crear HTML para mostrar los conciertos
    const concertList = concerts.map(concert => {
        // Verificar que todos los datos necesarios existan y proporcionar valores predeterminados seguros
        try {
            const imageUrl = concert.images && concert.images.length > 0 ? concert.images[0].url : 'https://via.placeholder.com/300';
            
            const eventDate = concert.dates && concert.dates.start && concert.dates.start.dateTime 
                ? new Date(concert.dates.start.dateTime).toLocaleString() 
                : 'Fecha no disponible';
                
            const eventTime = concert.dates && concert.dates.start && concert.dates.start.dateTime
                ? new Date(concert.dates.start.dateTime).toLocaleTimeString()
                : 'Hora no disponible';
                
            // Verificación de venues
            if (!concert._embedded || !concert._embedded.venues || concert._embedded.venues.length === 0) {
                throw new Error('Datos de venue no disponibles');
            }
            
            const venue = concert._embedded.venues[0];
            const venueName = venue.name || 'Lugar no disponible';
            const cityName = venue.city && venue.city.name ? venue.city.name : 'Ciudad no disponible';
            const venueAddress = venue.address && venue.address.line1 ? venue.address.line1 : 'Dirección no disponible';
            
            // Verificación de genre
            const genre = concert.classifications && concert.classifications.length > 0 && 
                  concert.classifications[0].genre && concert.classifications[0].genre.name
                  ? concert.classifications[0].genre.name 
                  : 'Género no disponible';
                  
            // Verificación de precios
            const minPrice = concert.priceRanges && concert.priceRanges.length > 0 
                ? concert.priceRanges[0].min 
                : 'No disponible';
                
            const maxPrice = concert.priceRanges && concert.priceRanges.length > 0 
                ? concert.priceRanges[0].max 
                : 'No disponible';
                
            // Verificación de fechas de venta
            const saleDate = concert.sales && concert.sales.public && concert.sales.public.startDateTime
                ? new Date(concert.sales.public.startDateTime).toLocaleString()
                : 'Fecha no disponible';
            
            return `
                <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                    <div class="card tarjeta-formularioBis carta-inicioBis">
                        <img src="${imageUrl}" class="card-img-top" alt="${concert.name || 'Evento'}">
                        <div class="card-body">
                            <div id="titulito"><h5 class="card-title">${concert.name || 'Evento sin nombre'}</h5></div>
                            <p class="card-text"><strong>Fecha:</strong> ${eventDate}</p>
                            <p class="card-text"><strong>Lugar:</strong> ${venueName}</p>
                            <p class="card-text"><strong>Ciudad:</strong> ${cityName}</p>
                            <p class="card-text"><strong>Género:</strong> ${genre}</p>
                            <p class="card-text"><strong>Precio:</strong> ${minPrice !== 'No disponible' ? 'Desde $' + minPrice : 'No disponible'}</p>
                            
                            <div class="d-flex justify-content-between mt-3">
                                <a href="${concert.url || '#'}" target="_blank" class="btn btn-primary btn-registroBis btn-modal mt-3">Comprar Entradas</a>
                                <button id="fav-btn-${concert.id}" onclick="saveAsFavorite('${concert.id}')" class="btn btn-primary btn-loginBis btn-modal mt-3">
                                    <i class="far fa-heart"></i> Favorito
                                </button>
                            </div>

                            <button type="button" class="btn btn-primary btn-loginBis btn-modal mt-3 w-100" data-target="#modal_${concert.id}">
                                Ver detalles
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal_${concert.id}" tabindex="-1" role="dialog" aria-labelledby="modalTitle_${concert.id}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title negrita" id="exampleModalLongTitle">Más información sobre ${concert.name || 'este evento'}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <img src="${imageUrl}" class="img-fluid" alt="Imagen del evento">
                                                </div>
                                                <div class="col-6">
                                                    <p><strong>Ciudad:</strong> ${cityName}</p>
                                                    <p><strong>Lugar:</strong> ${venueName}</p>
                                                    <p><strong>Fecha de inicio:</strong> ${eventDate}</p>
                                                    <p><strong>Hora de inicio:</strong> ${eventTime}</p>
                                                    <p><strong>Fecha entradas disponibles:</strong> ${saleDate}</p>
                                                    <p><strong>Dirección:</strong> ${venueAddress}</p>
                                                    <p><strong>Género:</strong> ${genre}</p>
                                                    <p><strong>Precio mínimo:</strong> ${minPrice !== 'No disponible' ? '$' + minPrice : 'No disponible'}</p>
                                                    <p><strong>Precio máximo:</strong> ${maxPrice !== 'No disponible' ? '$' + maxPrice : 'No disponible'}</p>
                                                    
                                                    <!-- Botón de favorito en el modal también -->
                                                    <button onclick="saveAsFavorite('${concert.id}')" class="btn btn-primary btn-registroBis btn-modal mt-3 w-100">
                                                        <i class="far fa-heart"></i> Guardar como favorito
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary mt-3 w-100" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } catch (error) {
            console.error("Error al procesar el concierto:", error, concert);
            return `
                <div class="col-md-4 col-sm-6">
                    <div class="card tarjeta-formulario carta-inicio">
                        <div class="card-body">
                            <h5 class="card-title">${concert.name || 'Evento sin nombre'}</h5>
                            <p class="card-text">No se pudieron cargar todos los detalles para este evento.</p>
                            <a href="${concert.url || '#'}" target="_blank" class="btn btn-primary btn-loginBis btn-sm">Ver en Ticketmaster</a>
                        </div>
                    </div>
                </div>
            `;
        }
        
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

    // Si es una nueva búsqueda, reemplazamos el contenido
    // Si no, añadimos al contenido existente
    if (newSearch) {
        container.innerHTML = `<div class="row" id="concerts-row">${concertList}</div>`;
    } else {
        const concertsRow = document.getElementById('concerts-row');
        if (concertsRow) {
            concertsRow.innerHTML += concertList;
        } else {
            container.innerHTML = `<div class="row" id="concerts-row">${concertList}</div>`;
        }
    }
}


// Función para guardar un evento como favorito
async function saveAsFavorite(eventId) {
    try {
        // Obtener el evento del objeto de datos almacenado
        const event = concertsData[eventId];
        if (!event) {
            throw new Error('Evento no encontrado');
        }
        
        // Obtener CSRF token (Laravel requiere esto para las solicitudes POST)
        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
                           document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';
                           
        
        // Preparar datos del evento para enviar
        const eventData = {
            event_id: event.id,
            event_name: event.name,
            event_image: event.images && event.images.length > 0 ? event.images[0].url : null,
            event_date: new Date(event.dates.start.dateTime).toISOString().slice(0, 19).replace("T", " "),
            event_venue: event._embedded.venues[0].name,
            event_city: event._embedded.venues[0].city.name,
            event_genre: event.classifications && event.classifications.length > 0 ? 
                   event.classifications[0].genre.name : 'No disponible',
            event_price_min: event.priceRanges ? event.priceRanges[0].min : null,
            event_price_max: event.priceRanges ? event.priceRanges[0].max : null,
            event_url: event.url
        };
        
        // Enviar solicitud al backend de Laravel
        const response = await fetch('/favorites', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(eventData)
        });
        
        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Error al guardar favorito');
        }
        
        const result = await response.json();
        
        // Mostrar mensaje de éxito
        showNotification('Evento guardado como favorito', 'success');
        
        // Actualizar todos los botones para este evento
        const favButtons = document.querySelectorAll(`button[onclick="saveAsFavorite('${eventId}')"]`);
        favButtons.forEach(button => {
            button.innerHTML = '<i class="fas fa-heart"></i> Guardado';
            button.disabled = true;
            button.classList.remove('btn-outline-danger');
            button.classList.add('btn-danger');
        });
        
        return result;
    } catch (error) {
        console.error('Error al guardar favorito:', error);
        showNotification(error.message || 'Error al guardar favorito', 'error');
    }
}

// Función para mostrar notificaciones
function showNotification(message, type = 'info') {
    // Sistema simple de notificaciones usando Bootstrap alerts
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
    alertDiv.setAttribute('role', 'alert');
    alertDiv.style.position = 'fixed';
    alertDiv.style.top = '20px';
    alertDiv.style.right = '20px';
    alertDiv.style.zIndex = '9999';
    alertDiv.innerHTML = `
        ${message}
    `;
    
    // Añadir al body
    document.body.appendChild(alertDiv);
    
    // Auto-eliminar después de 5 segundos
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
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
