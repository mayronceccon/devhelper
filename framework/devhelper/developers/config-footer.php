<?php

add_action( 'admin_init', 'wpstarterDeveloper_footer_settings' );
function wpstarterDeveloper_footer_settings(){
	global $wpstarterversion;

	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-footer', __('Rodapé', 'wpstarter'), 'wpstarter_developer_display_section', 'wpstarter_developer' );

	/* ===============================================================
		FIELD: ACTIVE LOGIN WP
	=============================================================== */
	$field_args = array(
		'type'      => 'text',
		'id'        => 'developer_footer_text',
		'name'      => 'developer_footer_text',
		'desc'      => __('Você pode usar HTML aqui.', 'wpstarter').'<br>'.
					   __('Por padrão o texto é', 'wpstarter').': <b>'.__('Tema', 'wpstarter').'/Framework <a href="http://mattdeveloper.github.io/wpstarter/" target="_blank">WP Starter</a> v'.$wpstarterversion.'.
					   '.__('Por', 'wpstarter').' <a href="http://agencialeggo.com/" target="_blank">'.__('Agência', 'wpstarter').' Leggo</a>.</b>',
		'label_for' => 'developer_footer_text',
	); add_settings_field( 'developer_footer_text', __('Texto do Rodapé', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-footer', $field_args );

} // End Function

?>
