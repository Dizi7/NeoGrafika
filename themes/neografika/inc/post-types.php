<?php


// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////


	add_action('init', function(){

	// post type productos
		$labels = array(
			'name'          => 'Productos',
			'singular_name' => 'Producto',
			'add_new'       => 'Nuevo Producto',
			'add_new_item'  => 'Nuevo Producto',
			'edit_item'     => 'Editar Producto',
			'new_item'      => 'Nuevo Producto',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver Producto',
			'search_items'  => 'Buscar Producto',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Productos'
		);
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'coleccion' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'taxonomies'         => array( 'category' ),
			'supports'           => array( 'title', 'editor', 'thumbnail' )
		);
		register_post_type('producto', $args);


	// post type distribuidor
		$labels = array(
			'name'          => 'Distribuidores',
			'singular_name' => 'Distribuidor',
			'add_new'       => 'Nuevo Distribuidor',
			'add_new_item'  => 'Nuevo Distribuidor',
			'edit_item'     => 'Editar Distribuidor',
			'new_item'      => 'Nuevo Distribuidor',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver Distribuidor',
			'search_items'  => 'Buscar Distribuidor',
			'not_found'     => 'No se encontro',
			'menu_name'     => 'Distribuidores'
		);
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'distribuidores' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title' )
		);
		register_post_type('distribuidor', $args);

	});