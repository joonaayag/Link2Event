@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('contenido')
<div class="pagina-bienvenida">
    <div class="container bienvenida-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contenedor-central">
                    <div class="row">

                        <div class="col-md-8">
                            <h2 class="bienvenida-titulo">ReviewStar</h2>
                            <h3 class="bienvenida-subtitulo">Descubre las Mejores Ofertas de Conciertos</h3>
                            <p class="bienvenida-descripcion">¿Eres amante de la música en vivo? No te pierdas nuestras increíbles ofertas en conciertos. 
                            Disfruta de tus artistas favoritos a precios irresistibles y vive una experiencia única.</p>
                            
                            <h4 class="bienvenida-seccion-titulo">Ofertas Exclusivas</h4>
                            <p class="bienvenida-descripcion">Explora nuestra selección de conciertos con descuentos exclusivos. 
                            Desde rock hasta música clásica, tenemos algo para todos los gustos. 
                            ¡Aprovecha estas ofertas antes de que se agoten!</p>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="columna-botones">
                                <a href="{{ route('registrarse') }}" class="btn btn-registro btn-lg">Registrate</a>
                                <a href="{{ route('login') }}" class="btn btn-login btn-lg">Iniciar Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection