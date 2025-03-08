class Notificacion {
    constructor(contenedor = 'body') {
        this.contenedor = document.querySelector(contenedor);
        this.crearEstilos();
    }

    crearEstilos() {
        const estilos = document.createElement('style');
        estilos.innerHTML = `
            .notificacion {
                position: fixed;
                top: 100px;
                right: 90px;
                background: #333;
                color: white;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                opacity: 0;
                transition: opacity 0.5s, transform 0.5s;
                transform: translateX(100%);
            }
            .notificacion.mostrar {
                opacity: 1;
                transform: translateX(0);
            }
        `;
        document.head.appendChild(estilos);
    }

    mostrar(mensaje, duracion = 3000) {
        const noti = document.createElement('div');
        noti.classList.add('notificacion');
        noti.textContent = mensaje;
        this.contenedor.appendChild(noti);
        
        setTimeout(() => {
            noti.classList.add('mostrar');
        }, 100);

        setTimeout(() => {
            noti.classList.remove('mostrar');
            setTimeout(() => noti.remove(), 500);
        }, duracion);
    }
}