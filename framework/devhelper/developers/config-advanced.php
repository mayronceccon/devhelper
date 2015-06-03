<?php

add_action( 'admin_init', 'devhelperDeveloper_advanced_settings' );
function devhelperDeveloper_advanced_settings(){
 
	// Register the settings with Validation callback
	register_setting( 'devhelperDeveloper', 'devhelperDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-advanced', __('Avançado', 'devhelper'), 'devhelper_developer_display_section', 'devhelper_page' ); 

	/* ===============================================================
		FIELD: WP HEAD
	=============================================================== */
	$field_args = array(
		'type'      => 'checkbox',
		'id'        => 'developer_advanced_wphead',
		'name'      => 'developer_advanced_wphead',
		'desc'      => __('A função WP Head que é chamada dentro da tag <head></head> do site cria algumas tags, caso você não deseje que estas tags 
						apareçam você pode marcá-las acima.', 'devhelper'),
		'label_for' => 'developer_advanced_wphead',
		'fields'    => array(
			0 => 'feed_links',
			1 => 'EditURI',
			2 => 'wlwmanifest',
			3 => 'generator',
			4 => 'canonical',
			5 => 'shortlink',
		),
	); add_settings_field( 'developer_advanced_wphead', __('WP Head', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-advanced', $field_args );

	/* ===============================================================
		FIELD: GOOGLE ANALYTICS
	=============================================================== */
	$field_args = array(
		'type'      => 'textarea',
		'id'        => 'developer_advanced_google_analytics',
		'name'      => 'developer_advanced_google_analytics',
		'desc'      => __('Quando você se cadastra no Google Analytics você recebe um script do analytics, insira o script completo aqui.', 'devhelper').
					   ' '.__('Campo opcional.', 'devhelper'),
		'label_for' => 'developer_advanced_google_analytics',
		'rows'      => '5'
	); add_settings_field( 'developer_advanced_google_analytics', __('Google Analytics', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-advanced', $field_args );

} // End Function

?>