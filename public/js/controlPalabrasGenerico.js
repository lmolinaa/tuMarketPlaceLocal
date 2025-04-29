//Función para cargar el archivo JSON que contiene palabras prohibidas
async function loadForbiddenWords() {
    const response = await fetch('/marketplace/public/files/controlPalabras.json');
    const data = await response.json();
    return data.words;
}

//Función para normalizar una cadena eliminando tildes
function normalizeString(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

//Función para verificar si el texto contiene palabras prohibidas guardadas en el JSON a partir del lexema
function containsForbiddenWords(input, forbiddenWords) {
    // Normalizar la cadena de entrada y las palabras prohibidas
    const normalizedInput = normalizeString(input);
    const normalizedForbiddenWords = forbiddenWords.map(word => normalizeString(word));

    const regex = new RegExp(`\\b(${normalizedForbiddenWords.join("|")})(\\w*)\\b`, "gi");
    return regex.test(normalizedInput);
}

//Control de palabras desde el formulario
document.addEventListener('DOMContentLoaded', async function() {
    const forbiddenWords = await loadForbiddenWords();

    //Seleccionar todos los formularios con la clase 'control-form'
    const forms = document.querySelectorAll('.control-form');

    forms.forEach(function(form) {
        form.addEventListener('submit', async function(event) {
            event.preventDefault(); //Prevenir el envío del formulario inicialmente

            const formElements = this.elements;
            let containsForbidden = false;

            for (let element of formElements) {
                if (element.type === 'text' || element.type === 'textarea') {
                    if (containsForbiddenWords(element.value, forbiddenWords)) {
                        containsForbidden = true;
                        break;
                    }
                }
            }

            const messageElement = this.querySelector('.mensajeInadecuado');

            if (messageElement) {
                if (containsForbidden) {
                    messageElement.textContent = "El contenido contiene palabras inapropiadas.";
                    messageElement.style.color = "red";
                } else {
                    //El contenido es apropiado, enviar el formulario
                    messageElement.textContent = "";
                    this.submit();
                }
            } else {
                console.error('No se encontró el elemento .mensajeInadecuado en el formulario.');
            }
        });
    });
});