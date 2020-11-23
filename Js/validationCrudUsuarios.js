const error = document.getElementById('error-new-user');

const dni = document.getElementById('dni-new-user');
const dniError = document.getElementById('dniError');

const name = document.getElementById('name-new-user');
const nameError = document.getElementById('nameError');

const surname = document.getElementById('surname-new-user');
const surnameError = document.getElementById('surnameError');

const email = document.getElementById('email-new-user');
const emailError = document.getElementById('emailError');

const password = document.getElementById('password-new-user');
const passwordError = document.getElementById('passwordError');

var errorFinal = '';

// Funcion para controlar los errores de los campos
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
                    showDniError();
                    showNameError();
                    showSurnameError();
                    showEmailError();
                    showPasswordError();
                    showError();
                } 
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Función para mostrar los errores del DNI
function showDniError() {
    if (dni.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal + 'Debe introducir un DNI válido.';
    } else if (dni.validity.patternMismatch) {
        // Si el DNI no sigue el patrón
        errorFinal = errorFinal +'El DNI no es válido.';
    } else if (dni.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + 'El DNI debe tener 8 números y una letra.';
    }
}

// Función para mostrar los errores del nombre
function showNameError() {
    if (name.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal +'Introduzca su nombre, por favor.';
    } else if (name.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + 'El nombre es muy corto.';
    }
}

// Función para mostrar los errores del apellido
function showSurnameError() {
    if (surname.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal + 'Introduzca su apellido, por favor.';
    } else if (surname.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + 'El apellido debe tener al menos ${surname.minLength} caracteres.';
    }
}

// Función para mostrar los errores del email
function showEmailError() {
    if (email.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal + 'Debe introducir una dirección de correo electrónico.';
    } else if (email.validity.patternMismatch) {
        // Si el email no sigue el patrón
        errorFinal = errorFinal + 'El valor introducido debe ser una dirección de correo electrónico.';
    } else if (email.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + 'El correo electrónico debe tener al menos ${ email.minLength } caracteres; ha introducido ${ email.value.length }.';
    }
}

// Función para mostrar los errores del password
function showPasswordError() {
    if (password.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal + 'Debe introducir una contraseña.';
    } else if (password.validity.tooShort) {
        // Si el campo es demasiado corto
        errorFinal = errorFinal + '8-10 cáracteres, un símbolo, una letra mayúscula y una minúscula.';
    } else if (password.validity.patternMismatch) {
        // Si el password no sigue el patrón
        errorFinal = errorFinal + '8-10 cáracteres, un símbolo, una letra mayúscula y una minúscula.';
    }
}

function showError(){
    if(errorFinal != null){
        error.textContent = errorFinal;
    } else {
        error.textContent = '';
    }
}
