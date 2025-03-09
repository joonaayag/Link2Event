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
            <div class="col-lg-7 mx-auto tarjeta-perfil-estilos">
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
                                <div class="col-lg-5 col-md-6 col-12 columna-perfil">
                                    <h6 class="mb-1 naranjita negrita">Nombre completo</h6>
                                    <p>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</p>
                                </div>
                                <div class="col-lg-5 col-md-6 col-12 columna-perfil">
                                    <h6 class="mb-1 naranjita negrita">Correo electrónico</h6>
                                    <p>{{ Auth::user()->email }}</p>
                                </div>
                                <div class="col-lg-2 col-md-6 col-12 d-flex justify-content-center">
                                    <img src="{{ Auth::user()->foto_perfil ? asset('storage/perfiles/' . Auth::user()->foto_perfil) : asset('assets/img/foto-default.png') }}"
                                        alt="Foto de perfil" class="rounded-circle foto-perfil-grande">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-5 col-md-6 col-12 columna-perfil">
                                    <h6 class="mb-1 naranjita negrita">Edad</h6>
                                    <p>{{ Auth::user()->edad }} años</p>
                                </div>
                                <div class="col-lg-5 col-md-6 col-12 columna-perfil">
                                    <h6 class="mb-1 naranjita negrita">País</h6>
                                    <p>{{ Auth::user()->pais }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-5 col-md-6 col-12 columna-perfil">
                                    <h6 class="mb-1 naranjita negrita">Tipo de identificación</h6>
                                    <p>{{ Auth::user()->tipo_identificacion }}</p>
                                </div>
                                <div class="col-lg-5 col-md-6 col-12 columna-perfil">
                                    <h6 class="mb-1 naranjita negrita">Número de identificación</h6>
                                    <p>{{ Auth::user()->num_identificacion }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 columna-direccion">
                                    <h6 class="mb-1 naranjita negrita">Dirección</h6>
                                    <p>{{ Auth::user()->direccion }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection