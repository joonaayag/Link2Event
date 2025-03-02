@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('contenido')

    <div class="container bienvenida-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Tarjeta -->
                <div class="card tarjeta-bienvenida">
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
                                    <a href="{{ route('registrarse') }}" class="btn btn-registro btn-lg btn-block">Crear cuenta</a>
                                    <a href="{{ route('login') }}" class="btn btn-login btn-lg btn-block">Iniciar sesión</a>
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