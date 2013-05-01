<?php

// CUSTOM METABOXES //////////////////////////////////////////////////////////////////

	add_action('add_meta_boxes', function(){
		// Productos
		add_meta_box('producto_precio_meta', 'Precio', 'producto_meta_precio_setup', 'producto', 'side', 'low');
		add_meta_box('producto_fotogaleria_meta', 'Fotogalería', 'producto_meta_fotogaleria_setup', 'producto', 'normal', 'low');
	});

	// Precio Producto
	function producto_meta_precio_setup($post){
		$precio = get_post_meta($post->ID, '_precio_meta', true);
		echo "<input type='text' class='widefat' id='precio' name='_precio_meta' value='$precio'/>";
	}

	// Incluir foto galeria
	function producto_meta_fotogaleria_setup($post){

		wp_nonce_field(__FILE__, '_fotogaleria_meta_nonce');
		//echo '<input type="hidden" name="_fotogaleria_meta_nonce" value="' . wp_create_nonce(__FILE__) . '" />';

		$fotogaleria = get_post_meta($post->ID, '_fotogaleria_meta', true);
		$checked = ($fotogaleria) ? 'checked' : '';

		echo "<div class='inside fotogaleria_container'>";
		echo "<p><input type='checkbox' name='_fotogaleria_meta' $checked /> Incluir fotogaleria</p>";

		if( $images = scrub_get_attachment_images() ){

			foreach( $images as $image ) {
				display_image_field( $image );
			}
		}else{
			?>
			<div class="inside fotogaleria_container">
				<p><input type='checkbox' name='_fotogaleria_meta' <?= $checked ?>/> Incluir fotogaleria</p>
				<div>
					<input type="file" class="input-img" name="_fotogaleria[]">
					<input type="submit" class="button eliminar-img" value="Eliminar">
					<div class="fotogaleria"></div>
				</div>
			</div><!-- inside -->
			<?php
		}
		echo '</div><!-- inside -->';
	}

	function display_image_field( $image = false ){
		$uploads_dir = wp_upload_dir();
		echo<<<IMAGE
			<div>
				<input type="file" class="input-img" name="_fotogaleria[]">
				<input type="submit" class="button eliminar-img" value="Eliminar">
				<div class="fotogaleria" data-post_id="$image->ID"
					style="background: url('{$uploads_dir['baseurl']}/$image->meta_value') no-repeat center center ">
				</div>
			</div>
IMAGE;
	}

// SAVE METABOXES DATA ///////////////////////////////////////////////////////////////

	add_action('save_post', function($post_id){

		if( !current_user_can('edit_page', $post_id)){
			return $post_id;
		}

		if( !wp_verify_nonce($_POST['_fotogaleria_meta_nonce'], __FILE__)){
			return $post_id;
		}

		if(defined('DOING_AUTOSAVE') and DOING_AUTOSAVE){
			return $post_id;
		}

		// Fotogalería: _precio_meta
		if(isset($_POST['_precio_meta'])){
			update_post_meta($post_id, '_precio_meta', $_POST['_precio_meta']);
		}

		// Fotogalería: _fotogaleria_meta
		if(isset($_POST['_fotogaleria_meta'])){
			update_post_meta($post_id, '_fotogaleria_meta', $_POST['_fotogaleria_meta']);
		}else{
			delete_post_meta($post_id, '_fotogaleria_meta');
		}

		if(!empty($_FILES) and isset($_FILES['_fotogaleria'])){

			$uploaded_files = $_FILES['_fotogaleria'];

			foreach($_FILES['_fotogaleria']['name'] as $key => $value){
				if($uploaded_files['error'][$key] == 0){

					$upload     = wp_upload_bits($uploaded_files['name'][$key], null, file_get_contents($uploaded_files['tmp_name'][$key]));
					$filetype   = wp_check_filetype( basename($upload['file']), null );
					$upload_dir = wp_upload_dir();
					$filetitle  = wp_unique_filename($upload_dir, basename($upload['file']));

					$attachment = array(
						'post_mime_type' => $filetype['type'],
						'post_title'     => $filetitle,
						'post_type'      => 'attachment',
						'post_content'   => '',
						'post_status'    => 'inherit'
					);

					$image = $upload_dir['path'].'/'.$filetitle;
					$attach_id = wp_insert_attachment( $attachment, $image, $post_id);

					require_once( ABSPATH . 'wp-admin/includes/image.php' );

					$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
					wp_update_attachment_metadata( $attach_id, $attach_data );
					// set_post_thumbnail( $post_id, $attach_id );
				}
			}
		}

	});