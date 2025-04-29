   //Función para manejar el pago con PayPal
   function pagoPaypal() {
    //Obtener la URL actual
    const currentUrl = window.location.href;

    //Comprobar si ya hay un pago confirmado
    if (currentUrl.includes('pago=ok')) {
        //Habilitar el botón de "Registrar"
        document.getElementById('registrarButton').disabled = false;
        alert("El pago ha sido confirmado. Puedes registrar tu suscripción.");
    } else if (currentUrl.includes('pago=ko')) {
        alert("El pago fue cancelado. Inténtalo de nuevo.");
    } else {
        //Enviar el formulario de PayPal
        document.getElementById('paypalForm').submit();
    }
}

//Verificar el estado del pago al cargar la página
window.onload = function () {
    const currentUrl = window.location.href;
    if (currentUrl.includes('pago=ok')) {
        //Habilitar el botón de "Registrar"
        document.getElementById('registrarButton').disabled = false;
    } else if (currentUrl.includes('pago=ko')) {
        alert("El pago fue cancelado. Inténtalo de nuevo.");
    }
};

//Función para habilitar/deshabilitar el botón de "Registrar" basado en el IBAN y número de tarjeta
function pagoInformado() {
    // Obtener el valor de IBAN y tarjeta (eliminar espacios al principio y al final)
    const iban = document.getElementById('iban').value.trim();
    const tarjeta = document.getElementById('tarjeta').value.trim();

    // Establecer las longitudes mínimas y máximas
    const MIN_IBAN_LENGTH = 24; // Longitud del IBAN en España
    const MIN_TARJETA_LENGTH = 13; // Longitud mínima de tarjeta
    const MAX_TARJETA_LENGTH = 19; // Longitud máxima de tarjeta

    // Comprobar si los campos cumplen con los requisitos de longitud
    const isIbanValid = iban.length === MIN_IBAN_LENGTH;
    const isTarjetaValid = tarjeta.length >= MIN_TARJETA_LENGTH && tarjeta.length <= MAX_TARJETA_LENGTH;

    // Habilitar o deshabilitar el botón dependiendo de la validez
    const registrarButton = document.getElementById('registrarButton');
    if (isIbanValid && isTarjetaValid) {
        registrarButton.disabled = false; // Habilitar el botón
    } else {
        registrarButton.disabled = true; // Deshabilitar el botón
    }
}