<?php

// REMOVE ADMIN BAR FOR NON ADMINS ///////////////////////////////////////////////////

	add_filter('show_admin_bar' ,function($content){
		return ( current_user_can("administrator") ) ? $content : false;
	});

// QUITAR ELEMENTOS DEL MENU DENTRO DEL DASHBOARD ////////////////////////////////////

	add_action('admin_menu', function() {
		// quitar estos elementos
		$remove = array(__('Pages'),__('Posts'),__('Tools'),__('Comments'),__('Appearance'));

		// global menu object
		global $menu; end($menu);

		// filtrar y quitar los elementos
		while(prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL ? $value[0] : '' , $remove)){
				unset( $menu[key($menu)] );
			}
		}
	});

// POST TYPES, METABOXES AND TAXONOMIES //////////////////////////////////////////////

	require_once('inc/metaboxes.php');

	require_once('inc/post-types.php');

// FRONT END SCRIPTS AND STYLES //////////////////////////////////////////////////////

	// path a los directorios de javascript y css
	define( 'JSPATH', get_template_directory_uri() . '/js/' );
	define( 'CSSPATH', get_template_directory_uri() . '/css/' );
	define( 'THEMEPATH', get_template_directory_uri() . '/' );

	// front end styles and scripts
	add_action( 'wp_enqueue_scripts', function(){

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
	});

	add_action( 'admin_init', function(){
		wp_enqueue_script('admin-js', get_template_directory_uri().'/admin/js/admin.js',  array('jquery'), false, true );
		wp_enqueue_style('admin-css', get_template_directory_uri().'/admin/css/admin.css');
	});

// POST THUMBNAILS SUPPORT ///////////////////////////////////////////////////////////

	if(function_exists( 'add_theme_support' )){
		add_theme_support( 'post-thumbnails' );
	}

	if(function_exists( 'add_image_size' )){
		add_image_size( 'propiedad-thumb', 270, 220, true );
		add_image_size( 'propiedad-thumb', 770, 500, true );
	}

function scrub_get_attachment_images(){
	global $wpdb;
	return $wpdb->get_results(
		"SELECT ID, meta_value FROM wp_posts
			INNER JOIN wp_postmeta
				ON ID = post_id
					AND meta_key    = '_wp_attached_file'
					AND post_parent = 25;", OBJECT
	);
}