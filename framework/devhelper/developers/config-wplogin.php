<?php

add_action( 'admin_init', 'wpstarterDeveloper_wplogin_settings' );
function wpstarterDeveloper_wplogin_settings(){

	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-wplogin', __('WP Login', 'wpstarter'), 'wpstarter_developer_display_section', 'wpstarter_developer' );

	/* ===============================================================
		FIELD: BACKGROUND COLOR
	=============================================================== */
	$field_args = array(
		'type'      => 'color-picker',
		'id'        => 'wplogin_bg_color',
		'name'      => 'wplogin_bg_color',
		'label_for' => 'wplogin_bg_color',
		'default'   => '#ecf0f1',
		'desc'      => __('Escolha a cor de fundo da página de login.', 'wpstarter').' '.__('Por padrão a cor é:', 'wpstarter').' '.'<b>#ecf0f1</b>.'
	); add_settings_field( 'wplogin_bg_color', __('Cor de Fundo', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-wplogin', $field_args );

	/* ===============================================================
		FIELD: LINKS/BUTTON COLOR
	=============================================================== */
	$field_args = array(
		'type'      => 'color-picker',
		'id'        => 'wplogin_color',
		'name'      => 'wplogin_color',
		'label_for' => 'wplogin_color',
		'default'   => '#3498db',
		'desc'      => __('Escolha uma cor para o botão e <b>hover</b> dos links.', 'wpstarter').' '.__('Por padrão a cor é:', 'wpstarter').' '.'<b>#3498db</b>.'
	); add_settings_field( 'wplogin_color', __('Cor do Botão e Links', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-wplogin', $field_args );

	/* ===============================================================
		FIELD: LOGIN IMAGE
	=============================================================== */
	$field_args = array(
		'type'      => 'image',
		'id'        => 'wplogin_image',
		'name'      => 'wplogin_image',
		'label_for' => 'wplogin_image',
		'desc'      => __('Envie uma imagem para aparecer na tela de login do WordPress.', 'wpstarter')
	); add_settings_field( 'wplogin_image', __('Imagem do Login', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-wplogin', $field_args );

	/* ===============================================================
		FIELD: IMAGE URL
	=============================================================== */
	$field_args = array(
		'type'      => 'text',
		'id'        => 'wplogin_url',
		'name'      => 'wplogin_url',
		'label_for' => 'wplogin_url',
		'desc'      => __('Quando clicar na logo do login o usuário vai para o site da Agência Leggo, você pode mudar essa url aqui.', 'wpstarter').
					   '<br>'.__('Valor padrão', 'wpstarter').': https://mattdeveloper.github.com/wpstarter'
	); add_settings_field( 'wplogin_url', __('URL da Logo', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-wplogin', $field_args );

	/* ===============================================================
		FIELD: IMAGE TITLE
	=============================================================== */
	$field_args = array(
		'type'      => 'text',
		'id'        => 'wplogin_title',
		'name'      => 'wplogin_title',
		'label_for' => 'wplogin_title',
		'desc'      => __('Este título aparece quando o usuário passa o mouse na imagem', 'wpstarter').'.<br>'.__('Valor padrão', 'wpstarter').': '.__('WP Starter - Construindo temas de forma simples e eficaz!', 'wpstarter').'.'
	); add_settings_field( 'wplogin_title', __('Título da Logo', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-wplogin', $field_args );

} // End Function

?>
