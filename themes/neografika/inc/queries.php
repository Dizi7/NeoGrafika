<?php


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
			"SELECT ID, post_title AS title, post_content AS content,
					post_excerpt AS subtitle, pm1.meta_value AS meta, name AS category FROM wp_posts
				LEFT OUTER JOIN wp_postmeta AS pm1 ON ID = pm1.post_id AND pm1.meta_key = '_product_meta'
				INNER JOIN wp_postmeta AS pm2 ON ID = pm2.post_id AND pm2.meta_key = '_product_featured' AND pm2.meta_value = 'true'
					JOIN wp_term_relationships AS tr ON ID = tr.object_id
					JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
					JOIN wp_terms AS t ON tt.term_id = t.term_id
						WHERE post_type = 'producto' AND post_status = 'publish';", OBJECT
		);
	}

	/**
	 *
	 * Regresa todos los productos con el term especificado
	 *
	 * @param term slug
	 * @return Array of objects que contiene todos los posts(productos)
	 *
	 **/
	function get_posts_by_term_slug($slug){
		global $wpdb;
		$result = $wpdb->get_results(
			"SELECT * from wp_posts
				INNER JOIN wp_term_relationships as tr
					ON ID = tr.object_id
				INNER JOIN wp_term_taxonomy as tt
					ON tr.term_taxonomy_id = tt.term_taxonomy_id
				INNER JOIN wp_terms as t
					ON t.term_id = tt.term_id
					WHERE t.slug = '$slug'
						AND post_type   = 'producto'
						AND post_status = 'publish'", OBJECT
		);
		return $result;
	}



	function get_product_slider_images($post_id){
		global $wpdb;
		return $wpdb->get_results(
			"SELECT ID, meta_value AS path FROM wp_posts
				INNER JOIN wp_postmeta AS pm ON ID = pm.post_id AND meta_key = '_wp_attached_file'
					WHERE post_content_filtered = 'fotogaleria' AND post_parent = '$post_id';"
		);
	}