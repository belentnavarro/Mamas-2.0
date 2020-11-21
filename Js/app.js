// Función que abre el sidebar y recalcula el espacio para el contenido

(function($) {
	"use strict";
	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
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