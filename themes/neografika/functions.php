<?php

// REMOVE ADMIN BAR FOR NON ADMINS ///////////////////////////////////////////////////

	add_filter('show_admin_bar' ,function($content){
		return ( current_user_can("administrator") ) ? $content : false;
	});

// QUITAR ELEMENTOS DEL MENU DENTRO DEL DASHBOARD ////////////////////////////////////

/*	add_action('admin_menu', function() {
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
	});*/

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
		wp_localize_script('admin-js', 'ajax_url',  get_bloginfo('wpurl').'/wp-admin/admin-ajax.php');
		wp_enqueue_style('admin-css', get_template_directory_uri().'/admin/css/admin.css');
	});

// POST THUMBNAILS SUPPORT ///////////////////////////////////////////////////////////

	if(function_exists( 'add_theme_support' )){
		add_theme_support( 'post-thumbnails' );
	}

	if(function_exists( 'add_image_size' )){
		add_image_size( 'propiedad-thumb', 270, 220, true );
	}


// ADD EXTRA CONFIGURATIONS TO ADMIN MENU ////////////////////////////////////////////

	add_action( 'admin_menu', function(){
		$remove = array(__('Pages'),__('Posts'),__('Tools'),__('Comments'),__('Appearance'));
		remove_dashboard_menus($remove);

		//add_submenu_page( parent_slug, page_title, menu_title, capability, menu_slug, function )
		add_submenu_page('options-general.php', 'datos-contacto', 'Contacto', 'manage_options', 'datos-contacto', 'contact_settings_html');
	});

	function contact_settings_html(){
		require_once 'inc/datos-contacto.php';
	}

// HELPER FUNCTIONS AND CLASSES //////////////////////////////////////////////////////

	/**
	 *
	 * Regresa las imagenes que estan ligadas al post_id
	 *
	 * @param post_id
	 * @return ID
	 * @return meta_value
	 *
	 **/
	function scrub_get_attachment_images($post_id){
		global $wpdb;
		return $wpdb->get_results(
			"SELECT ID, meta_value AS dir FROM wp_posts
				INNER JOIN wp_postmeta
					ON ID = post_id
						AND meta_key    = '_wp_attached_file'
						AND post_parent = '$post_id';", OBJECT
		);
	}

	/**
	 *
	 * Ajax callback function para eliminar attachments
	 *
	 * @param post_id
	 * @return false on failure, post data on success
	 *
	 **/
	function delete_attachment(){
		$result = wp_delete_attachment( $_POST['post_id'], true );
		echo json_encode($result);
		exit;
	}
	add_action('wp_ajax_delete_attachment', 'delete_attachment');
	add_action('wp_ajax_nopriv_delete_attachment', 'delete_attachment');

	/**
	 *
	 * Regresa los productos con meta data y categoria
	 *
	 * @return ID  content
	 * @return title
	 * @return content
	 * @return subtitle
	 * @return price
	 * @return sku
	 * @return size
	 * @return category
	 *
	 **/
	function get_products_data(){
		global $wpdb;
		return $wpdb->get_results(
			"SELECT  ID, post_title as title, post_content as content, post_excerpt as subtitle,
				pm1.meta_value as price, pm2.meta_value as sku, pm3.meta_value as size, name as category FROM wp_posts
				JOIN wp_postmeta AS pm1 ON pm1.post_id = ID AND pm1.meta_key = '_unit_price'
				JOIN wp_postmeta AS pm2 ON pm2.post_id = ID AND pm2.meta_key = '_stock_keeping_unit'
				JOIN wp_postmeta AS pm3 ON pm3.post_id = ID AND pm3.meta_key = '_product_size'
					INNER JOIN wp_term_relationships AS tr ON ID = tr.object_id
					INNER JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
					INNER JOIN wp_terms AS t ON tt.term_id = t.term_id
						WHERE post_status = 'publish';", OBJECT
		);
	}

	/**
	 * Quita elementos del sidebar dentro del dashboard
	 *
	 * @param  remove : (Array) Arreglo con los elementos que se omitiran
	 *
	 **/
	function remove_dashboard_menus($remove){
			global $menu; end($menu);
		while(prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL ? $value[0] : '' , $remove)){
				unset( $menu[key($menu)] );
			}
		}
	}