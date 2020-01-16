<?php
/*
 * This is the child theme for Twenty Twenty theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'twenty_twenty_child_enqueue_styles' );
function twenty_twenty_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
/*
 * Your code goes below
 */

/**
 * Enqueue supplemental block editor styles.
 */
function hpna_block_editor_styles() {
	
	$css_dependencies = array();
	
	// Dequeue the Block Styles from Parent Theme, Enqueue the custom editor styles.
	wp_dequeue_style( 'twentytwenty-block-editor-styles' );
	wp_enqueue_style( 'hpna-block-editor-styles', get_theme_file_uri( '/dist/css/editor.css' ), $css_dependencies, wp_get_theme()->get( 'Version' ), 'all' );
}

add_action( 'enqueue_block_editor_assets', 'hpna_block_editor_styles', 2, 1 );

include_once( 'inc/index.php' );


add_action( 'init', 'hpna_remove_parent_actions');
function hpna_remove_parent_actions() {
	remove_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );
}
