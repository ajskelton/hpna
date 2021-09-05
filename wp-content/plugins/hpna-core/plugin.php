<?php
/**
 * Plugin Name: HPNA Core
 * Plugin URI: https://www.hollywoodpark95822.org
 * Description: The Core functionality for HPNA
 * Version: 1.0.0
 * Author: Anthony Skelton
 * Author URI: https://anthonyskelton.com
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'HPNA_CORE_DIR', dirname( __FILE__ ) );
define( 'HPNA_CORE_LIB', HPNA_CORE_DIR . '/lib' );
define( 'HPNA_CORE_TEMPLATES', HPNA_CORE_LIB . '/templates' );

include_once( HPNA_CORE_LIB . '/functions/general.php' );
include_once( HPNA_CORE_LIB . '/post-types/index.php' );
include_once( HPNA_CORE_LIB . '/taxonomies/index.php' );
// include_once( hpna_CORE_LIB . '/classes/Example.php');