(function($){
	"use strict";

	$(function(){


	// PERMITE GUARDAR INPUT TYPE FILE - METABOXES /////////////////////////



		$('form[id="post"]').attr('enctype', 'multipart/form-data');



	// DISPLAY SELECTED IMAGE REAL TIME ////////////////////////////////////



		$('.input-img').live('change', function(){
			var container = $(this).siblings('.fotogaleria');
			mq_display_file( this, container );
		});



	// ELIMINAR UNA IMAGEN DE PRODUCTO /////////////////////////////////////



		$('.eliminar-img').live('click', function (e) {
			e.preventDefault();

			var $this      = $(this),
				container  = $this.siblings('.fotogaleria'),
				file_input = $this.siblings('.input-img'),
				post_id    = $this.data('post_id');

			if(post_id){
				delete_attachment_by_id(post_id);
			}

			mq_reset_file_input(file_input);
			container.attr('style', 'background: white');
		});



	// AGREGAR NUEVO CAMPO DE IMAGEN ///////////////////////////////////////



		$('#image-add-toggle').live('click', function (e) {
			e.preventDefault();

			$(this).before(
				$('<div></div>')
					.append('<input type="file" class="input-img" name="_fotogaleria[]">')
					.append('<input type="submit" class="button eliminar-img" data-post_id="" value="Eliminar">')
					.append('<div class="fotogaleria"></div>')
			);
		});

		$('#settings-contacto-message').hide();



	// UPLOADING FILES CALLBACK FUNCTIONS //////////////////////////////////



		var save_attachment = function (attachment) {

			var jqxhr = $.ajax({
				type: 'POST',
				url: ajax_url,
				data: {
					attachment: attachment,
					action: 'set_slider_image'
				}
			});

			jqxhr.done(function (data, textStatus, jqXHR) {
				display_image(data);
			});
		};


		function display_image (json) {
			console.log(json);
			var imagen = $('<img />', {
				src: json.guid
			});
			$('#slider-images').append(imagen);
		}



	// UPLOADING FILES  ////////////////////////////////////////////////////



		var file_frame, attachment;

		$('.upload_image_button').live('click', function (e) {

			e.preventDefault();

			if ( file_frame ) {
				file_frame.open(); return;
			}

			// Crear el media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: $(this).data('uploader_title'),
				button: {
					text: $(this).data('uploader_button_text'),
				},
				multiple: false
			});

			file_frame.on('select', function(){
				attachment = file_frame.state().get('selection').first().toJSON();
				save_attachment(attachment);

			});

			// open the modal
			file_frame.open();
		});



	// SCRUB HELPER FUNCTIONS  /////////////////////////////////////////////



		/**
		 *
		 * Despliega la imagen selecionada en el container indicado
		 * @param: input[type='file']
		 * @param: container jQuery para desplegar la imagen
		 *
		 **/
		function mq_display_file (input, container) {
			var reader = new FileReader();
			reader.onload = function(e){
				container.attr('style', 'background: url('+ e.target.result +') no-repeat center center ');
			}
			reader.readAsDataURL(input.files[0]);
		}


		/**
		 *
		 * Reset/Clean: input[type='file']
		 *
		 **/
		function mq_reset_file_input (input) {
			var replacement = input.val('').clone( true );
			input.replaceWith( replacement );
		}


		/**
		 *
		 * Ajax function para eliminar attachments por id
		 * @param post_id
		 *
		 **/
		function delete_attachment_by_id (post_id) {
			jQuery.ajax({
				type: 'POST',
				url: ajax_url,
				data: {
					post_id: post_id,
					action: 'delete_attachment',
				},
				dataType: 'json'
			})
			.done(function(data, textStatus, jqXHR){
				console.log(data);
			});
		}



	}); //end

})(jQuery);
