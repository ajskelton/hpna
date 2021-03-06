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
 * Allows the event to stay up one day past the start time
 *
 * @param $query
 *
 * @return mixed
 */
function hpna_events_pre_get_posts( $query ) {
	
	if ( is_admin() ) {
		return $query;
	}
	
	if ( isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] === 'hpna-events' && $query->is_main_query() && is_archive() ) {
		
		$date = new DateTime();
		date_add( $date, date_interval_create_from_date_string( '-1 day' ) );
		
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );
		$query->set( 'meta_query', array(
			'relationship' => 'AND',
			array(
				'key'     => 'date',
				'value'   => $date->format( 'Ymd' ),
				'compare' => '>='
			),
			array(
				'key' => 'event_type',
				'value' => 'ongoing',
				'compare' => '!='
			)
		) );
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
	
	if (
		$query->is_main_query() &&
		! is_post_type_archive( 'hpna-events' ) &&
		( is_home() )
	) {
		$query->set( 'post_type', array(
			'post',
//			'hpna-meeting-minutes',
//			'hpna-money-reports',
			'hpna-newsletters'
		));
	}
}

add_filter('getarchives_where', 'hpna_custom_getarchives_where' );
function hpna_custom_getarchives_where( $where ) {
	$where = str_replace( "post_type = 'post'", "post_type IN ( 'post', 'hpna-newsletters' )", $where );
	return $where;
}

//add_action( 'get_previous_post_where', 'hpna_news_navigation', 20 );
//add_action( 'get_next_post_where', 'hpna_news_navigation', 20 );
function hpna_news_navigation( $where ) {
	$return = str_replace(
		array( "p.post_type = 'post'", "p.post_type = 'hpna-newsletters'" ),
		"(p.post_type = 'post' OR p.post_type = 'hpna-newsletters')",
		$where
	);
	return $return;
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

/**
 * Returns the times for an HPNA Event Post
 *
 * If no times provided, nothing returned. If only a start time
 * just that is returned. If only an end time, something is wrong and
 * return nothing. If both return the full start and end time string. 
 *
 * @param $start_time
 * @param $end_time
 *
 * @return string
 */
function hpna_event_times( $start_time, $end_time ) {
	
	if ( !$start_time && !$end_time ) {
		return '';
	}
	
	if ( $start_time && !$end_time ) {
		return " | $start_time";
	}
	
	if ( !$start_time && $end_time ) {
		return '';
	}
	
	return " | $start_time &ndash; $end_time";
}

/**
 * Loads an inline svg file from the template directory
 *
 * @param $filename
 *
 * @return string
 */
function hpna_load_inline_svg( $filename ) {
	
	// The Path to the SVG Directory inside the theme
	$svg_path = '/src/images/svg/';
//	dump_and_die(get_stylesheet_directory() . $svg_path . $filename);
	if ( file_exists( get_stylesheet_directory() . $svg_path . $filename ) ) {
		return file_get_contents( get_stylesheet_directory() . $svg_path . $filename );
	}
	
	return '';
}