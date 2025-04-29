document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formCreateUsers'); // Selecciona el formulario por ID
    if (!form) return; // Si el formulario no existe, salir

    const campos = ['nombre', 'apellido', 'email', 'listMunicipios', 'resultadoCP', 'password', 'id_rol']; // IDs de los campos a validar

    form.addEventListener('submit', async function(event) {
        event.preventDefault(); // Prevenir el envío del formulario inicialmente
        let formValido = true;

        // Obtener el valor de perfil dentro del evento submit
        const perfil = document.getElementById("id_rol").value;
        console.log("Perfil seleccionado: " + perfil);

        // Añadir campos ocultos si el perfil es "Ofrezco servicio"
        if (perfil === "2") {
            const camposOcultos = ['categoria', 'servicio', 'titulo', 'fecha', 'detalle', 'imagen', 'serviceMunicipio']; // IDs de los campos a validar del formulario oculto
            campos.push(...camposOcultos);
        }
        console.log(campos); 

        // Validación de campos obligatorios
        campos.forEach(function(campo) {
            const input = document.getElementById(campo);
            const errorElement = document.getElementById(campo + '_error');

            if (input) {
                if (input.value.trim() === '') {
                    formValido = false;
                    input.classList.add('error'); // Añadir clase de error
                    if (errorElement) {
                        errorElement.textContent = 'Este campo es obligatorio';
                        errorElement.style.display = 'block';
                    }
                } else {
                    // Validar el campo email
                    if (campo === 'email') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(input.value.trim())) {
                            formValido = false;
                            input.classList.add('error'); // Añadir clase de error
                            if (errorElement) {
                                errorElement.textContent = 'Por favor, ingresa un email válido';
                                errorElement.style.display = 'block';
                            }
                        } else {
                            input.classList.remove('error'); // Remover clase de error
                            if (errorElement) {
                                errorElement.textContent = '';
                                errorElement.style.display = 'none';
                            }
                        }
                    }

                    // Validar el campo codigo_postal
                    if (campo === 'resultadoCP') {
                        const codigoPostalRegex = /^\d{5}$/; // Código postal de 5 dígitos
                        if (!codigoPostalRegex.test(input.value.trim())) {
                            formValido = false;
                            input.classList.add('error'); // Añadir clase de error
                            if (errorElement) {
                                errorElement.textContent = 'Por favor, ingresa un código postal válido';
                                errorElement.style.display = 'block';
                            }
                        } else {
                            input.classList.remove('error'); // Remover clase de error
                            if (errorElement) {
                                errorElement.textContent = '';
                                errorElement.style.display = 'none';
                            }
                        }
                    }
                }
            }
        });

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

function toggleServiceForm(value) {
    const serviceForm = document.getElementById('serviceForm');
    if (value === '2') {
        serviceForm.style.display = 'block';
    } else {
        serviceForm.style.display = 'none';
    }
}

//Esta función se encarga de contar los caracteres en el textarea
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('detalle');
    const counter = document.getElementById('detalle_counter');

    textarea.addEventListener('input', function() {
        const length = textarea.value.length;
        counter.textContent = `${length}/300`;
    });
});

//Función para validar de forma asíncrona si ya existe el email
function comprobarEmail(input) {
    var email = $(input).val();
    console.log("Validando correo electrónico:", email); //Agregar un log para depuración

    //Realizar la solicitud AJAX para validar el email
    $.ajax({
        url: '/marketplace/app/controllers/validateEmail.php',
        method: 'POST',
        data: { email: email },
        dataType: 'json', //Asegurarse de que la respuesta se maneje como JSON
        success: function(response) {
            console.log("Respuesta del servidor:", response); //Agregar un log para depuración
            if (response.exists) {
                //Mostrar mensaje de error si el email ya existe
                $('#emailExiste').text('El correo electrónico ya está registrado.');
            } else {
                //Limpiar el mensaje de error si el email no existe
                $('#emailExiste').text('');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error); //Agregar un log para depuración
            $('#emailExiste').text('Ocurrió un error en el servidor.');
        }
    });
}
