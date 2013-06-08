<?php

// CUSTOM PAGES //////////////////////////////////////////////////////////////////////


	add_action('init', function(){

		// Page Colección
		if( ! get_page_by_path('coleccion') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Colección',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Page Contacto
		if( ! get_page_by_path('contacto') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Contacto',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Page Distribuidores
		if( ! get_page_by_path('distribuidores') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Distribuidores',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Page Nosotros
		if( ! get_page_by_path('nosotros') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Nosotros',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

	});