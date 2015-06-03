<?php
/*
Plugin Name: Dev Helper
Plugin URI: http://mattdeveloper.github.io/devhelper
Version: 0.0.1
Author: Mattheus Oliveira
Author URI: http://mattdeveloper.com
Description: WordPress theme developer helper.
Text Domain: devhelper
*/

// Make sure we don't expose any info if called directly
if ( !function_exists('add_action') ) {
  echo 'Hi there! I\'m just a plugin, not much I can do when called directly.';
  exit;
}

define( 'DEVHELPER_VERSION', '0.0.1' );
define( 'DEVHELPER__MINIMUM_WP_VERSION', '3.8' );
define( 'DEVHELPER__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'DEVHELPER__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if(is_admin()){
  require(DEVHELPER__PLUGIN_DIR.'framework/framework.php');
}
?>