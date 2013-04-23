<?php

	add_action('add_meta_boxes', function(){
		add_meta_box('producto_meta', 'Precio', 'producto_meta_setup', 'producto', 'side', 'low');
	});

	add_action('save_post', function($post_id){
		if (!current_user_can('edit_page', $post_id)){
			return $post_id;
		}

		if( isset($_POST['_precio_meta']) ){
			update_post_meta($post_id, '_precio_meta', $_POST['_precio_meta']);
		}
	});

	function producto_meta_setup($post){
		$precio = get_post_meta($post->ID, '_precio_meta', true);
		echo "<input type='text' class='widefat' id='precio' name='_precio_meta' value='$precio'/>";
	}