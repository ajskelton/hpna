<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Post Type: Newsletters
 */

add_action( 'init', 'hpna_newsletters' );

/**
 * Adds Newsletters Custom Post Type
 */
function hpna_newsletters() {
	$labels = array(
		'name'               => _x( 'Newsletters', 'post type general name', 'hpna' ),
		'singular_name'      => _x( 'Newsletter', 'post type singular name', 'hpna' ),
		'menu_name'          => _x( 'Newsletters', 'admin menu', 'hpna' ),
		'name_admin_bar'     => _x( 'Newsletters', 'add new on admin bar', 'hpna' ),
		'add_new'            => _x( 'Add New', 'Newsletter', 'hpna' ),
		'add_new_item'       => __( 'Add New Newsletter', 'hpna' ),
		'new_item'           => __( 'New Newsletter', 'hpna' ),
		'edit_item'          => __( 'Edit Newsletter', 'hpna' ),
		'view_item'          => __( 'View Newsletter', 'hpna' ),
		'all_items'          => __( 'All Newsletters', 'hpna' ),
		'search_items'       => __( 'Search Newsletters', 'hpna' ),
		'parent_item_colon'  => __( 'Parent Newsletter:', 'hpna' ),
		'not_found'          => __( 'No Newsletters found.', 'hpna' ),
		'not_found_in_trash' => __( 'No Newsletters found in Trash.', 'hpna' ),
	);
	
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Newsletters custom post type.' ),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'rewrite'            => array( 'slug' => 'newsletters', 'with_front' => true ),
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-welcome-widgets-menus',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'revisions', 'excerpt', 'editor', 'thumbnail', 'author' ),
	);
	
	register_post_type( 'hpna-newsletters', $args );
}
