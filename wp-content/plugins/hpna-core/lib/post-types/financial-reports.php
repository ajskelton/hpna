<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Post Type: Financial Reports
 */

add_action( 'init', 'hpna_financial_reports' );

/**
 * Adds Financial Reports Custom Post Type
 */
function hpna_financial_reports() {
	$labels = array(
		'name'               => _x( 'Financial Reports', 'post type general name', 'hpna' ),
		'singular_name'      => _x( 'Financial Report', 'post type singular name', 'hpna' ),
		'menu_name'          => _x( 'Financial Reports', 'admin menu', 'hpna' ),
		'name_admin_bar'     => _x( 'Financial Reports', 'add new on admin bar', 'hpna' ),
		'add_new'            => _x( 'Add New', 'Financial Report', 'hpna' ),
		'add_new_item'       => __( 'Add New Financial Report', 'hpna' ),
		'new_item'           => __( 'New Financial Report', 'hpna' ),
		'edit_item'          => __( 'Edit Financial Report', 'hpna' ),
		'view_item'          => __( 'View Financial Report', 'hpna' ),
		'all_items'          => __( 'All Financial Reports', 'hpna' ),
		'search_items'       => __( 'Search Financial Reports', 'hpna' ),
		'parent_item_colon'  => __( 'Parent Financial Report:', 'hpna' ),
		'not_found'          => __( 'No Financial Reports found.', 'hpna' ),
		'not_found_in_trash' => __( 'No Financial Reports found in Trash.', 'hpna' ),
	);
	
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Financial Reports custom post type.' ),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'rewrite'            => array( 'slug' => 'financial-reports', 'with_front' => true ),
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-analytics',
		'show_in_rest'       => true,
		'supports'           => array( 'title', 'revisions', 'thumbnail', 'excerpt', 'editor', 'author' ),
	);
	
	register_post_type( 'hpna-money-reports', $args );
}
