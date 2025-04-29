document.addEventListener("DOMContentLoaded", function() {
    // Obtener el elemento select de la categoría y el de servicios
    var categoriaSelect = document.getElementById("categoria");
    var servicioSelect = document.getElementById("servicio");

    // Función para actualizar el select de servicios
    categoriaSelect.addEventListener("change", function() {
        // Obtener la categoría seleccionada
        var categoriaSeleccionada = categoriaSelect.value;

        // Limpiar el select de servicios
        servicioSelect.innerHTML = "<option value=''>Selecciona un servicio</option>";

        // Verificar si se ha seleccionado una categoría
        if (categoriaSeleccionada) {
            // Obtener los servicios correspondientes a la categoría seleccionada
            var listaServicios = servicios[categoriaSeleccionada];

            // Añadir los servicios al select
            if (listaServicios && Array.isArray(listaServicios)) {
                listaServicios.forEach(function(servicio) {
                    var option = document.createElement("option");
                    option.value = servicio;
                    option.textContent = servicio;
                    servicioSelect.appendChild(option);
                });
            }
        }
    });
});
