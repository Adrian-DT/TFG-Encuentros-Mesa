document.addEventListener('DOMContentLoaded', () => {

    const btnHabilitarModificar = document.querySelector('#btnHabilitarDatos');
    const formularioDatos = document.querySelector('form#modificar_datos');
    const inputDatos = formularioDatos.querySelectorAll('input');

    const inputPassword = document.querySelector('#cambiar_contraseña input');

    btnHabilitarModificar.addEventListener('click', activarFormulario);

    function activarFormulario(evento) {
        if (btnHabilitarModificar.value == "Modificar datos") {
            evento.preventDefault();
            inputDatos.forEach((input, index) => {
                if(index < inputDatos.length - 2) {
                    console.log(`Input ${index + 1}:`, input);
                    // Devolvemos el borde del estilo
                    input.style.border = "solid 1px"
                    // Habilitamos de nuevo los input
                    input.disabled = false;
                }
            });
            // Cambiamos el value del botón
            btnHabilitarModificar.value = "Guardar cambios";
        }
    }

});