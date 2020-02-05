<?php

if ( ! function_exists( 'hpna_load_inline_svg' ) ) :
	/**
	 * Loads an inline svg file from the template directory
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	function hpna_load_inline_svg( $filename ) {
		
		// The Path to the SVG Directory inside the theme
		$svg_path = '/src/images/svg';
		
		if ( file_exists( get_stylesheet_directory() . $svg_path . $filename ) ) {
			
			return file_get_contents( get_stylesheet_directory() . $svg_path . $filename );
		}
		
		return '';
	}
endif;

add_action( 'pre_get_posts', 'hpna_events_pre_get_posts' );
/**
 * Updates the HPNA Events Archive Query
 *
 * Shows future events in chronological order
 *
 * @param $query
 *
 * @return mixed
 */
function hpna_events_pre_get_posts( $query ) {
	
	if ( is_admin() ) {
		return $query;
	}
	
	if ( isset( $query->query_vars['post_type']) && $query->query_vars['post_type'] === 'hpna-events' && $query->is_main_query() ) {
		
		$query->set('orderby', 'meta_value');
		$query->set('order', 'ASC');
		$query->set( 'meta_query', array(
			array(
				'key' => 'date',
				'value' => date('Ymd'),
				'compare' => '>='
			)
		));
		
	}
	
	return $query;
}

function get_the_category_slugs() {
	$categories = get_the_category();
	$category_slugs = array();
	
	foreach ( $categories as $category ) {
		$category_slugs[] = $category->slug;
	}
	
	return $category_slugs;
}

add_action( 'pre_get_posts', 'hpna_build_news_feed' );
function hpna_build_news_feed( WP_Query $query ) {
	if ( is_home() && $query->is_main_query() ) {
		$query->set( 'post_type', array(
			'post',
			'hpna-meeting-minutes',
			'hpna-money-reports',
			'hpna-newsletters'
		));
	}
}

add_filter( 'the_title', 'hpna_custom_titles', 20, 2 );
function hpna_custom_titles( $title, $id ) {
	
	if ( is_admin() ) {
		return $title;
	}
	
	$post_type = get_post_type( $id );
	
	switch( $post_type ) {
		
		case 'hpna-meeting-minutes':
			$title = '<strong>Meeting Minutes</strong>: ' . $title;
			break;
			
		case 'hpna-money-reports':
			$title = '<strong>Financial Report</strong>: ' . $title;
			break;
			
		case 'hpna-newsletters':
			$title = '<strong>Newsletter</strong>: ' . $title;
			break;
	}
	
	
	return $title;
	
}