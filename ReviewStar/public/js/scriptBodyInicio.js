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