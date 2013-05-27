<?php

// REGISTER SETTINGS AND FIELDS //////////////////////////////////////////////////////

	// add_settings_section( id, title, callback, page )
	add_settings_section('slider_section', 'Imágenes del Slider', '', __FILE__);

	// add_settings_field( id, title, callback, page, section, args )
	add_settings_field('imagenes', 'Selecciona una imagen', 'slider_callback', __FILE__, 'slider_section');

// SETTINGS CALLBACK FUNCTIONS ///////////////////////////////////////////////////////

	// Fehca Selección
	function slider_callback(){
		$seleccion = get_option('fecha_seleccion');
		echo "<button class='button upload_image_button' data-uploader_title='media_test'>Seleccionar imagen</button>";
	} ?>

	<div class="wrap">
		<?php screen_icon('generic'); ?>
		<h2>Imágenes del Slider</h2>
		<form method="POST" action="options.php">
			<?php settings_fields('votacion_iberocine'); ?>
			<?php do_settings_sections(__FILE__); ?>
			<!--
			<p class="submit">
				<input name="submit" type="submit" class="button-primary" value="Guardar Cambios" />
			</p>
			 -->
		</form>
	</div>