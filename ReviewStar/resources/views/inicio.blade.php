@extends('layouts.base')

@section('titulo', '- Inicio')

@section('claseBody', 'class=pagina-inicio')

@section('contenido')
    <script src="{{ asset('js/scriptAPIInicio.js') }}" defer></script>

    <div class="container mt-5">
        <h2 class="negrita grande mb-5">¿Qúe te apetece hacer hoy?</h2>
        <div class="row">
            <div class="col-xl-6 col-lg-12" id="columnaDeportes">

            </div>
            <div class="col-xl-5 col-lg-12 ms-auto d-flex flex-end">
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