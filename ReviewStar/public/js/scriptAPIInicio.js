window.addEventListener('load', inicio);

function inicio() {
    const key = "NaABMVnPL3zTNZQa5eaP5AEuVTf4V0Aw";         
    let api = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${key}`;

    $.ajax({
        url: api,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);

            //Verifica si la respuesta contiene eventos y  recorre la lista de eventos 
            if (response._embedded && response._embedded.events) {

                let eventosDeporte = [];
                let eventosMusica = [];
                let eventosArte = [];

                response._embedded.events.forEach(event => {
                    let categoria = event.classifications?.[0]?.segment?.name || "No disponible";
                    let datosEvento = {
                        id: event.id,
                        nombre: event.name,
                        url: event.url,
                        fechaInicio: event.dates?.start?.localDate || "No disponible",
                        ciudad: event._embedded?.venues?.[0]?.city?.name || "No disponible",
                        imagen: event.images?.[0]?.url || "URL no disponible",
                        entradas: event.sales?.public?.startDateTime || "No disponible"
                    };

                    //5 deportes 2 musica 2 arte
                    if (categoria === "Sports" && eventosDeporte.length < 5) {
                        eventosDeporte.push(datosEvento);
                    }else if (categoria === "Music" && eventosMusica.length < 2) {
                        eventosMusica.push(datosEvento);
                    }else if (categoria === "Arts & Theatre" && eventosArte.length < 2) {
                        eventosArte.push(datosEvento);
                    }
    
                    
                });
            } else {
                console.log("No se encontraron eventos.");
            }
            
        },
        error: function () {
            console.error("error en la petición");
        }
    });
    
}