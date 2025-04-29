function isEmpty(value) {
    return value === null || value === "" || value === undefined;
}

function validarCambioPass() {
    const email = document.getElementById("email").value;
    const password1 = document.getElementById("password").value;
    const password2 = document.getElementById("password2").value;

    let valid = true;

    if (isEmpty(email)) {
        $('#requeridoEmail').text('El campo Email es obligatorio');
        valid = false;
    } else {
        $('#requeridoEmail').text('');
    }

    if (isEmpty(password1)) {
        $('#requeridoPassword1').text('El campo Contraseña es obligatorio');
        valid = false;
    } else {
        $('#requeridoPassword1').text('');
    }

    if (isEmpty(password2)) {
        $('#requeridoPassword2').text('El campo Repite Contraseña es obligatorio');
        valid = false;
    } else {
        $('#requeridoPassword2').text('');
    }

    if (password1 !== password2) {
        $('#passNoIgual').text('Los campos Contraseña no coinciden');
        valid = false;
    } else {
        $('#passNoIgual').text('');
    }

    if (valid) {
        //alert("Todo OK");
        document.getElementById("formCambiarPassword").submit();
    }
}