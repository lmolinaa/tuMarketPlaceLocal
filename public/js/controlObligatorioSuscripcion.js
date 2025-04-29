document.addEventListener('DOMContentLoaded', function() {
    //Seleccionamos el formulario por ID
    const form = document.getElementById('formSuscripcion');
    //Si el formulario no existe, salir
    if (!form) return;

    const campos = ['categoria', 'servicio', 'titulo', 'fecha', 'detalle', 'imagen', 'serviceMunicipio']; //IDs de los campos a validar
    //Uno de los campos es obligatorio, pero no pueden estar informados  a la vez ambos
    const ibanField = 'iban'; //ID del campo IBAN
    const tarjetaField = 'tarjeta'; //ID del campo Tarje

    form.addEventListener('submit', async function(event) {
        event.preventDefault(); //Prevenir el envío del formulario inicialmente
        let formValido = true;

        //Validación de campos obligatorios
        campos.forEach(function(campo) {
            const input = document.getElementById(campo);
            const errorElement = document.getElementById(campo + '_error');

            if (input) {
                if (input.value.trim() === '') {
                    formValido = false;
                    input.classList.add('error'); //Añadir clase de error
                    if (errorElement) {
                        errorElement.textContent = 'Este campo es obligatorio';
                        errorElement.style.display = 'block';
                    }
                } else {
                    input.classList.remove('error'); //Remover clase de error
                    if (errorElement) {
                        errorElement.textContent = '';
                        errorElement.style.display = 'none';
                    }
                }
            }
        });

        //Validación particular para el IBAN y Tarjeta
        const ibanInput = document.getElementById(ibanField);
        const tarjetaInput = document.getElementById(tarjetaField);
        const ibanErrorElement = document.getElementById(ibanField + '_error');
        const tarjetaErrorElement = document.getElementById(tarjetaField + '_error');

        const ibanValue = ibanInput ? ibanInput.value.replace(/\s+/g, '') : '';
        const tarjetaValue = tarjetaInput ? tarjetaInput.value.replace(/\s+/g, '') : '';

        if (ibanInput) ibanInput.value = ibanValue; //Eliminamos los espacios en IBAN
        if (tarjetaInput) tarjetaInput.value = tarjetaValue; //Eliminamos los espacios en Tarjeta

        if (ibanValue === '' && tarjetaValue === '') {
            formValido = false;
            if (ibanErrorElement) {
                ibanErrorElement.textContent = 'Debe informar el IBAN o la Tarjeta.';
                ibanErrorElement.style.display = 'block';
            }
            if (tarjetaErrorElement) {
                tarjetaErrorElement.textContent = 'Debe informar el IBAN o la Tarjeta.';
                tarjetaErrorElement.style.display = 'block';
            }
        } else if (ibanValue !== '' && tarjetaValue !== '') {
            formValido = false;
            if (ibanErrorElement) {
                ibanErrorElement.textContent = 'Solo puede informar uno de los dos campos: IBAN o Tarjeta.';
                ibanErrorElement.style.display = 'block';
            }
            if (tarjetaErrorElement) {
                tarjetaErrorElement.textContent = 'Solo puede informar uno de los dos campos: IBAN o Tarjeta.';
                tarjetaErrorElement.style.display = 'block';
            }
        } else {
            if (ibanErrorElement) {
                ibanErrorElement.textContent = '';
                ibanErrorElement.style.display = 'none';
            }
            if (tarjetaErrorElement) {
                tarjetaErrorElement.textContent = '';
                tarjetaErrorElement.style.display = 'none';
            }
        }

        // Si todos los campos obligatorios son válidos, llamar a la función de controlPalabrasInadecuadas.js
        if (formValido) {
            const forbiddenWordsValid = await validateForbiddenWords(form);
            //alert(formValido + " - " + forbiddenWordsValid);
            if (forbiddenWordsValid) {
                form.submit();
            }
        }
    });
});

//Esta función se encarga de contar los caracteres en el textarea
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('detalle');
    const counter = document.getElementById('detalle_counter');

    textarea.addEventListener('input', function() {
        const length = textarea.value.length;
        counter.textContent = `${length}/300`;
    });
});

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
    const iban = document.getElementById('iban').value.trim();
    const tarjeta = document.getElementById('tarjeta').value.trim();
    
    const registrarButton = document.getElementById('registrarButton');

    const isIbanValid = iban.length === 24; //De momento es solo para España, por lo que son 24
    const isTarjetaValid = tarjeta.length >= 13 && tarjeta.length <= 19;

    // Verificar las condiciones
    if ((isIbanValid || isTarjetaValid) && !(isIbanValid && isTarjetaValid)) {
        // Habilitar si uno de los dos cumple, pero no ambos
        registrarButton.disabled = false;
    } else {
        // Deshabilitar en cualquier otro caso
        registrarButton.disabled = true;
    }
}
