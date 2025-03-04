@extends('layouts.base')

@section('titulo', '- Inicio')

@section('claseBody', 'class=inicio')

@section('contenido')
    <script src="{{ asset('js/scriptAPIInicio.js') }}" defer></script>

    <div class="container mt-5">
        <h2>¿Qúe te apetece hacer hoy?</h2>
        <div class="row">
            <div class="col-md-6" id="columnaDeportes">
                
            </div>
            <div class="col-md-6">
                <div class="row" style="background-color: red;">
                    <div class="col-12 mb-3" id="columnaMusica">
                        
                    </div>
                    <div class="col-12" id="columnaArte">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection