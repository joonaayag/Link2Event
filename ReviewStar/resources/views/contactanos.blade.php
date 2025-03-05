@extends('layouts.base')

@section('titulo', '- Contáctanos')

@section('claseBody', 'class=pagina-contactanos')

@section('contenido')
    <script src="{{ asset('js/scriptCorreo.js') }}" defer></script>

    <video autoplay muted loop class="fondo-contactanos">
        <source src="{{ asset('assets/videos/fondo-contactanos.mp4') }}" type="video/mp4">
    </video>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Tarjeta -->
                <div class="card tarjeta-formulario">
                    <div class="card-body d-flex flex-column">
                        <div class="row">
                            <div class="col-lg-8 col-md-12 d-flex flex-column">
                                <h3 class="bienvenida-titulo card-header card-title">Mándanos un correo</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="emailUsuario" class="form-label">Tu correo:</label>
                                        <input type="email" id="emailUsuario" class="form-control"
                                            placeholder="tuemail@example.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="asunto" class="form-label">Asunto:</label>
                                        <input type="text" id="asunto" class="form-control" placeholder="Escribe el asunto">
                                    </div>
                                </div>
                                <div class="row pt-3 ">
                                    <div class="col-md-12 d-flex flex-column">
                                        <label for="cuerpo" class="form-label">Mensaje:</label>
                                        <textarea id="cuerpo" class="contactanos-mensaje "
                                            placeholder="Escribe tu mensaje"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-end">
                                <div class="row">
                                    <h6 class="bienvenida-titulo card-title">Información de contacto</h6>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <p class="mt-3">
                                                Calle Gran Via, 12
                                                28013</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button id="botonEnviar" class="btn btn-enviar btn-lg mx-auto">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin de la tarjeta -->
            </div>
        </div>
    </div>

@endsection