// Variables para añadir el usuario
const errorNewUser = document.getElementById('errorNewUser');

const dniNewUser = document.getElementById('dniNewUser');

const nameNewUser = document.getElementById('nameNewUser');

const surnameNewUser = document.getElementById('surnameNewUser');

const emailNewUser = document.getElementById('emailNewUser');

const passwordNewUser = document.getElementById('passwordNewUser');

// Variables para modificar el usuario
const errorAddUser = document.getElementById('errorAddUser');

const dniAddUser = document.getElementById('dniAddUser');

const nameAddUser = document.getElementById('nameAddUser');

const surnameAddUser = document.getElementById('surnameAddUser');

const emailAddUser = document.getElementById('emailAddUser');

const passwordAddUser = document.getElementById('passwordAddUser');

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
                    showDniErrorNewUser();
                    showNameErrorNewUser();
                    showSurnameErrorNewUser();
                    showEmailErrorNewUser();
                    showPasswordErrorNewUser();
                    showErrorNewUser();
                } 
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// ERRORES EN NUEVO USUARIO

// Función para mostrar los errores del DNI
function showDniErrorNewUser() {
    if (dniNewUser.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal + '- Debe introducir un DNI válido.<br>';
    } else if (dniNewUser.validity.patternMismatch) {
        // Si el DNI no sigue el patrón
        errorFinal = errorFinal +'- El DNI no es válido. ';
    } else if (dniNewUser.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + '- El DNI debe tener 8 números y una letra.<br>';
    }
}

// Función para mostrar los errores del nombre
function showNameErrorNewUser() {
    if (nameNewUser.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal +'- Introduzca su nombre, por favor.<br>';
    } else if (nameNewUser.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + '- El nombre es muy corto.<br>';
    }
}

// Función para mostrar los errores del apellido
function showSurnameErrorNewUser() {
    if (surnameNewUser.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal + '- Introduzca su apellido, por favor.<br>';
    } else if (surnameNewUser.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + '- El apellido debe tener al menos ${surname.minLength} caracteres.<br>';
    }
}

// Función para mostrar los errores del email
function showEmailErrorNewUser() {
    if (emailNewUser.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal + '- Debe introducir una dirección de correo electrónico.<br>';
    } else if (emailNewUser.validity.patternMismatch) {
        // Si el email no sigue el patrón
        errorFinal = errorFinal + '- El valor introducido debe ser una dirección de correo electrónico. ';
    } else if (emailNewUser.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + '- El correo electrónico debe tener al menos ${ email.minLength } caracteres; ha introducido ${ email.value.length }.<br>';
    }
}

// Función para mostrar los errores del password
function showPasswordErrorNewUser() {
    if (passwordNewUser.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal + '- Debe introducir una contraseña.<br>';
    } else if (passwordNewUser.validity.tooShort) {
        // Si el campo es demasiado corto
        errorFinal = errorFinal + '- 8-10 cáracteres, un símbolo, una letra mayúscula y una minúscula.<br>';
    } else if (passwordNewUser.validity.patternMismatch) {
        // Si el password no sigue el patrón
        errorFinal = errorFinal + '- 8-10 cáracteres, un símbolo, una letra mayúscula y una minúscula.<br>';
    }
}

function showErrorNewUser(){
    errorNewUser.innerHTML = errorFinal;
    errorNewUser.style.display = 'block';
    errorFinal = '';
}

/*
// ERRORES EN LA MODIFICACION

// Función para mostrar los errores del nombre
function showNameErrorAddUser() {
    if (nameAddUser.validity.valueMissing) {
        // Si el campo está vacío
        errorFinal = errorFinal +'- Introduzca su nombre, por favor.<br>';
    } else if (nameAddUser.validity.tooShort) {
        // Si los datos son demasiado cortos
        errorFinal = errorFinal + '- El nombre es muy corto.<br>';
    }
}

function showErrorAddUser(){
    errorAddUser.innerHTML = errorFinal;
    errorAddUser.style.display = 'block';
    errorFinal = '';
}

*/