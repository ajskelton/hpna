<?php
/**
 * ACF Customizations
 *
 * @package      RBStarter
 * @author       Red Bridge Internet
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

class HPNA_ACF_Customizations {

	public function __construct() {

		// Register options page
		add_action( 'init', array( $this, 'register_options_page' ) );

		// Register Blocks
//		add_action('acf/init', array( $this, 'register_blocks' ) );

	}

	/**
	 * Register Options Page
	 *
	 */
	public function register_options_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( array(
				'title'      => __( 'Site Options', 'rb-starter' ),
				'capability' => 'manage_options',
			) );
		}
	}

	/**
	 * Register Blocks
	 * @link https://www.billerickson.net/building-gutenberg-block-acf/#register-block
	 *
	 * Categories: common, formatting, layout, widgets, embed
	 * Dashicons: https://developer.wordpress.org/resource/dashicons/
	 * ACF Settings: https://www.advancedcustomfields.com/resources/acf_register_block/
	 */
	public function register_blocks() {

		if( ! function_exists('acf_register_block_type') ) {
			return;
		}

	}
}
new HPNA_ACF_Customizations();
