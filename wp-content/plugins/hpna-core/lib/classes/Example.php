<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Example class
Class HpnaExample {
  // Create an instance of the class on a global variable
  static function instantiate() {
    global $hpnaExample;
    if( !is_a($hpnaExample, 'HpnaExample') )
      $hpnaExample = new HpnaExample();
  }

  function __construct( $options = array() ) {
    $this->hooks();
  }

  // Setup hooks here to be loaded on hook 'plugins_loaded'
  private function hooks() {
    add_action( 'init', array( $this, 'example_rewrite' ) );

  }

  /**
   * Example rewrite hook
   */
  public function example_rewrite() {
    add_rewrite_rule('example/filter/?$', 'index.php?s=&filter=example', 'top');
  }

}

// Create an instance when plugins are loaded
//add_action('plugins_loaded', array('HpnaExample', 'instantiate') );