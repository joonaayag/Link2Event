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
            await sendConcertsToLaravel(data._embedded.events, filtros);
        } else {
            document.getElementById('results-container').innerHTML = '<p>No se encontraron eventos</p>';
        }
    } catch (error) {
        console.error("Error al obtener conciertos:", error);
        document.getElementById('results-container').innerHTML = `<p>Error: ${error.message}</p>`;
    }
}

async function sendConcertsToLaravel(concerts, filtros) {
    try {
        const response = await fetch("/api/conciertos", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ concerts, filtros })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        console.log("Respuesta del servidor:", result);
        
        // Update the UI with the results
        document.getElementById('results-container').innerHTML = result.html || '<p>No se encontraron conciertos</p>';
    } catch (error) {
        console.error("Error al enviar datos a Laravel:", error);
        document.getElementById('results-container').innerHTML = `<p>Error: ${error.message}</p>`;
    }
}

// Añadir evento de escucha para el formulario de filtro
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Recoger los valores del formulario
            const formData = new FormData(filterForm);
            const filtros = Object.fromEntries(formData.entries());
            
            // Llamar a la función de búsqueda
            fetchConcerts(filtros);
        });
    }
});

// Ensure the function is in the global scope
window.fetchConcerts = fetchConcerts;