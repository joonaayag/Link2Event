window.addEventListener('load', inicio);

function inicio() {
    const key = "NaABMVnPL3zTNZQa5eaP5AEuVTf4V0Aw";
    let apiDeportes = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${key}&classificationName=Sports&size=5`;
    let apiMusica = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${key}&classificationName=Music&size=2`;
    let apiArte = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${key}&classificationName=Arts & Theatre&size=2`;


    $("#columnaDeportes").html("<h3>Deportes</h3>");
    $("#columnaMusica").html("<h3>Música</h3>");
    $("#columnaArte").html("<h3>Arte</h3>");

    $.ajax({
        url: apiDeportes,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);

            //Verifica si la respuesta contiene eventos y  recorre la lista de eventos 
            if (response._embedded && response._embedded.events) {

                response._embedded.events.forEach(event => {
                    let datosEvento = {
                        id: event.id,
                        nombre: event.name,
                        url: event.url,
                        fechaInicio: event.dates?.start?.localDate || "No disponible",
                        ciudad: event._embedded?.venues?.[0]?.city?.name || "No disponible",
                        imagen: event.images?.[0]?.url || "URL no disponible",
                        entradas: event.sales?.public?.startDateTime || "No disponible"
                    };

                    $("#columnaDeportes").append(`
                    <div class="row mb-3">
                        <div class="col-4">
                            <img src="${datosEvento.imagen}" alt="Imagen del evento">
                        </div>
                        <div class="col-8">
                            <h4>Nombre del evento: ${datosEvento.nombre}</h4>
                            <p>Lugar: ${datosEvento.ciudad}</p>
                            <p>Fecha de inicio:  ${datosEvento.fechaInicio}</p>
                            <p>Fecha entradas disponibles:  ${datosEvento.entradas}</p>
                            
                            <a href="#" class="btn btn-primary">Más Detalles</a>
                        </div>
                    </div>
                    `);
                });
            } else {
                console.log("No se encontraron eventos de deportes.");
            }

        },
        error: function () {
            console.error("error en la petición");
        }
    });

    $.ajax({
        url: apiMusica,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);

            //Verifica si la respuesta contiene eventos y  recorre la lista de eventos 
            if (response._embedded && response._embedded.events) {

                response._embedded.events.forEach(event => {
                    let datosEvento = {
                        id: event.id,
                        nombre: event.name,
                        url: event.url,
                        fechaInicio: event.dates?.start?.localDate || "No disponible",
                        ciudad: event._embedded?.venues?.[0]?.city?.name || "No disponible",
                        imagen: event.images?.[0]?.url || "URL no disponible",
                        entradas: event.sales?.public?.startDateTime || "No disponible"
                    };

                    $("#columnaMusica").append(`
                    <div class="row mb-3">
                        <div class="col-4">
                            <img src="${datosEvento.imagen}" alt="Imagen del evento">
                        </div>
                        <div class="col-8">
                            <h4>Nombre del evento: ${datosEvento.nombre}</h4>
                            <p>Lugar: ${datosEvento.ciudad}</p>
                            <p>Fecha de inicio:  ${datosEvento.fechaInicio}</p>
                            <p>Fecha entradas disponibles:  ${datosEvento.entradas}</p>
                            
                            <a href="#" class="btn btn-primary">Más Detalles</a>
                        </div>
                    </div>
                    `);
                });
            } else {
                console.log("No se encontraron eventos.");
            }

        },
        error: function () {
            console.error("error en la petición de música");
        }
    });

    $.ajax({
        url: apiArte,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);

            //Verifica si la respuesta contiene eventos y  recorre la lista de eventos 
            if (response._embedded && response._embedded.events) {

                response._embedded.events.forEach(event => {
                    let datosEvento = {
                        id: event.id,
                        nombre: event.name,
                        url: event.url,
                        fechaInicio: event.dates?.start?.localDate || "No disponible",
                        ciudad: event._embedded?.venues?.[0]?.city?.name || "No disponible",
                        imagen: event.images?.[0]?.url || "URL no disponible",
                        entradas: event.sales?.public?.startDateTime || "No disponible"
                    };

                    $("#columnaArte").append(`
                    <div class="row mb-3">
                        <div class="col-4">
                            <img src="${datosEvento.imagen}" alt="Imagen del evento">
                        </div>
                        <div class="col-8">
                            <h4>Nombre del evento: ${datosEvento.nombre}</h4>
                            <p>Lugar: ${datosEvento.ciudad}</p>
                            <p>Fecha de inicio:  ${datosEvento.fechaInicio}</p>
                            <p>Fecha entradas disponibles:  ${datosEvento.entradas}</p>
                            
                            <a href="#" class="btn btn-primary">Más Detalles</a>
                        </div>
                    </div>
                    `);
                });
            } else {
                console.log("No se encontraron eventos.");
            }

        },
        error: function () {
            console.error("error en la petición de música");
        }
    });


}
