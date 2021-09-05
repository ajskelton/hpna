<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Post Type: Events
 */

add_action( 'init', 'hpna_events' );

/**
 * Adds Events Custom Post Type
 */
function hpna_events() {
	$labels = array(
		'name'               => _x( 'Events', 'post type general name', 'hpna' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'hpna' ),
		'menu_name'          => _x( 'Events', 'admin menu', 'hpna' ),
		'name_admin_bar'     => _x( 'Events', 'add new on admin bar', 'hpna' ),
		'add_new'            => _x( 'Add New', 'Event', 'hpna' ),
		'add_new_item'       => __( 'Add New Event', 'hpna' ),
		'new_item'           => __( 'New Event', 'hpna' ),
		'edit_item'          => __( 'Edit Event', 'hpna' ),
		'view_item'          => __( 'View Event', 'hpna' ),
		'all_items'          => __( 'All Events', 'hpna' ),
		'search_items'       => __( 'Search Events', 'hpna' ),
		'parent_item_colon'  => __( 'Parent Event:', 'hpna' ),
		'not_found'          => __( 'No Events found.', 'hpna' ),
		'not_found_in_trash' => __( 'No Events found in Trash.', 'hpna' ),
	);
	
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Events custom post type.' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'rewrite'            => array( 'slug' => 'events', 'with_front' => false ),
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-calendar-alt',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'revisions', 'thumbnail', 'excerpt', 'editor' ),
	);
	
	register_post_type( 'hpna-events', $args );
}
