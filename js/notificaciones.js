let ocultar_notificacion = document.querySelector("div.aspa");

if (ocultar_notificacion != null) {
    ocultar_notificacion.addEventListener("click", () => {
        let noti = document.querySelector(".notificacion");
        noti.style.display = "none";
    });
    ocultar_notificacion.addEventListener("click", () => {
        let noti = document.querySelector(".notificacionCarrito");
        noti.style.display = "none";
    });

    //Funciones para mostrar y ocultar las notificaciones de manera automática mediante un setTimeout
    function mostrarNotificacionAuto() {
        let noti = document.querySelector(".notificacion");

        noti.style.opacity = 1;
    }

    function ocultarNotificacionAuto() {
        let noti = document.querySelector(".notificacion");

        noti.style.opacity = 0;
    };
    setTimeout(mostrarNotificacionAuto, 500);
    setTimeout(ocultarNotificacionAuto, 5000);

    function mostrarNotificacionCarritoAuto() {
        let noti = document.querySelector(".notificacionCarrito");

        noti.style.opacity = 1;
    }
    setTimeout(mostrarNotificacionCarritoAuto, 500);
}

// Tooltip iconos
// Inicializa todos los tooltips en la página
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});