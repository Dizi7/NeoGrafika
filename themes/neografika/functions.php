<?php

// REMOVE ADMIN BAR FOR NON ADMINS ///////////////////////////////////////////////////

	add_filter('show_admin_bar' ,function($content){
		return ( current_user_can("administrator") ) ? $content : false;
	});

// METABOXES AND TAXONOMIES //////////////////////////////////////////////////////////

	require_once('includes/metaboxes.php');

// FRONT END SCRIPTS AND STYLES //////////////////////////////////////////////////////

	// path a los directorios de javascript y css
	define( 'JSPATH', get_template_directory_uri() . '/js/' );
	define( 'CSSPATH', get_template_directory_uri() . '/css/' );
	define( 'THEMEPATH', get_template_directory_uri() . '/' );


	// front end styles and scripts
	add_action( 'wp_enqueue_scripts', function(){

		if(is_admin()){
			wp_enqueue_script('admin-js', get_template_directory_uri().'/admin/js/admin.js',  array('jquery'), false, true );
			wp_enqueue_style('admin-css', get_template_directory_uri().'/admin/css/admin.css');
		}else{
			// scripts
			wp_enqueue_script('ddsmoothmenu', JSPATH.'ddsmoothmenu.js', '', false, false );
			wp_enqueue_script('isotope', JSPATH.'jquery.isotope.min.js', array('jquery'), false, false );
			wp_enqueue_script('selectnav', JSPATH.'selectnav.js', '', false, false );
			wp_enqueue_script('slickforms', JSPATH.'jquery.slickforms.js', array('jquery'), false, false );
			wp_enqueue_script('easytabs', JSPATH.'jquery.easytabs.min.js', array('jquery'), false, false );
			wp_enqueue_script('fitvids', JSPATH.'jquery.fitvids.js', array('jquery'), false, false );
			wp_enqueue_script('fancybox-pack', JSPATH.'jquery.fancybox.pack.js', array('jquery'), false, false );
			wp_enqueue_script('fancybox-thumbs', JSPATH.'fancybox/helpers/jquery.fancybox-thumbs.js', '', false, false );
			wp_enqueue_script('fancybox-media', JSPATH.'fancybox/helpers/jquery.fancybox-media.js', '', false, false );
			wp_enqueue_script('themepunch', JSPATH.'jquery.themepunch.plugins.min.js', array('jquery'), false, false );
			wp_enqueue_script('revolution', JSPATH.'jquery.themepunch.revolution.min.js', array('jquery'), false, false );
			wp_enqueue_script('touchcarousel', JSPATH.'jquery.touchcarousel-1.2.min.js', array('jquery'), false, false );
			wp_enqueue_script('twitter', JSPATH.'twitter.min.js', '', false, false );
			wp_enqueue_script('boostrapslider', JSPATH.'boostrapslider.js', '', false, false );
			wp_enqueue_script('scripts', JSPATH.'scripts.js',  array('jquery'), false, true );

			// styles
			wp_enqueue_style('style', get_stylesheet_uri());
			wp_enqueue_style('color-red', CSSPATH.'color/red.css');
			wp_enqueue_style('media-queries', CSSPATH.'media-queries.css');
			wp_enqueue_style('fancybox', JSPATH.'fancybox/jquery.fancybox.css');
			wp_enqueue_style('fancybox-helpers', JSPATH.'fancybox/helpers/jquery.fancybox-thumbs.css');
			wp_enqueue_style('google-fonts', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic');
			wp_enqueue_style('fontello-fonts', THEMEPATH .'fonts/fontello.css');
		}
	});

// POST THUMBNAILS SUPPORT ///////////////////////////////////////////////////////////

	if(function_exists( 'add_theme_support' )){
		add_theme_support( 'post-thumbnails' );
	}

	if(function_exists( 'add_image_size' )){
		add_image_size( 'propiedad-thumb', 270, 220, true );
		add_image_size( 'propiedad-thumb', 770, 500, true );
	}

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