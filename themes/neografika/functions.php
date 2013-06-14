<?php


	// path a los directorios de javascript y css
	define( 'JSPATH', get_template_directory_uri() . '/js/' );
	define( 'CSSPATH', get_template_directory_uri() . '/css/' );
	define( 'THEMEPATH', get_template_directory_uri() . '/' );



// FRONT END SCRIPTS AND STYLES //////////////////////////////////////////////////////



	add_action( 'wp_enqueue_scripts', function(){

		$is_home = is_home() ? 'true' : 'false';

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
		wp_localize_script('scripts', 'ajax_url',  get_bloginfo('wpurl').'/wp-admin/admin-ajax.php');
		wp_localize_script('scripts', 'is_home', $is_home);

		// styles
		wp_enqueue_style('style', get_stylesheet_uri());
		wp_enqueue_style('color-red', CSSPATH.'color/red.css');
		wp_enqueue_style('media-queries', CSSPATH.'media-queries.css');
		wp_enqueue_style('fancybox', JSPATH.'fancybox/jquery.fancybox.css');
		wp_enqueue_style('fancybox-helpers', JSPATH.'fancybox/helpers/jquery.fancybox-thumbs.css');
		wp_enqueue_style('google-fonts', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic');
		wp_enqueue_style('fontello-fonts', THEMEPATH .'fonts/fontello.css');
	});



// ADMIN SCRIPTS AND STYLES //////////////////////////////////////////////////////////



	// Admin scripts and styles
	add_action( 'admin_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script('media-upload');
		wp_enqueue_script('admin-js', get_template_directory_uri().'/admin/js/admin.js',  array('jquery', 'media-upload'), false, true );

		// localize scripts
		wp_localize_script('admin-js', 'ajax_url',  get_bloginfo('wpurl').'/wp-admin/admin-ajax.php');

		wp_enqueue_media();

		// styles
		wp_enqueue_style('admin-css', get_template_directory_uri().'/admin/css/admin.css');

	});



// REMOVE ADMIN BAR FOR NON ADMINS ///////////////////////////////////////////////////



	add_filter('show_admin_bar' ,function($content){
		return ( current_user_can('administrator') ) ? $content : false;
	});



// POST TYPES, METABOXES AND TAXONOMIES //////////////////////////////////////////////



	require_once('inc/metaboxes.php');


	require_once('inc/post-types.php');


	require_once('inc/queries.php');


	require_once('inc/pages.php');



// POST THUMBNAILS SUPPORT ///////////////////////////////////////////////////////////



	if(function_exists( 'add_theme_support' )){
		add_theme_support( 'post-thumbnails' );
	}

	if(function_exists( 'add_image_size' )){
		add_image_size( 'producto_thumb', 270, 220, true );
	}



// REMOVE ELEMENTS FROM DASHBOARD MENU ///////////////////////////////////////////////



	add_action( 'admin_menu', function(){
		$remove = array(__('Posts'),__('Tools'),__('Comments'));
		remove_dashboard_menus($remove);
	});



// SUB MENU PAGE - SLIDER ////////////////////////////////////////////////////////////



	add_action('admin_menu', function () {
	    add_menu_page('slider', 'Neografika', 'administrator', 'main-slider', 'display_slider', '', 81 );
	});

	function display_slider(){

		add_settings_section('slider_section', 'Página Principal', '', __FILE__);

		add_settings_field('imagenes', 'Imágenes del Slider', 'slider_callback', __FILE__, 'slider_section'); ?>

		<div class="wrap">
			<?php screen_icon('generic'); ?>
			<h2>Configuración del Tema</h2>
			<form method="POST" action="options.php">
				<?php settings_fields('votacion_iberocine'); ?>
				<?php do_settings_sections(__FILE__); ?>
			</form>
			<div id="slider-images">
				<?php $images = get_slider_images();
					foreach ($images as $image) {
						echo "<img src='$image->guid' />";
					}?>
			</div>
		</div><?php
	}

	function slider_callback(){
		$seleccion = get_option('fecha_seleccion');
		echo "<button class='button upload_image_button'
					data-uploader_title='Imágenes del Slider'
					data-uploader_button_text='Seleccionar'>
				Seleccionar imagen</button>";
	}



// HELPER FUNCTIONS AND CLASSES //////////////////////////////////////////////////////



	/**
	 * Regresa las imagenes de la fotogaleria
	 * @param post_id
	 * @return array(ID, meta_value as dir) | false
	 */
	function get_fotogaleria_images( $post_id ) {
		global $wpdb;
		return $wpdb->get_results(
			"SELECT ID, meta_value AS dir FROM wp_posts
				INNER JOIN wp_postmeta
					ON ID = post_id
						AND meta_key = '_wp_attached_file'
							WHERE post_parent = '$post_id'
								AND post_content_filtered = 'fotogaleria';", OBJECT
		);
	}



	/**
	 * Regresa los distribuidores y metadata
	 * @param post_id
	 * @return ID
	 * @return meta_value
	 */
/*	function scrub_get_distribuidores(){
		global $wpdb;
		return $wpdb->get_results(
			"SELECT ID,
					post_title AS title,
					meta_value AS meta
				FROM wp_posts
					INNER JOIN wp_postmeta
						ON ID = post_id
						AND meta_key = '_distribuidor_info'
							WHERE post_type = 'distribuidores'
							AND post_status = 'publish';", OBJECT
		);
	}*/


	/**
	 * Regresa las imagenes del slider
	 *
	 */
/*	function get_slider_images(){
		global $wpdb;
		return $wpdb->get_results(
			"SELECT * FROM wp_posts
				INNER JOIN wp_postmeta
					ON ID = post_id
						WHERE meta_key = '_main_slider';", OBJECT
		);
	}*/



	/**
	 * Ajax callback function para eliminar attachments
	 *
	 * @param post_id
	 * @return false on failure, post data on success
	 */
	function delete_attachment(){
		$result = wp_delete_attachment( $_POST['post_id'], true );
		echo json_encode($result);
		exit;
	}
	add_action('wp_ajax_delete_attachment', 'delete_attachment');
	add_action('wp_ajax_nopriv_delete_attachment', 'delete_attachment');



	/**
	 * Crea metadata '_main_slider' para identificar que esta imagen es del main slider
	 *
	 * @param attachment
	 * @return attachment
	 */
	function set_slider_image(){
		$attachment = ( isset($_POST['attachment']) ) ? $_POST['attachment'] : false;
		$result     = update_post_meta($attachment['id'], '_main_slider', 'true');
		echo json_encode($attachment);
	}
	add_action('wp_ajax_set_slider_image', 'set_slider_image');
	add_action('wp_ajax_nopriv_set_slider_image', 'set_slider_image');



	/**
	 * Elimina la metadata del attachment: '_main_slider'
	 *
	 * @param attachment
	 * @return attachment
	 */
	function unset_slider_image(){
		$attachment = ( isset($_POST['attachment']) ) ? $_POST['attachment'] : false;
		delete_post_meta($attachment['id'], '_main_slider');
		echo json_encode($attachment);
	}
	add_action('wp_ajax_unset_slider_image', 'unset_slider_image');
	add_action('wp_ajax_nopriv_unset_slider_image', 'unset_slider_image');



	/**
	 * Quita elementos del sidebar dentro del dashboard
	 * @param  remove : (Array) Arreglo con los elementos que se omitiran
	 */
	function remove_dashboard_menus($remove){

		global $menu; end($menu);

		while( prev($menu) ) {
			$value = explode(' ',$menu[key($menu)][0]);
			if(in_array($value[0] != NULL ? $value[0] : '' , $remove)){
				unset( $menu[key($menu)] );
			}
		}
	}



	function send_new_comment_mail(){
		$message = (isset($_POST['message'])) ? $_POST['message'] : '';
		$name    = (isset($_POST['name']))    ? $_POST['name']    : '';
		$email   = (isset($_POST['email']))   ? $_POST['email']   : '';
		$subject = (isset($_POST['subject'])) ? $_POST['subject'] : '';

		$headers = 'From: wordpress <wordpress@neografika.com>' . "\r\n";

		date_default_timezone_set("Mexico/General");
		$date = date("Y-m-d H:i:s");

		add_filter( 'wp_mail_content_type', 'set_html_content_type' );

		if( $name ){
		   	wp_mail( 'scrub.mx@gmail.com', 'Nuevo Mensaje - NeoGrafika.com',
				   'Fecha: '.$date.'<br />Nombre: '. $name .'<br />Email: '. $email .'<br />Mensaje:<br /><br />'. $message, $headers );
		}else{
			wp_mail( 'scrub.mx@gmail.com', 'Nuevo Mensaje - NeoGrafika.com',
					'Fecha: '.$date.'<br />Mensaje:<br /><br />'. $message, $headers );
		}

		remove_filter( 'wp_mail_content_type', 'set_html_content_type' ); // reset content-type to to avoid conflicts

	}
	add_action('wp_ajax_send_new_comment_mail', 'send_new_comment_mail');
	add_action('wp_ajax_nopriv_send_new_comment_mail', 'send_new_comment_mail');


	function set_html_content_type(){
		return 'text/html';
	}
