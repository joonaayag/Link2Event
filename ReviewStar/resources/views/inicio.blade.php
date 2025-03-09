@extends('layouts.base')

@section('titulo', '- Inicio')

@section('claseBody', 'class=pagina-inicio')

@section('contenido')
    <script src="{{ asset('js/scriptAPIInicio.js') }}" defer></script>
    <script src="{{ asset('js/claseNotificaciones.js') }}" defer></script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notificador = new Notificacion();
                notificador.mostrar("{{ session('success') }}", 4000);
            });
        </script>
    @endif

    <div class="container mt-5">
        <h2 class="negrita grande mb-5 blanco">¿Qúe te apetece hacer hoy?</h2>
        <div class="row">
            <div class="col-xl-6 col-lg-6" id="columnaDeportes">
                <svg viewBox="25 25 50 50" id="iconoCargando">
                    <circle r="20" cy="50" cx="50"></circle>
                </svg>
            </div>
            <div class="col-xl-5 col-lg-5 ms-auto d-flex flex-end">
                <div class="row">
                    <div class="col-12 mb-5" id="columnaMusica">
                        
                    </div>
                    <div class="col-12" id="columnaArte">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection