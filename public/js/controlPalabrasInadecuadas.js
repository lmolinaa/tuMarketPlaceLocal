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
    //alert("hola" + forbiddenWords);
    // Normalizar la cadena de entrada y las palabras prohibidas
    const normalizedInput = normalizeString(input);
    const normalizedForbiddenWords = forbiddenWords.map(word => normalizeString(word));

    const regex = new RegExp(`\\b(${normalizedForbiddenWords.join("|")})(\\w*)\\b`, "gi");
    return regex.test(normalizedInput);
}

//Función para validar palabras prohibidas y enviar el formulario si está todo en orden
async function validateForbiddenWords(form) {
    const forbiddenWords = await loadForbiddenWords();
    let containsForbidden = false;

    const formElements = form.elements;
    for (let element of formElements) {
        if (element.type === 'text' || element.type === 'textarea') {
            if (containsForbiddenWords(element.value, forbiddenWords)) {
                containsForbidden = true;
                break;
            }
        }
    }

    const messageElement = form.querySelector('.mensajeInadecuado');

    if (containsForbidden) {
        if (messageElement) {
            messageElement.textContent = "El texto contiene palabras inapropiadas.";
            messageElement.style.color = "red";
        }
        return false;
    } else {
        if (messageElement) {
            messageElement.textContent = "";
        }
        return true;
    }
}