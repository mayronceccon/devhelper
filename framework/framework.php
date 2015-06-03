<?php

/**
 * Framework Functions Order
 *
 * 00. Remove Developer From Admin Side Menu
 * 01. Version/Languages
 * 02. Theme Path/Root
 * 03. Admin Developer Styles & Scripts
 * 04. Admin Theme Options Styles & Scripts
 * 05. Include Advanced Custom Fields
 * 06. Developers
 * 07. Import Advanced Custom Fields
 * 08. Creating Functions To CSS * JS
 * 09. TimThumb Config
 *
**/



/* ===============================================================
	REMOVE DEVELOPER FROM ADMIN MENU
=============================================================== */
add_action('plugins_loaded', 'remove_developer_from_admin_menu');
function remove_developer_from_admin_menu(){
$devhelper_current_user_level = wp_get_current_user();
	if( $devhelper_current_user_level->user_level < 10 ){ // Show Developer link on menu only for users with level 10
		hide_developers();
	}
}

function devhelper_remove_developer_options(){ remove_menu_page( 'devhelper_page' ); }
function hide_developers(){ // Cal this function to remove developer from admin side menu
	add_action( 'admin_menu', 'devhelper_remove_developer_options', 999 );
}



/* ===============================================================
	01. LANGUAGE
=============================================================== */
load_theme_textdomain( 'devhelper', DEVHELPER__PLUGIN_DIR.'languages' );



/* ===============================================================
	02. THEME PATH/ROOT
=============================================================== */
define( 'THEMEPATH', DEVHELPER__PLUGIN_DIR ); // For Includes With PHP
define( 'THEMEROOT', get_template_directory_uri() ); // For HTML Path



/* ===============================================================
	03. ADMIN DEVELOPER STYLES & SCRIPTS
=============================================================== */
if( isset($_GET['page']) AND $_GET['page'] == 'devhelper_page' ){ add_action('admin_enqueue_scripts', 'devhelper_admin_scripts_developer'); }
function devhelper_admin_scripts_developer(){
	wp_enqueue_media(); // Cute Upload Media

	wp_enqueue_script('wp-color-picker'); // Color Picker
	wp_enqueue_style('wp-color-picker'); // Color Picker

	wp_enqueue_script('jquery-ui-sortable'); // Ui Sortable

	wp_enqueue_style('devhelper', DEVHELPER__PLUGIN_URL.'framework/devhelper/_assets/css/devhelper-developer.css'); // Styles
	wp_enqueue_script('devhelper-developer', DEVHELPER__PLUGIN_URL.'framework/devhelper/_assets/js/devhelper-developer.js'); // Scripts
}



/* ===============================================================
	04. ADMIN THEME OPTIONS STYLES & SCRIPTS
=============================================================== */
if( isset($_GET['page']) AND $_GET['page'] == 'devhelper_themeoptions' ){ add_action('admin_enqueue_scripts', 'devhelper_admin_scripts_themeoptions'); }
function devhelper_admin_scripts_themeoptions(){
	wp_enqueue_media(); // Cute Upload Media

	wp_enqueue_script('wp-color-picker'); // Color Picker
	wp_enqueue_style('wp-color-picker'); // Color Picker

	wp_enqueue_style('devhelper', DEVHELPER__PLUGIN_URL.'framework/devhelper/_assets/css/devhelper-developer.css'); // Styles
	wp_enqueue_script('devhelper-themeoptions', DEVHELPER__PLUGIN_URL.'framework/devhelper/_assets/js/devhelper-themeoptions.js'); // Scripts
}



/* ===============================================================
	05. INCLUDE ADVANCED CUSTOM FIELDS
=============================================================== */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( !is_plugin_active('advanced-custom-fields/acf.php') AND !is_plugin_active('advanced-custom-fields-pro/acf.php') ){
	define( 'ACF_LITE', true ); // Set Advanced Custom Fields Lite
	require_once( DEVHELPER__PLUGIN_DIR.'framework/advanced-custom-fields/acf.php' ); // Include Plugin
}



/* ===============================================================
	06. DEVELOPERS
=============================================================== */
require_once( DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/_config.php' );



/* ===============================================================
	07. IMPORT ADVANCED CUSTOM FIELDS
=============================================================== */
require_once( DEVHELPER__PLUGIN_DIR.'framework/devhelper/customfields/developer-seo.php' ); // Fields for SEO
require_once( DEVHELPER__PLUGIN_DIR.'framework/devhelper/customfields/developer-customposttypes.php' ); // Fields for SEO
require_once( DEVHELPER__PLUGIN_DIR.'framework/devhelper/customfields/themeoptions-create.php' ); // Create a Option for Theme Options



/* ===============================================================
	08. CREATING FUNCTIONS TO CSS * JS
=============================================================== */
require_once( DEVHELPER__PLUGIN_DIR.'framework/devhelper/wp-enqueue-scripts.php' );
require_once( DEVHELPER__PLUGIN_DIR.'framework/devhelper/wp-enqueue-styles.php' );



/* ===============================================================
	09. TIMTHUMB CONFIG
=============================================================== */
function thumb($src='', $width=100, $height=100, $crop=1, $quality=80){
	return THEMEROOT.'framework/thumb/?src='.$src.'&w='.$width.'&h='.$height.'&zc='.$crop.'&q='.$quality;
}

?>
