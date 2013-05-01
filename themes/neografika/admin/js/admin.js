(function($){
	"use strict";

	$(function(){

	// PERMITE GUARDAR INPUT TYPE FILE - METABOXES /////////////////////////

		$('form[id="post"]').attr('enctype', 'multipart/form-data');

	// DISPLAY SELECTED IMAGE REAL TIME ////////////////////////////////////

		$('.input-img').on('change', function(){
			var container = $(this).siblings('.fotogaleria');
			mq_display_file(this, container);
		});

		/**
		 * Despliega la imagen selecionada en el container indicado
		 *
		 * recibe: input[type='file']
		 * recibe: container jQuery para desplegar la imagen
		 *
		 **/
		function mq_display_file(input, container){
			var reader = new FileReader();
			reader.onload = function(e){
				container.attr('style', 'background: url('+ e.target.result +') no-repeat center center ');
			}
			reader.readAsDataURL(input.files[0]);
		}

	// ELIMINAR LA IMAGEN DEL CONTAINER ////////////////////////////////////

		$('.eliminar-img').on('click', function(e){
			e.preventDefault();
			var container  = $(this).siblings('.fotogaleria'),
				file_input = $(this).siblings('.input-img');

			mq_reset_file_input(file_input);
			container.attr('style', 'background: white');
		});

		/**
		 *
		 * Reset/Clean: input[type='file']
		 *
		 **/
		function mq_reset_file_input(input){
			var replacement = input.val('').clone( true );
			input.replaceWith( replacement );
		}


	});

})(jQuery);