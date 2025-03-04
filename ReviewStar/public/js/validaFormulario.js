document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const fechaFrom = document.getElementById('fecha_desde').value;
            const fechaTo = document.getElementById('fecha_hasta').value;
            if (fechaFrom && fechaTo && fechaFrom > fechaTo) {
                alert("La fecha de inicio del evento debe ser anterior o igual a la fecha fin.");
                return;
            }
            
            const precioMin = parseFloat(document.getElementById('precio_min').value);
            const precioMax = parseFloat(document.getElementById('precio_max').value);
            if (!isNaN(precioMin) && !isNaN(precioMax) && precioMin > precioMax) {
                alert("El precio mínimo debe ser menor o igual al precio máximo.");
                return;
            }

            const filtros = {
                ciudad: document.getElementById('ciudad').value,
                nombre: document.getElementById('nombre').value,
                fecha_desde: document.getElementById('fecha_desde').value,
                fecha_hasta: document.getElementById('fecha_hasta').value,
                genero: document.getElementById('genero').value,
                precio_min: document.getElementById('precio_min').value,
                precio_max: document.getElementById('precio_max').value,
            };

            document.getElementById('results-container').innerHTML = '<p>Cargando conciertos...</p>';
            
            fetchConcerts(filtros);
        });
    } else {
        console.error('Filter form not found');
    }
});