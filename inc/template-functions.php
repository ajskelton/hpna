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