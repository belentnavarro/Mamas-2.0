// Event listener para añadir o quitar respuesta
document.addEventListener('click', function (e) {
    // Boton añadir
    if (e.target.id == 'updateOption') {
        e.preventDefault();
        let row = e.target.parentNode.parentNode.parentNode;
        let inputRow = row.querySelector('input');
        inputRow.value = '';
        inputRow.placeholder = 'Nueva respuesta';
    }

});