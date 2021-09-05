<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Post Type: Meeting Minutes
 */

add_action( 'init', 'hpna_meeting_minutes' );

/**
 * Adds Meeting Minutes Custom Post Type
 */
function hpna_meeting_minutes() {
	$labels = array(
		'name'               => _x( 'Meeting Minutes', 'post type general name', 'hpna' ),
		'singular_name'      => _x( 'Meeting Minute', 'post type singular name', 'hpna' ),
		'menu_name'          => _x( 'Meeting Minutes', 'admin menu', 'hpna' ),
		'name_admin_bar'     => _x( 'Meeting Minutes', 'add new on admin bar', 'hpna' ),
		'add_new'            => _x( 'Add New', 'Meeting Minute', 'hpna' ),
		'add_new_item'       => __( 'Add New Meeting Minute', 'hpna' ),
		'new_item'           => __( 'New Meeting Minute', 'hpna' ),
		'edit_item'          => __( 'Edit Meeting Minute', 'hpna' ),
		'view_item'          => __( 'View Meeting Minute', 'hpna' ),
		'all_items'          => __( 'All Meeting Minutes', 'hpna' ),
		'search_items'       => __( 'Search Meeting Minutes', 'hpna' ),
		'parent_item_colon'  => __( 'Parent Meeting Minute:', 'hpna' ),
		'not_found'          => __( 'No Meeting Minutes found.', 'hpna' ),
		'not_found_in_trash' => __( 'No Meeting Minutes found in Trash.', 'hpna' ),
	);
	
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Meeting Minutes custom post type.' ),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'rewrite'            => array( 'slug' => 'minutes', 'with_front' => true ),
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-text-page',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'revisions', 'thumbnail', 'excerpt', 'editor', 'author' ),
	);
	
	register_post_type( 'hpna-meeting-minutes', $args );
}
