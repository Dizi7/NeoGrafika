<?php

// ELEMENTOS DEL DASHBOARD ///////////////////////////////////////////////////////////

	add_action( 'admin_menu', function(){
		global $menu;
		global $submenu;
		unset( $menu[75] ); // quitar tools
		$menu[5][0] = 'Productos';
		$submenu['edit.php'][5][0] = 'Productos';
		$submenu['edit.php'][10][0] = 'Add Productos';
		$submenu['edit.php'][16][0] = 'News Tags';
		echo '';
	});

	add_action('init', function(){
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;
		$labels->name = 'Productos';
		$labels->singular_name = 'Productos';
		$labels->add_new = 'Nuevo Producto';
		$labels->add_new_item = 'Nuevo Producto';
		$labels->edit_item = 'Editar Producto';
		$labels->new_item = 'Producto';
		$labels->view_item = 'Ver Producto';
		$labels->search_items = 'Buscar Producto';
		$labels->not_found = 'No se encontraron productos';
		$labels->not_found_in_trash = 'No se encontraron productos';
	});



// QUITAR WIDGETS DEL DASHBOARD //////////////////////////////////////////////////////

	add_action('admin_menu', function(){
		//remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
		//remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');
		//remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	});

// CAMBIAR EL CONTENIDO DEL FOOTER EN EL DASHBOARD ///////////////////////////////////

	add_filter('admin_footer_text', function() {
		echo 'Creado por <a href="http://tangentlabs.mx">tangentlabs</a>. Powered by <a href="http://www.wordpress.org">WordPress</a>';
	});

// ENQUEUE JAVASCRIPT AND CSS ////////////////////////////////////////////////////////
/*
	// Definir el paths a los directorios de javascript y css
	define( 'JSPATH', get_template_directory_uri() . '/js/' );
	define( 'CSSPATH', get_template_directory_uri() . '/css/' );

	// enqueue front end javascript y css
	add_action('wp_enqueue_scripts', function(){

		// style.css
		wp_enqueue_style('style', get_stylesheet_uri());

		// modernizr
		wp_register_script( 'modernizr', JSPATH.'modernizr-2.6.2.min.js' );
		wp_enqueue_script('modernizr');

		// functions
		wp_register_script( 'plugins', JSPATH.'plugins.min.js', array('jquery'), false, true);
		wp_enqueue_script('plugins');

		// functions
		wp_register_script( 'functions', JSPATH.'functions.min.js', array('jquery', 'plugins'), false, true);
		wp_enqueue_script('functions');
		wp_localize_script('functions', 'ajax_url', get_bloginfo('wpurl').'/wp-admin/admin-ajax.php');
		wp_localize_script('functions', 'main_url', site_url('/main/'));
		wp_localize_script('functions', 'theme_url', get_bloginfo('template_url'));
		wp_localize_script('functions', 'logout_url', wp_logout_url());
		wp_localize_script('functions', 'tiene_barra', mq_usuario_tiene_barra(wp_get_current_user()->ID));

		// bootstrap
		wp_enqueue_script('bootstrap-js' , JSPATH.'bootstrap.min.js', array('jquery'), false, true);
	});

	add_action('admin_init', function(){
		wp_enqueue_script('custom-js' , get_template_directory_uri().'/admin/js/custom.min.js', array('jquery'), false, true);
		wp_localize_script('custom-js', 'ajax_url', get_bloginfo('wpurl').'/wp-admin/admin-ajax.php');
	});
*/