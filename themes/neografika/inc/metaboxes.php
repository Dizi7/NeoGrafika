<?php

// CUSTOM METABOXES //////////////////////////////////////////////////////////////////

	add_action('add_meta_boxes', function(){
		// Productos
		add_meta_box('producto_precio_meta', 'Precio', 'producto_meta_precio_setup', 'producto', 'side', 'low');
		add_meta_box('producto_sku_meta', 'Identificador ', 'producto_meta_sku_setup', 'producto', 'side', 'low');
		add_meta_box('producto_medidas_meta', 'Medidas ', 'producto_meta_medidas_setup', 'producto', 'side', 'low');
		add_meta_box('producto_peso_meta', 'Peso ', 'producto_meta_peso_setup', 'producto', 'side', 'low');
		add_meta_box('producto_fotogaleria_meta', 'Fotogalería', 'producto_meta_fotogaleria_setup', 'producto', 'normal', 'low');

		// Distribuidores
		add_meta_box('distribuidor_info', 'Información Distribuidor', 'show_distribuidor_metabox', 'distribuidor', 'normal', 'low');
	});

// CUSTOM METABOXES CALLBACK FUNCTIONS ///////////////////////////////////////////////

	// Producto: Precio
	function producto_meta_precio_setup($post){
		$precio = get_post_meta($post->ID, '_unit_price', true);
		echo "<input type='number' class='widefat' id='_unit_price' name='_unit_price' value='$precio'/>";
	}

	// Producto: Stock Keeping Unit (Identificador)
	function producto_meta_sku_setup($post){
		$sku = get_post_meta($post->ID, '_stock_keeping_unit', true);
		wp_nonce_field(__FILE__, '_stock_keeping_unit_nonce');
		echo "<input type='text' class='widefat' id='sku' name='_stock_keeping_unit' value='$sku'/>";
	}

	// Producto: Medidas
	function producto_meta_medidas_setup($post){
		$size = get_post_meta($post->ID, '_product_size', true);
		wp_nonce_field(__FILE__, '_product_size_nonce');
		echo "<input type='text' class='widefat' id='size' name='_product_size' value='$size'/>";
	}

	// Producto: Peso
	function producto_meta_peso_setup($post){
		$weight = get_post_meta($post->ID, '_product_weight', true);
		wp_nonce_field(__FILE__, '_product_weight_nonce');
		echo "<input type='text' class='widefat' id='weight' name='_product_weight' value='$weight'/>";
	}


	// Producto: Incluir foto galeria
	function producto_meta_fotogaleria_setup($post){

		wp_nonce_field(__FILE__, '_fotogaleria_meta_nonce');
		//echo '<input type="hidden" name="_fotogaleria_meta_nonce" value="' . wp_create_nonce(__FILE__) . '" />';

		$fotogaleria = get_post_meta($post->ID, '_fotogaleria_meta', true);
		$checked = ($fotogaleria) ? 'checked' : '';

		echo "<div class='inside fotogaleria_container'>";
		echo "<p><input type='checkbox' name='_fotogaleria_meta' $checked /> Incluir fotogaleria</p>";

		if( $images = scrub_get_attachment_images($post->ID) ){
			foreach( $images as $image ) {
				display_image_field( $image );
			} ?>
			<h4 id="image-add-toggle">
				<a href="#image-add">+ Añadir nueva imagen</a>
			</h4>
		<?php } else { ?>
			<div>
				<input type="file" class="" ="input-img" name="_fotogaleria[]">
				<input type="submit" class="button eliminar-img" data-post_id="" value="Eliminar">
				<div class="fotogaleria"></div>
			</div>
			<h4 id="image-add-toggle">
				<a href="#image-add">+ Añadir nueva imagen</a>
			</h4>
			<?php
		}
		echo '</div><!-- inside -->';
	}

	function display_image_field( $image ){
		$uploads_dir = wp_upload_dir();
		echo <<< IMAGE
			<div>
				<input type="file" class="input-img" name="_fotogaleria[]">
				<input type="submit" class="button eliminar-img" data-post_id="$image->ID" value="Eliminar">
				<div class="fotogaleria"
					style="background: url('{$uploads_dir['baseurl']}/$image->dir') no-repeat center center ">
				</div>
			</div>
IMAGE;
	}

	function show_distribuidor_metabox($post){

		$meta       = get_post_meta($post->ID, '_distribuidor_info', true);
		$contacto   = (isset($meta['contacto']))   ? $meta['contacto']   : '';
		$calle      = (isset($meta['calle']))      ? $meta['calle']      : '';
		$colonia    = (isset($meta['colonia']))    ? $meta['colonia']    : '';
		$delegacion = (isset($meta['delegacion'])) ? $meta['delegacion'] : '';
		$pais       = (isset($meta['pais']))       ? $meta['pais']       : '';
		$ciudad     = (isset($meta['ciudad']))     ? $meta['ciudad']     : '';
		$postal     = (isset($meta['postal']))     ? $meta['postal']     : '';
		$telefono   = (isset($meta['telefono']))   ? $meta['telefono']   : '';
		$website    = (isset($meta['website']))    ? $meta['website']    : '';

		echo <<< DISTRIBUIDOR

		<div class="metaField">
			<label for="contacto" class="metaLabel">Persona Contacto</label>
			<input type="text" name="_distribuidor_info[contacto]" id="contacto" class="distribuidor" value="$contacto" />
		</div>

		<div class="metaField">
			<label for="calle" class="metaLabel">Calle y Numero</label>
			<input type="text" name="_distribuidor_info[calle]" id="calle" class="distribuidor" value="$calle" />
		</div>

		<div class="metaField">
			<label for="colonia" class="metaLabel">Colonia</label>
			<input type="text" name="_distribuidor_info[colonia]" id="colonia" class="distribuidor" value="$colonia" />
		</div>

		<div class="metaField">
			<label for="delegacion" class="metaLabel">Delegación</label>
			<input type="text" name="_distribuidor_info[delegacion]" id="delegacion" class="distribuidor" value="$delegacion" />
		</div>

		<div class="metaField">
			<label for="pais" class="metaLabel">País</label>
			<input type="text" name="_distribuidor_info[pais]" id="pais" class="distribuidor" value="$pais" />
		</div>

		<div class="metaField">
			<label for="ciudad" class="metaLabel">Ciudad</label>
			<input type="text" name="_distribuidor_info[ciudad]" id="ciudad" class="distribuidor" value="$ciudad" />
		</div>

		<div class="metaField">
			<label for="postal" class="metaLabel">Codigo Postal</label>
			<input type="text" name="_distribuidor_info[postal]" id="postal" class="distribuidor" value="$postal" />
		</div>

		<div class="metaField">
			<label for="telefono" class="metaLabel">Teléfono</label>
			<input type="text" name="_distribuidor_info[telefono]" id="telefono" class="distribuidor" value="$telefono" />
		</div>

		<div class="metaField">
			<label for="website" class="metaLabel">Website</label>
			<input type="text" name="_distribuidor_info[website]" id="website" class="distribuidor" value="$website" />
		</div>

DISTRIBUIDOR;
		wp_nonce_field(__FILE__, '_distribuidor_info_nonce');
	}

// SAVE METABOXES DATA ///////////////////////////////////////////////////////////////

	add_action('save_post', function($post_id){

		if( !current_user_can('edit_page', $post_id)){
			return $post_id;
		}

		if(defined('DOING_AUTOSAVE') and DOING_AUTOSAVE){
			return $post_id;
		}

		// Productos: _unit_price
		if(isset($_POST['_unit_price'])){
			update_post_meta($post_id, '_unit_price', $_POST['_unit_price']);
		}

		// Productos: _stock_keeping_unit
		if(isset($_POST['_stock_keeping_unit'])){
			if( !wp_verify_nonce($_POST['_stock_keeping_unit_nonce'], __FILE__)){
				return $post_id;
			}
			update_post_meta($post_id, '_stock_keeping_unit', $_POST['_stock_keeping_unit']);
		}

		// Productos: _product_size
		if(isset($_POST['_product_size'])){
			if( !wp_verify_nonce($_POST['_product_weight_nonce'], __FILE__)){
				return $post_id;
			}
			update_post_meta($post_id, '_product_size', $_POST['_product_size']);
		}

		// Productos: _product_size
		if(isset($_POST['_product_weight'])){
			if( !wp_verify_nonce($_POST['_product_size_nonce'], __FILE__)){
				return $post_id;
			}
			update_post_meta($post_id, '_product_weight', $_POST['_product_weight']);
		}

		// Productos - Fotogalería: _fotogaleria_meta
		if(isset($_POST['_fotogaleria_meta'])){
			update_post_meta($post_id, '_fotogaleria_meta', $_POST['_fotogaleria_meta']);
		}else{
			delete_post_meta($post_id, '_fotogaleria_meta');
		}

		if(!empty($_FILES) and isset($_FILES['_fotogaleria'])){

			if( !wp_verify_nonce($_POST['_fotogaleria_meta_nonce'], __FILE__)){
				return $post_id;
			}

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

		// Distribuidores: _distribuidor_info
		if(isset($_POST['_distribuidor_info'])){
			if( !wp_verify_nonce($_POST['_distribuidor_info_nonce'], __FILE__)){
				return $post_id;
			}
			update_post_meta($post_id, '_distribuidor_info', $_POST['_distribuidor_info']);
		}

	});