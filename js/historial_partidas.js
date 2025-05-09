document.addEventListener('DOMContentLoaded', () => {
    // Obtengo los elementos
    const contenedorJuegos = document.getElementById('juegos-container');
    const filtroJuegos = document.getElementById('filtroJuego');


    // Booleano para mostrar mensaje de historial vacío
    let isEmpty = false;
    // Creo la función que me permitirá cambiar el display en función del filtro del juego seleccionado
    function ocultarId(contenedorSelector, idEspecifico) {
        
        if (contenedorSelector) {
            // Obtengo en un array todos los elementos hijos del contenedor de los juegos y los recorro
            Array.from(contenedorSelector.children).forEach(elemento => {
                // Compruebo si el valor del filtro, es por defecto, muestro cada elemento, o si es el del valor del filtro seleccionado
                if (idEspecifico.value == "default" || elemento.id == idEspecifico.value) {
                    elemento.style.display = '';
                    // Si el elemento no es el mismo que el del valor del filtro, lo oculto
                } else if (elemento.id != idEspecifico.value) {
                    elemento.style.display = 'none';
                    console.log(elemento.id);
                    console.log(idEspecifico.value);
                }
            });
        } else {
            console.error('El contenedor no fue encontrado.');
        }
    }

    ocultarId(contenedorJuegos, filtroJuegos);

    // Creo el evento del filtro por juego
    filtroJuegos.addEventListener('change', () => {
        ocultarId(contenedorJuegos, filtroJuegos);
    });


    // ------------- Bloque de código para filtrar por contenido en el input text ------------------------
    // Seleccionar los elementos
    const filtroInput = document.querySelector('#inputCriterio');
    const tabla = document.querySelectorAll('.table');

    // Agregar un event listener al input
    filtroInput.addEventListener('input', () => {
        const textoBusqueda = filtroInput.value.toLowerCase(); // Obtener el texto y convertirlo a minúsculas

        // Iterar sobre cada tabla
        tabla.forEach(tabla => {
            const filas = tabla.querySelectorAll('tbody tr'); // Obtener las filas del tbody de esta tabla

            // Recorrer todas las filas del tbody
            filas.forEach(fila => {
                let textoFila = fila.textContent.toLowerCase(); // Obtener el contenido de la fila en minúsculas

                // Mostrar u ocultar la fila según si coincide con el texto buscado
                if (textoFila.includes(textoBusqueda)) {
                    fila.style.display = ''; // Mostrar la fila
                } else {
                    fila.style.display = 'none'; // Ocultar la fila
                }
            });
        });
    });

    // ------------------------------------------------------------------------------------------------------------------------

    document.getElementById('opcionesGanador')?.addEventListener('change', function () {
        const opcion = this.value;
        const userGanador = document.getElementById('opcionesGanador').value;
        const partidaId = document.getElementById('partidaId').value;
        fetch('../functions/guardar_ganador.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                opcion: opcion,
                usuario: userGanador,
                partida: partidaId
            })
        })
            .then(response => {
                if (response.ok) {
                    // Recargar la página después de guardar para que se muestre el value y no el select
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
    });
});



