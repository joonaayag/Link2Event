@extends('layouts.base')

@section('titulo', '- Sobre nosotros')

@section('claseBody', 'class=pagina-sobre_nosotros')

@section('contenido')
    <div class="container my-5">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="text-left">
                    <h1 class="mb-0 text-light gigante negrita">¿Quienes somos?</h1>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-lg-6">
                            <div class="card tarjeta-formulario mb-4">
                                <div class="card-header">
                                    <h3 class="mb-0 negrita">¿Por qué elegirnos?</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Nuestra misión es ayudarte a encontrar las mejores ofertas disponibles,
                                        comparando precios y mostrando las opciones más convenientes.
                                        Nos enfocamos en brindarte una experiencia rápida y eficiente para que ahorres
                                        tiempo y dinero.
                                    </p>
                                    <p>
                                        Con un diseño intuitivo y recomendaciones precisas, somos tu aliado perfecto para no
                                        perderte ninguna oferta.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">
                            <div class="card tarjeta-formulario mb-4">
                                <img src="{{ asset('assets/img/sobre-nosotros.jpg') }}" alt="Sobre nosotros"
                                    class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                    <div class="row fila-idea">
                        <div class="col-12">
                            <div class="card tarjeta-formulario">
                                <div class="card-header text-center">
                                    <h3 class="mb-0 negrita">¿De dónde surge la idea?</h3>
                                </div>
                                <div class="card-body">
                                    <p class="text-center">
                                        La idea nace de la necesidad de simplificar la búsqueda de ofertas y promociones en
                                        distintas plataformas.
                                        Queremos que encuentres todo en un solo lugar, fácil y rápidamente.
                                        Nuestro equipo trabaja continuamente para mejorar y agregar nuevas funciones,
                                        asegurándonos de que siempre tengas la mejor experiencia.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection