@extends('layouts.base')

@section('titulo', '- Mi Perfil')

@section('claseBody', 'class=pagina-perfil')
@section('contenido')
    <script src="{{ asset('js/claseNotificaciones.js') }}" defer></script>
    <div class="container d-flex justify-content-center align-items-center">
        <!-- Muestra un mensaje de confirmación cuando se actualiza el perfil exitosamente -->
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const notificador = new Notificacion();
                    notificador.mostrar("{{ session('success') }}", 4000);
                });
            </script>
        @endif
        <div class="row w-100">
            <!-- Contenido principal -->

            <div class="col-md-8 mx-auto tarjeta-perfil-estilos">
                <!-- Información del perfil -->
                <div class="card mb-4 tarjeta-formulario">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0 negrita">Información personal</h2>
                        <a href="{{ route('perfil.editar') }}" class="btn btn-sm btn-primary btn-registro"
                            id="editarPerfilBtn">
                            <i class="fas fa-edit me-1"></i> Editar
                        </a>
                    </div>
                    <div class="card-body tarjeta-perfil-editar d-flex justify-content-center">
                        <!-- Vista de información (visible por defecto) -->
                        <div id="infoView" class="infoPerfil">
                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-6 col-12 columna-perfil">
                                    <p class="mb-1 naranjita">Nombre completo</p>
                                    <h5>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 columna-perfil">
                                    <p class="mb-1 naranjita">Correo electrónico</p>
                                    <h5>{{ Auth::user()->email }}</h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center">
                                    <img src="{{ Auth::user()->foto_perfil ? asset('storage/perfiles/' . Auth::user()->foto_perfil) : asset('assets/img/foto-default.png') }}"
                                        alt="Foto de perfil" class="rounded-circle foto-perfil-grande">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-6 col-12 columna-perfil">
                                    <p class="mb-1 naranjita">Edad</p>
                                    <h5>{{ Auth::user()->edad }} años</h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 columna-perfil">
                                    <p class="mb-1 naranjita">País</p>
                                    <h5>{{ Auth::user()->pais }}</h5>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-md-6 col-12 columna-perfil">
                                    <p class="mb-1 naranjita">Tipo de identificación</p>
                                    <h5>{{ Auth::user()->tipo_identificacion }}</h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 columna-perfil">
                                    <p class="mb-1 naranjita">Número de identificación</p>
                                    <h5>{{ Auth::user()->num_identificacion }}</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 columna-direccion">
                                    <p class="mb-1 naranjita">Dirección</p>
                                    <h5>{{ Auth::user()->direccion }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection