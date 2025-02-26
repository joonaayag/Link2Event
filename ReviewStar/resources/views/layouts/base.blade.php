<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReviewStar @yield('titulo')</title>

    <!-- Hay que agregar el Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Link css -->
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid flex-column">
            <a class="navbar-brand" href="#">ReviewStar</a>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('base') }}" class="nav-link text-white">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link text-white">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('registrarse') }}" class="nav-link text-white">Registrarse</a>
                </li>
            </ul>
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
