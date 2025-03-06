<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReviewStar @yield('titulo')</title>

    <!-- Hay que agregar el Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


    <!-- Link css -->
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">

    <!-- Link iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}" defer></script>
    {{-- <script src="{{ asset('js/concierto.js') }}"></script> --}}
</head>

<body @yield('claseBody')>
    @if (Auth::check())
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container-fluid">
                <!-- Logo -->
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo">

                {{-- Botón desplegable de bootstrap --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'inicio' ? 'active' : '' }}"
                                href="{{ route('inicio') }}">
                                <img src="{{ asset('assets/iconos/home.svg') }}" class="nav-icon" alt="Inicio"> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'eventos' ? 'active' : '' }}"
                                href="{{ route('eventos') }}">
                                <img src="{{ asset('assets/iconos/ticket.svg') }}" class="nav-icon" alt="eventos">
                                Eventos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'sobre' ? 'active' : '' }}"
                                href="{{ route('sobre_nosotros') }}">
                                <img src="{{ asset('assets/iconos/informacion.svg') }}" class="nav-icon"
                                    alt="Sobre Nosotros">
                                Sobre Nosotros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'contactanos' ? 'active' : '' }}"
                                href="{{ route('contactanos') }}">
                                <img src="{{ asset('assets/iconos/contacto.svg') }}" class="nav-icon"
                                    alt="Contactanos">
                                Contacto

                            </a>
                        </li>
                    </ul>

                    @if (Auth::check())
                        <div class="d-flex align-items-center ">
                            <!-- Nombre del usuario a la izquierda -->
                            <p class="navbar-brand parrafo-navbar">{{ Auth::user()->nombre }}
                                {{ explode(' ', Auth::user()->apellidos)[0] }}
                            </p>{{-- Para coger solo el primer apellido --}}

                            <!-- Espaciador que empuja el perfil a la derecha -->
                            <div class="ms-auto">
                                <!-- Dropdown para la foto de perfil -->
                                <div class="dropdown">

                                    <img src="{{ Auth::user()->foto_perfil ? asset('storage/perfiles/' . Auth::user()->foto_perfil) : asset('assets/img/foto-default.png') }}"
                                        alt="Foto de perfil" class="rounded-circle dropdown-toggle foto-perfil"
                                        data-bs-toggle="dropdown" aria-expanded="false">

                                    <!-- Menú desplegable -->
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('perfil') }}">Ver perfil</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        {{-- Condición para el rol ADMIN --}}
                                        @if (Auth::user()->rol === 'ADMIN')
                                            <li><a class="dropdown-item" href="{{ route('admin.panel') }}">Panel de
                                                    Administración</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    @endif

    <!-- Contenido principal -->
    @yield('contenido')

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 ReviewStar. Todos los derechos reservados.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener la ruta actual
            const currentRoute = "{{ Route::currentRouteName() }}";

            // Si estamos en la página de bienvenida, aplicar la clase al body
            if (currentRoute === 'bienvenida') {
                document.body.classList.add('pagina-bienvenida');
            } else {
                // Si estamos en cualquier otra página, asegurarse de que la clase no esté aplicada
                document.body.classList.remove('pagina-bienvenida');
            }
        });
    </script>

</body>

</html>
