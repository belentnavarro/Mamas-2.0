// Variales
const email = document.getElementById('email');
const password = document.getElementById('password');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');


(function () {
    'use strict';
    window.addEventListener('load', function () {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.stopPropagation();
                    event.preventDefault();
                    mostrarEmailError();
                    mostrarPasswordError();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Función para mostrar los errores del email
function mostrarEmailError() {
    if (email.validity.valueMissing) {
        // Si el campo está vacío
        emailError.textContent = 'Debe introducir una dirección de correo electrónico.';
    } else if (email.validity.patternMismatch) {
        // Si el password no sigue el patrón
        emailError.textContent = 'El valor introducido debe ser una dirección de correo electrónico.';
    } else if (email.validity.tooShort) {
        // Si los datos son demasiado cortos
        emailError.textContent = 'El correo electrónico debe tener al menos ${ email.minLength } caracteres; ha introducido ${ email.value.length }.';
    }
}

// Función para mostrar los errores del password
function mostrarPasswordError() {
    if (password.validity.valueMissing) {
        // Si el campo está vacío
        passwordError.textContent = 'Debe introducir una contraseña.';
    } else if (password.validity.tooShort) {
        // Si el campo no contiene una dirección de correo electrónico
        passwordError.textContent = '8-10 caracteres, un simbolo, una letra mayuscula y una minuscula.';
    } else if (password.validity.patternMismatch) {
        // Si los datos son demasiado cortos
        passwordError.textContent = '8-10 caracteres, un simbolo, una letra mayuscula y una minuscula.';
    }
}