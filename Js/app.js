// Variables
let typeQuestionAdd = document.getElementById('typeQuestionAdd'); // Variable para coger el tipo pregunta en el crud añadir
let questionOptionAdd = document.getElementById('questionOptionAdd'); // Variable donde vamos a mostrar el tipo de pregunta en el crud añadir


// Función que abre el sidebar y recalcula el espacio para el contenido
(function ($) {
    "use strict";
    var fullHeight = function () {

        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function () {
            $('.js-fullheight').css('height', $(window).height());
        });
    };
    fullHeight();
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
})(jQuery);


// Funcion para modificar la imagen de perfil cuando el usuario la modifica en su perfil
function previewImg(event) {
    let url = new FileReader();
    url.onload = function () {
        let imagen = document.getElementById('imgProfileU');
        imagen.src = url.result;
    };
    url.readAsDataURL(event.target.files[0]);
}

// Event listener para detectar el tipo de pregunta
typeQuestionAdd.addEventListener('change', function () {
    let valueType = typeQuestionAdd.value;
    // Dependiendo del valor llamo a una funcion para el tipo de pregunta
    switch (valueType) {
        case 'option':
            questionOptions();
            break;
        case 'writter':
            questionWritter();
            break;
        case 'number':
            questionNumber();
            break;
        default:
            clearQuestionOptions();
            break;
    }
});

// Funcion para mostrar las opciones de la pregunta tipo opciones
function questionOptions() {
    clearQuestionOptions();
    for (var i = 0, max = 4; i < max; i++) {
        let element = document.createElement('div');
        element.className = 'col-12 mb-2';
        element.innerHTML = `<input type="Text" name="answerWritter" class="form-control" value="" placeholder="Respuesta ${i+1}">`;
        questionOptionAdd.appendChild(element);
    }
}

// Funcion para mostrar las opciones de la pregunta tipo numero
function questionNumber() {
    clearQuestionOptions();
    let element = document.createElement('div');
    element.className = 'col';
    element.innerHTML = `<input type="number" name="answerNumber" class="form-control" value="" placeholder="Respuesta numérica">`;
    questionOptionAdd.appendChild(element);
}

// Funcion para mostrar las opciones de la pregunta tipo redacción
function questionWritter() {
    clearQuestionOptions();
    for (var i = 0, max = 4; i < max; i++) {
        let element = document.createElement('div');
        element.className = 'col';
        element.innerHTML = `<input type="Text" name="answerWritter" class="form-control" value="" placeholder="Palabra clave ${i+1}">`;
        questionOptionAdd.appendChild(element);
    }
}

// Funcion para limpiar el tipo de pregunta o cuando no tenga nada seleccionado el usuario
function clearQuestionOptions() {
    questionOptionAdd.textContent = '';
}
