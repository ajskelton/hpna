<?php

function hpna_color_palette_setup() {
	// Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );
	
	// Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Green', 'hpna' ),
			'slug'  => 'green',
			'color'	=> '#719E40',
		),
		array(
			'name'  => __( 'Olive', 'hpna' ),
			'slug'  => 'olive',
			'color' => '#5F6324',
		),
	) );
}
add_action( 'after_setup_theme', 'hpna_color_palette_setup', 20 );

function hpna_editor_font_sizes() {
	
	add_theme_support( 'disable-custom-font-sizes');
	
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'Small', 'hpna'),
			'size' => 14,
			'slug' => 'sm',
		),
		array(
			'name' => __( 'Base', 'hpna'),
			'size' => 16,
			'slug' => 'base',
		),
		array(
			'name' => __( 'Large', 'hpna' ),
			'size' => 18,
			'slug' => 'lg',
		),
		array(
			'name' => __( 'XL', 'hpna' ),
			'size' => 20,
			'slug' => 'xl',
		),
		array(
			'name' => __( '2XL', 'hpna' ),
			'size' => 24,
			'slug' => '2xl',
		),
		array(
			'name' => __( '3XL', 'hpna' ),
			'size' => 30,
			'slug' => '3xl',
		),
		array(
			'name' => __( '4XL', 'hpna' ),
			'size' => 36,
			'slug' => '4xl',
		),
		array(
			'name' => __( '5XL', 'hpna' ),
			'size' => 48,
			'slug' => '5xl',
		),
		array(
			'name' => __( '6XL', 'hpna' ),
			'size' => 64,
			'slug' => '6xl',
		)
	));
}
add_action( 'after_theme_setup', 'hpna_editor_font_sizes', 20 );

function hpna_register_block_styles() {
	register_block_style( 'core/cover', array(
		'name' => 'page-title',
		'label' => __( 'Page Title' ),
	));
}
add_action( 'after_setup_theme', 'hpna_register_block_styles' );