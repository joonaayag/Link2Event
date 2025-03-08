@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('contenido')

    <video autoplay muted loop class="fondo-bienvenida opacidad-video">
        <source src="{{ asset('assets/videos/video_fondo_bienvenida_2.mp4') }}" type="video/mp4">
    </video>

    <div class="container bienvenida-container">
        <div class="row d-flex justify-content-between align-items-center">
            <!-- Columna izquierda-->
            <div class="col-xxl-6 col-xl-12">
                <h1 class="titulo-gigante blanco negrita offset-0 titulo-principal">Link</h1>
                <h1 class="titulo-gigante blanco negrita offset-1 titulo-principal">2</h1>
                <h1 class="titulo-gigante blanco negrita offset-2 titulo-principal">Events</h1>
            </div>

            <!-- Columna derecha-->
            <div class="col-xxl-5 col-xl-12 d-flex flex-column columna-derecha mt-xl-5">
                <div class="d-flex flex-column align-items-start justify-content-between h-100 texto-columna-derecha">
                    <h1 class="negrita mediana blanco">Los mejores eventos</h1>
                    <h2 class="mediana negrita naranjita">Al mejor precio</h2>
                </div>
                <div>
                    <div class="columna-botones d-flex mt-4">
                        <a href="{{ route('registrarse') }}" class="btn btn-registro btn-lg btn-block me-3">Crear
                            cuenta</a>
                        <a href="{{ route('login') }}" class="btn btn-login btn-lg btn-block">Iniciar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
<!-- Tarjeta -->
{{-- <div class="card tarjeta-formulario">
    <div class="card-body">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-8 col-md-12">
                <h1 class="bienvenida-titulo card-title">ReviewStar</h1>
                <h3 class="bienvenida-subtitulo card-subtitle mb-2 text-muted">Descubre las Mejores Ofertas
                    de Conciertos</h3>
                <p class="bienvenida-descripcion card-text">¿Eres amante de la música en vivo? No te pierdas
                    nuestras increíbles ofertas en conciertos.
                    Disfruta de tus artistas favoritos a precios irresistibles y vive una experiencia única.
                </p>

                <h4 class="bienvenida-seccion-titulo negrita">Ofertas Exclusivas</h4>
                <p class="bienvenida-descripcion card-text">Explora nuestra selección de conciertos con
                    descuentos exclusivos.
                    Desde rock hasta música clásica, tenemos algo para todos los gustos.
                    ¡Aprovecha estas ofertas antes de que se agoten!</p>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="columna-botones d-flex flex-column">
                    <a href="{{ route('registrarse') }}" class="btn btn-registro btn-lg btn-block">Crear
                        cuenta</a>
                    <a href="{{ route('login') }}" class="btn btn-login btn-lg btn-block">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Fin de la tarjeta -->