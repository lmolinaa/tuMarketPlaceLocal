const IPINFO_API_URL = "https://ipinfo.io/json?token=fc7d80166e93dd";

// Elementos del DOM
const locationElement = document.getElementById("coords");
const postalElement = document.querySelector("#postalCode span");
const cityElement = document.querySelector("#city span");
const localidadActual = document.getElementById('localidad');
const mapElement = document.getElementById("map");
const postalCodeElement = document.getElementById('postalCode');
const country = 'Spain';

//Crear el mapa centrado inicialmente en Madrid
const map = L.map(mapElement).setView([40.4168, -3.7038], 16);

// Agregar capa de mapas de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Inicializar el marcador de manera global
let marker = L.marker([40.416775, -3.703790]).addTo(map);

// Función para actualizar el marcador
function updateMarker(lat, lon, city, postalCode) {
    marker.setLatLng([lat, lon]);
    marker.bindPopup(
        `<b>${city || 'Desconocida'}</b><br>Código Postal: ${postalCode || 'No disponible'}`
    ).openPopup();
}

function getSelectedValue() {
    // Buscar en Nominatim por código postal
    const selectedCP = document.getElementById('resultadoCP').value;
    if (selectedCP === '' || selectedCP === null) {
        alert('Por favor, seleccione un código postal');
        return;
    }

    const url = `https://nominatim.openstreetmap.org/search?postalcode=${selectedCP}&country=${country}&format=json`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                const latModificada = data[0].lat;
                const lonModificada = data[0].lon;

                console.log('Latitud:', latModificada, 'Longitud:', lonModificada);

                //Actualizar el mapa y el marcador
                map.setView([latModificada, lonModificada], 16);
                updateMarker(latModificada, lonModificada, data[0].display_name, selectedCP);

            } else {
                console.error('No se encontraron resultados para el código postal:', selectedCP);
                //Creamos un elemento para mostrar el mensaje de error por pantalla
                const errorMessage = document.createElement('div');
                errorMessage.textContent = 'No se encontraron resultados para el código postal: ' + selectedCP;
                errorMessage.style.color = 'red';
                errorMessage.style.marginTop = '8px';

                //Añadir el mensaje de error al DOM
                const alerta = document.querySelector('.mensajeAlerta'); 
                alerta.appendChild(errorMessage);

                //Añadir evento para borrar el mensaje al interactuar con la pantalla
                document.addEventListener('click', function removeErrorMessage() {
                    errorMessage.remove();
                    document.removeEventListener('click', removeErrorMessage);
                });

            }
        })
        .catch(error => console.error('Error al consultar Nominatim:', error));
}

//Función para enviar el código postal a userController.php
function enviarCodigoPostal(codigoPostal) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/marketplace/app/controllers/actionsController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                const select = document.getElementById('resultadoCP');
                select.innerHTML = ''; // Limpiar opciones anteriores
                response.codigosPostales.forEach(cp => {
                    const option = document.createElement('option');
                    option.value = cp.codigo_postal;
                    option.textContent = cp.codigo_postal;
                    if (cp.codigo_postal === codigoPostal) {
                        option.selected = true; // Establecer como seleccionado
                    }
                    select.appendChild(option);
                });
            }
        }
    };
    xhr.send('codigoPostal=' + encodeURIComponent(codigoPostal));
}

// Función principal
(async function getLocationByIP() {
    try {
        const response = await fetch(IPINFO_API_URL);
        if (!response.ok) throw new Error(`Error en la API: ${response.status}`);

        const data = await response.json();
        const { loc, postal, city, region, country } = data;
        if (!loc) throw new Error("No se obtuvo ubicación desde la API.");

        const [lat, lon] = loc.split(",");

        locationElement.innerHTML = `<a href='https://www.google.com/maps?q=${lat},${lon}' target='_blank'>Ver en Google Maps (${lat}, ${lon})</a>`;
        postalElement.textContent = postal || "No disponible";
        cityElement.textContent = city || "No disponible";
        localidadActual.innerHTML = city;

        // Mover el mapa y actualizar el marcador
        map.setView([lat, lon], 16);
        updateMarker(lat, lon, city, postal, region, country);
        
        enviarCodigoPostal(postal || 'No disponible');
    } catch (error) {
        console.error("Error obteniendo la ubicación por IP:", error.message);
        locationElement.textContent = "No se pudo obtener la ubicación.";
    }
})();

function changeCity(idMunicipio) {
    const selectedCity = document.getElementById(idMunicipio).value;
        const url = '/marketplace/app/controllers/actionsController.php';
   
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ city: selectedCity }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); //Nos aseguramos de que estamos obteniendo JSON
        })
        .then((data) => {
            if (data.success) {
                //Limpiamos el select antes de agregar nuevos datos
                const resultadoCP = document.getElementById('resultadoCP');
                resultadoCP.innerHTML = ''; // Eliminamos opciones anteriores

                //Agregamos las nuevas opciones al select
                data.codigosPostales.forEach((cp) => {
                    const option = document.createElement('option');
                    option.value = cp.codigo_postal;
                    option.textContent = `${cp.codigo_postal}`;
                    resultadoCP.appendChild(option);
                });
            } else {
                console.error('Error al cargar códigos postales:', data);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function buscoOfrezcoUbicacion(){
    const porMunicipio = document.getElementById("municipios").value;
    window.location.href = '/marketplace/app/views/actions/serviciosCards.php?municipio=' + porMunicipio;

}
