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
		$fotogaleria_img_1 = get_post_meta($post->ID, '_fotogaleria_1', true);
		$checked = ($fotogaleria) ? 'checked' : '';

		echo '<pre>';
		print_r($fotogaleria_img_1);
		echo '</pre>';
		?>
		<div class="inside">

			<p><input type='checkbox' name='_fotogaleria_meta' <?= $checked ?>/> Incluir fotogaleria</p>

			<div>
			<!-- <form action="" method="POST" enctype="multipart/form-data"> -->
				<input type="file" class="input-img" id="_fotogaleria_1" name="_fotogaleria_1" value="" size="25">
				<input type="submit" class="button button-primary" value="Guardar">
				<input type="submit" class="button eliminar-img" value="Eliminar">
				<div id="fotogaleria_1" class="fotogaleria"></div>
			<!-- </form> -->
			</div>
			<div>
				<input type="file" class="input-img" id="_fotogaleria_2" name="_fotogaleria_2" value="" size="25">
				<input type="submit" class="button button-primary" value="Guardar">
				<input type="submit" class="button eliminar-img" value="Eliminar">
				<div id="fotogaleria_2" class="fotogaleria"></div>
			</div>

			<div>
				<input type="file" class="input-img" id="_fotogaleria_3" name="_fotogaleria_3" value="" size="25">
				<input type="submit" class="button button-primary" value="Guardar">
				<input type="submit" class="button eliminar-img" value="Eliminar">
				<div id="fotogaleria_2" class="fotogaleria"></div>
			</div>
		</div>
		<?php
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

		if(!empty($_FILES) and isset($_FILES['_fotogaleria_1'])){
			//$upload = wp_upload_bits($_FILES['_fotogaleria_1']['name'], null, wp_remote_get($_FILES['_fotogaleria_1']['tmp_name']));
			$upload = wp_upload_bits($_FILES['_fotogaleria_1']['name'], null, file_get_contents($_FILES['_fotogaleria_1']['tmp_name']));
			if($upload['error'] == false){
				update_post_meta($post_id, '_fotogaleria_1', $upload['url']);
			}
		}


	});