<?php


// TAXONOMIES ////////////////////////////////////////////////////////////////////////


	add_action( 'init', 'productos_taxonomies', 0 );

	function productos_taxonomies() {

		if( taxonomy_exists( 'category' ) ){
			wp_insert_term( 'Grande', 'category' );
			wp_insert_term( 'Mediano', 'category' );
			wp_insert_term( 'Chico', 'category' );
		}
	}