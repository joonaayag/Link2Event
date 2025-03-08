window.addEventListener("load", inicio);

function inicio() {
    const key = "NaABMVnPL3zTNZQa5eaP5AEuVTf4V0Aw";
    let apiDeportes = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${key}&classificationName=Sports&size=5`;
    let apiMusica = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${key}&classificationName=Music&size=2`;
    let apiArte = `https://app.ticketmaster.com/discovery/v2/events.json?apikey=${key}&classificationName=Arts & Theatre&size=2`;

    $("#columnaDeportes").html("<h3 class='blanco mediana mb-4'>Deportes</h3>");
    $("#columnaMusica").html("<h3 class='blanco mediana mb-4'>Música</h3>");
    $("#columnaArte").html("<h3 class='blanco mediana'>Arte</h3>");


    function obtenerDatosEvento(event) {
        let fechaEntradas = event.sales?.public?.startDateTime;
        let fechaEntradasNueva = fechaEntradas.split("T")[0] + " " + fechaEntradas.split("T")[1].replace("Z", "H");
        return {
            id: event.id,
            nombre: event.name,
            url: event.url,
            fechaInicio: event.dates?.start?.localDate || "No disponible",
            ciudad: event._embedded?.venues?.[0]?.city?.name || "No disponible",
            imagen: event.images?.[0]?.url || "URL no disponible",
            entradas: fechaEntradasNueva || "No disponible",
            fechaHora: event.dates?.start?.dateTime
                ? new Date(event.dates.start.dateTime).toLocaleString()
                : "No disponible",
            lugar: event._embedded?.venues?.[0]?.name || "No disponible",
            direccion: event._embedded?.venues?.[0]?.address?.line1 || "No disponible",
            genero: event.classifications?.[0]?.genre?.name || "No disponible",
            precioMinimo: event.priceRanges?.[0]?.min
                ? `${event.priceRanges[0].min.toFixed(2)}$`
                : "No disponible",
            precioMaximo: event.priceRanges?.[0]?.max
                ? `${event.priceRanges[0].max.toFixed(2)}$`
                : "No disponible",
        };
    }
    function imprimirColumnaDep(datosEvento) {
        return `<div class="row mb-4 carta-inicio tarjeta-inicio">
                        <div class="col-5 d-flex flex-column align-items-center justify-content-center">
                            <img src="${datosEvento.imagen}" class="imagen-inicio" alt="Imagen del evento">
                            <button type="button" class="btn btn-primary btn-modal btn-registro mt-3 w-100" data-target="#modal_${datosEvento.id}">
                                Ver detalles
                            </button>
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <h4 class="negrita naranjita" >${datosEvento.nombre}</h4>
                            <p><span class="negrita">Lugar:</span> ${datosEvento.ciudad}</p>
                            <p><span class="negrita">Fecha de inicio:</span>  ${datosEvento.fechaInicio}</p>
                            <p><span class="negrita">Fecha entradas disponibles:</span>  ${datosEvento.entradas}</p>
                            

                            <!-- Modal -->
                            <div class="modal fade modalInicio" id="modal_${datosEvento.id}" tabindex="-1" role="dialog" aria-labelledby="modalTitle_${datosEvento.id}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Más información sobre ${datosEvento.nombre}</h5>
                                        </div>
                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                            <div class="row">
                                                <div class="col-6 contenedor-imagen-modal">
                                                    <img src="${datosEvento.imagen}" alt="Imagen del evento">
                                                </div>
                                                <div class="col-6 d-flex flex-column justify-content-between">
                                                    <p><span class="negrita">Ciudad:</span> ${datosEvento.ciudad}</p>
                                                    <p><span class="negrita">Lugar:</span> ${datosEvento.lugar}</p>
                                                    <p><span class="negrita">Fecha de inicio:</span>  ${datosEvento.fechaInicio}</p>
                                                    <p><span class="negrita">Hora de inicio:</span>  ${datosEvento.fechaHora}</p>
                                                    <p><span class="negrita">Fecha entradas disponibles:</span>  ${datosEvento.entradas}</p>
                                                    <p><span class="negrita">Dirección:</span>  ${datosEvento.direccion}</p>
                                                    <p><span class="negrita">Genero:</span>  ${datosEvento.genero}</p>
                                                    <p><span class="negrita">Precio minimo:</span>  ${datosEvento.precioMinimo}</p>
                                                    <p><span class="negrita">Precio maximo:</span>  ${datosEvento.precioMaximo}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="${datosEvento.url}" target="_blank" class="btn btn-primary btn-registro">Ver en Ticketmaster</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
    }

    function imprimirColumnaMA(datosEvento) {
        return `<div class="row mb-4 carta-inicio tarjeta-inicio">
                        <div class="col-5 d-flex flex-column align-items-center justify-content-center">
                            <img src="${datosEvento.imagen}" class="imagen-inicio" alt="Imagen del evento">
                            <button type="button" class="btn btn-primary btn-registro btn-modal mt-3 w-100" data-target="#modal_${datosEvento.id}">
                                Ver detalles
                            </button>
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <h4 class="negrita naranjita" >${datosEvento.nombre}</h4>
                            <p><span class="negrita">Ciudad:</span> ${datosEvento.ciudad}</p>
                            <p><span class="negrita">Fecha de inicio:</span>  ${datosEvento.fechaInicio}</p>
                            <p><span class="negrita">Fecha entradas disponibles:</span>  ${datosEvento.entradas}</p>
                            
                            <!-- Modal -->
                            <div class="modal fade modalInicio" id="modal_${datosEvento.id}" tabindex="-1" role="dialog" aria-labelledby="modalTitle_${datosEvento.id}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Más información sobre ${datosEvento.nombre}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6 contenedor-imagen-modal">
                                                    <img src="${datosEvento.imagen}" alt="Imagen del evento">
                                                </div>
                                                <div class="col-6 d-flex flex-column justify-content-between">
                                                    <p><span class="negrita">Ciudad:</span> ${datosEvento.ciudad}</p>
                                                    <p><span class="negrita">Lugar:</span> ${datosEvento.lugar}</p>
                                                    <p><span class="negrita">Fecha de inicio:</span>  ${datosEvento.fechaInicio}</p>
                                                    <p><span class="negrita">Hora de inicio:</span>  ${datosEvento.fechaHora}</p>
                                                    <p><span class="negrita">Fecha entradas disponibles:</span>  ${datosEvento.entradas}</p>
                                                    <p><span class="negrita">Dirección:</span>  ${datosEvento.direccion}</p>
                                                    <p><span class="negrita">Genero:</span>  ${datosEvento.genero}</p>
                                                    <p><span class="negrita">Precio minimo:</span>  ${datosEvento.precioMinimo}</p>
                                                    <p><span class="negrita">Precio maximo:</span>  ${datosEvento.precioMaximo}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                            <a href="${datosEvento.url}" target="_blank" class="btn btn-primary btn-registro">Ver en Ticketmaster</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
    }

    $.ajax({
        url: apiDeportes,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);

            //Verifica si la respuesta contiene eventos y  recorre la lista de eventos
            if (response._embedded && response._embedded.events) {
                response._embedded.events.forEach((event) => {

                    let datosEvento = obtenerDatosEvento(event);

                    $("#columnaDeportes").append(imprimirColumnaDep(datosEvento));
                });
            } else {
                console.log("No se encontraron eventos de deportes.");
            }
        },
        error: function () {
            console.error("error en la petición");
        },
    });

    $.ajax({
        url: apiMusica,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);

            //Verifica si la respuesta contiene eventos y  recorre la lista de eventos
            if (response._embedded && response._embedded.events) {
                response._embedded.events.forEach((event) => {
                    let datosEvento = obtenerDatosEvento(event);

                    $("#columnaMusica").append(imprimirColumnaMA(datosEvento));
                });
            } else {
                console.log("No se encontraron eventos.");
            }
        },
        error: function () {
            console.error("error en la petición de música");
        },
    });

    $.ajax({
        url: apiArte,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);

            //Verifica si la respuesta contiene eventos y  recorre la lista de eventos
            if (response._embedded && response._embedded.events) {
                response._embedded.events.forEach((event) => {

                    let datosEvento = obtenerDatosEvento(event);

                    $("#columnaArte").append(imprimirColumnaMA(datosEvento));
                });
            } else {
                console.log("No se encontraron eventos.");
            }
        },
        error: function () {
            console.error("error en la petición de música");
        },
    });

    //Abrir modal
    $(document).on("click", ".btn-modal", function () {
        let target = $(this).data("target"); // Obtiene el ID de la modal
        $(target).modal("show"); // Abre la modal manualmente
    });

    //Cerrar modal
    $(document).on("click", ".close, .btn-secondary", function () {
        $(this).closest(".modal").modal("hide");
    });


}
