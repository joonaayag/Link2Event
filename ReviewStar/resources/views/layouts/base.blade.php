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
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Link css -->
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <img src="assets/img/logo.png" class="navbar-brand" alt="Imagen logo">
            </div>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('base') }}">
                        <img src="assets/iconos/home.svg" class="nav-icon" alt="Icono de inicio">
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <img src="assets/iconos/ticket.svg" class="nav-icon" alt="Icono usuario">
                        <span>Conciertos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <img src="assets/iconos/favoritos.svg" class="nav-icon" alt="Icono favoritos">
                        <span>Favoritos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <img src="assets/iconos/informacion.svg" class="nav-icon" alt="Icono de contactanos">
                        <span>Sobre nosotros</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <img src="assets/iconos/contacto.svg" class="nav-icon" alt="Icono de contacto">
                        <span>Contacto</span>
                    </a>
                </li>
            </ul>

            <div class="seccion-usuario">
                <!-- Botón de login/logout -->
                <a class="boton-usuario" href="{{ route('login') }}" id="boton-usuario">
                    <img src="assets/iconos/usuario.svg" class="nav-icon" alt="Icono usuario">
                    <span>Iniciar sesión</span>
                </a>
            </div>

        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container my-4">
        @yield('contenido')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 ReviewStar. Todos los derechos reservados.</p>
    </footer>
    
</body>
</html>