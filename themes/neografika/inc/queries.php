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