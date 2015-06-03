<?php

add_action( 'admin_init', 'wpstarterDeveloper_footer_settings' );
function wpstarterDeveloper_footer_settings(){

	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-footer', __('Rodapé', 'devhelper'), 'devhelper_developer_display_section', 'devhelper_page' );

	/* ===============================================================
		FIELD: ACTIVE LOGIN WP
	=============================================================== */
	$field_args = array(
		'type'      => 'text',
		'id'        => 'developer_footer_text',
		'name'      => 'developer_footer_text',
		'desc'      => __('Você pode usar HTML aqui.', 'devhelper'),
		'label_for' => 'developer_footer_text',
	); add_settings_field( 'developer_footer_text', __('Texto do Rodapé', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-footer', $field_args );

} // End Function

?>
