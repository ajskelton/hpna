<?php

function register_acf_block_types() {
	
	// register a testimonial block.
	acf_register_block_type( array(
		'name'            => 'cta-card',
		'title'           => __( 'CTA Card' ),
		'description'     => __( 'A custom cta card.' ),
		'render_callback' => 'hpna_acf_block_render_callback',
		'category'        => 'formatting',
		'icon'            => 'admin-comments',
		'keywords'        => array( 'testimonial', 'quote' ),
	) );
}

// Check if function exists and hook into setup.
if ( function_exists( 'acf_register_block_type' ) ) {
	add_action( 'acf/init', 'register_acf_block_types' );
}

function hpna_acf_block_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace( 'acf/', '', $block['name'] );
	
	// include a template part from within the "template-parts/block" folder
	if ( file_exists( get_theme_file_path( "/template-parts/block/content-{$slug}.php" ) ) ) {
		include( get_theme_file_path( "/template-parts/block/content-{$slug}.php" ) );
	}
}