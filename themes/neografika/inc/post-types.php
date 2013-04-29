<?php

// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////

	add_action('init', function(){
		// post type productos
		$labels = array(
			'name'          => 'Productos',
			'singular_name' => 'Producto',
			'add_new'       => 'Add Producto',
			'add_new_item'  => 'Add New Producto',
			'edit_item'     => 'Edit Producto',
			'new_item'      => 'New Producto',
			'all_items'     => 'All Productos',
			'view_item'     => 'View Producto',
			'search_items'  => 'Search Producto',
			'not_found'     => 'No producto found',
			'menu_name'     => 'Productos'
		);
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'producto' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type('producto', $args);
	});

// ADD COLUMNS TO PRODUCTO POST TYPE ///////////////////////////////////////////////////

	add_filter( 'manage_producto_posts_columns', function( $columns ){
		$result = array_slice($columns, 0, 3, true) +
					array( 'precio' => 'Precio' ) +
						array_slice($columns, 3, count($columns)-3, true);
		return $result;
	});

	add_action( 'manage_posts_custom_column', 'custom_producto_columns', 10, 2 );

	function custom_producto_columns( $column, $post_id ) {
		if( $column == 'precio' ){
			$precio = get_post_meta($post_id, '_precio_meta', TRUE);
			$precio = ($precio) ? $precio : '';
			echo "<input type='number' class='small-text' min='0' step='any' value='$precio' >";
			echo "<button class='button save-precio' data-post='$post_id'>Guardar</button>";
		}
	}