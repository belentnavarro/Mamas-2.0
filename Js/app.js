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
document.addEventListener('change', function (e) {

    if (e.target.id == 'typeQuestionAdd') {
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
    }
});

// Event listener para añadir o quitar respuesta
document.addEventListener('click', function (e) {
    // Boton añadir
    if (e.target.id == 'moreAnswers') {
        e.preventDefault();
        // Si ya tiene 4 hijos no añado mas
        if (document.getElementsByClassName('answerCount').length < 4) {
            newQuestionOptions();
        }
    }

    if (e.target.id == 'minusAnswers') {
        e.preventDefault();
        if (document.getElementsByClassName('answerCount').length > 1) {
            questionOptionAdd.removeChild(questionOptionAdd.lastChild);
            questionOptionAdd.removeChild(questionOptionAdd.lastChild);
        }

    }
});

// Funcion para mostrar las opciones de la pregunta tipo opciones
function questionOptions() {
    clearQuestionOptions();
    let element = document.createElement('div');
    element.className = 'col-8 answerCount';
    element.innerHTML = `<input type="text" name="answerOption[]" class="form-control" value="" placeholder="Respuesta">`;
    questionOptionAdd.appendChild(element);

    element = document.createElement('div');
    element.className = 'col-2';
    element.innerHTML = `<select class="custom-select" id="answerCorrect" name="answerCorrect[]" required>
                            <option value="1" selecto>Correcta</option>
                            <option value="0">Incorrecta</option>
                         </select>`;
    questionOptionAdd.appendChild(element);

    element = document.createElement('div');
    element.className = 'col-2';
    element.innerHTML = `<a href="#" class="more">
                            <svg class="bi" width="32" height="32" fill="currentColor" id="moreAnswers">
                                <use xlink:href="../Icons/bootstrap-icons.svg#plus-circle"/>
                            </svg>
                         </a>
                         <a href="#">
                            <svg class="bi" width="32" height="32 " fill="currentColor"  id="minusAnswers">
                                <use xlink:href="../Icons/bootstrap-icons.svg#dash-circle"/>
                            </svg>
                         </a>`;
    questionOptionAdd.appendChild(element);

}

// Funcion para mostrar las opciones de la pregunta tipo opciones
function newQuestionOptions() {
    let element = document.createElement('div');
    element.className = 'col-8 mt-2 answerCount';
    element.innerHTML = `<input type="text" name="answerOption[]" class="form-control" value="" placeholder="Respuesta">`;
    questionOptionAdd.appendChild(element);

    element = document.createElement('div');
    element.className = 'col-2 mt-2';
    element.innerHTML = `<select class="custom-select" id="answerCorrect" name="answerCorrect[]" required>
                            <option value="1" selecto>Correcta</option>
                            <option value="0">Incorrecta</option>
                         </select>`;
    questionOptionAdd.appendChild(element);

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
        element.innerHTML = `<input type="text" name="answerOption[]" class="form-control" value="" placeholder="Respuesta">`;
        questionOptionAdd.appendChild(element);
    }
}

// Funcion para limpiar el tipo de pregunta o cuando no tenga nada seleccionado el usuario
function clearQuestionOptions() {
    questionOptionAdd.textContent = '';
}
