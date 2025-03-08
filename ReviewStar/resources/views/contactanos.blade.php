@extends('layouts.base')

@section('titulo', '- Contáctanos')

@section('claseBody', 'class=pagina-contactanos')

@section('contenido')
    <script src="{{ asset('js/scriptCorreo.js') }}" defer></script>
    <script src="{{ asset('js/claseNotificaciones.js') }}" defer></script>

    <!-- Muestra un mensaje de confirmación cuando se actualiza el perfil exitosamente -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notificador = new Notificacion();
                notificador.mostrar("{{ session('success') }}", 4000);
            });
        </script>
    @endif
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
                                <div class="info-contacto d-flex flex-column align-items-center">
                                    <h6 class="bienvenida-titulo card-title text-center w-100">Información de contacto</h6>
                                    <div class="flex-responsive d-flex flex-column align-items-center w-100">
                                        <div class="contact-details w-100 text-center">
                                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo">
                                            <p class="address mt-3">Calle Gran Via, 12<br>28013</p>
                                        </div>
                                        <button id="botonEnviarMensaje" class="btn btn-enviar btn-lg  mt-3">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12 d-flex flex-column">
                                <form action="{{ route('enviarComentario') }}" method="POST"
                                    class="p-3 borde-form-comentario">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="comentario" class="form-label fw-bold">Mándanos un mensaje para atención
                                            prioritaria:</label>
                                        <textarea name="comentario" class="form-control"
                                            placeholder="Escribe tu mensaje"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary btn-registro mt-2">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin de la tarjeta -->

            </div>
        </div>
    </div>

@endsection