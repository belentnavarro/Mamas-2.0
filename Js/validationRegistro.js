// Variales
const email = document.getElementById('email');
const emailError = document.getElementById('emailError');

const password = document.getElementById('password');
const passwordError = document.getElementById('passwordError');

const dni = document.getElementById('dni');
const dniError = document.getElementById('dniError');

const name = document.getElementById('name');
const nameError = document.getElementById('nameError');

const surname = document.getElementById('surname');
const surnameError = document.getElementById('surnameError');

const profileImg = document.getElementById('profileImg');

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
                    showEmailError();
                    showPasswordError();
                    showNameError();
                    showSurnameError();
                    showDniError();
                }
                if (validityImg(profileImg)) {
                    event.stopPropagation();
                    event.preventDefault();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Función para mostrar los errores del email
function showEmailError() {
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

// Función para mostrar los errores del email
function showDniError() {
    if (dni.validity.valueMissing) {
        // Si el campo está vacío
        dniError.textContent = 'Debe introducir un Dni valido';
    } else if (dni.validity.patternMismatch) {
        // Si el password no sigue el patrón
        dniError.textContent = 'El Dni introducido no es valido';
    } else if (dni.validity.tooShort) {
        // Si los datos son demasiado cortos
        dniError.textContent = 'El correo electrónico debe tener 8 numero y una letra';
    }
}

// Función para mostrar los errores del password
function showPasswordError() {
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

// Función para mostrar los errores del nombre
function showNameError() {
    if (name.validity.valueMissing) {
        // Si el campo está vacío
        nameError.textContent = 'Introduzca su nombre por favor.';
    } else if (name.validity.typeMismatch) {
        // Si el campo no contiene un nombre valido
        nameError.textContent = 'Debe introducir un nombre valido';
    } else if (name.validity.tooShort) {
        // Si los datos son demasiado cortos
        nameError.textContent = `El nombre debe tener al menos 3 caracteres.`;
    } else if (name.validity.patternMismatch) {
        // No coincide con el patron
        nameError.textContent = `El nombre debe empezar con mayusculas seguida de minusculas y no terminar en espacios`;
    }

}

// Función para mostrar los errores del apellido
function showSurnameError() {
    if (surname.validity.valueMissing) {
        // Si el campo está vacío
        surnameError.textContent = 'Introduzca su apellido por favor.';
    } else if (surname.validity.typeMismatch) {
        // Si el campo no contiene un apellido valido
        surnameError.textContent = 'Debe introducir un apellido valido';
    } else if (surname.validity.tooShort) {
        // Si los datos son demasiado cortos
        surnameError.textContent = `El apellido debe tener al menos ${ nombre.minLength } caracteres.`;
    } else if (surname.validity.patternMismatch) {
        // No coincide con el patron
        surnameError.textContent = `El apellido debe empezar con mayusculas seguida de minusculas y no terminar en espacios`;
    }

}

// Función para validar el tipo y el tamaño de la imagen
function validityImg(img) {

    // Si la imagen esta vacia no la evaluo, ya que el sistema le asigna una por defecto en la parte del backend
    if (img.files.length > 0) {
        var fileName = img.files[0].name;
        var fileSize = img.files[0].size;
        console.log(fileSize);

        if (fileSize > 200000) {
            profileImgError.textContent = `La imagen no puede ser mayor a 2 MB`;
        } else {
            // recuperamos la extensión del archivo
            var ext = fileName.split('.').pop();

            // Convertimos en minúscula porque 
            // la extensión del archivo puede estar en mayúscula
            ext = ext.toLowerCase();

            // console.log(ext);
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                    break;
                default:
                    profileImgError.textContent = `El archivo no tiene la extensión adecuada`;
            }
        }
    }
}

// Al carga la nueva imagen limpio el error si lo hay para no confundir al usuario
profileImg.addEventListener("change", function () {
    profileImgError.textContent = ``;
});