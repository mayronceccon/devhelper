<?php

add_action( 'admin_init', 'devhelperDeveloper_themeoptions_settings' );
function devhelperDeveloper_themeoptions_settings(){

	// Register the settings with Validation callback
	register_setting( 'devhelperDeveloper', 'devhelperDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-themeoptions', __('Opções do Tema', 'devhelper'), 'devhelper_developer_display_section_themeoptions', 'devhelper_page' );

	/* ===============================================================
		FIELD: ACTIVE LOGIN WP
	=============================================================== */
	$field_args = array(
		'type'      => 'select',
		'id'        => 'themeoptions_display',
		'name'      => 'themeoptions_display',
		'fields'    => array('no'=>__('Não', 'devhelper'), 'yes'=>__('Sim', 'devhelper')),
		'desc'      => __('As opções do tema já vem ativadas por padrão, porém, não vem com nenhum dado e também não é exibida no menu de administração. Marque
					   esta opção com <b>Sim</b> o link para as opções do tema aparecerá no menu lateral.', 'devhelper'),
		'label_for' => 'themeoptions_display'
	); add_settings_field( 'themeoptions_display', __('Mostrar', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-themeoptions', $field_args );

	/* ===============================================================
		FIELD: MENUS
	=============================================================== */
	$field_args = array(
		'type'      => 'repeater',
		'id'        => 'themeoptions_menus',
		'name'      => 'themeoptions_menus',
		'desc'      => __('Crie um menu por vez. Antes de criar opções para o tema você precisa criar pelo menus um menu.', 'devhelper'),
		'label_for' => 'themeoptions_menus'
	); add_settings_field( 'themeoptions_menus', __('Menus', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-themeoptions', $field_args );

	/* ===============================================================
		FIELD: MENUS
	=============================================================== */
	$field_args = array(
		'type' => 'button',
		'id'   => 'themeoptions_button',
		'name' => 'themeoptions_button',
		'desc' => __('Clique no botão acima para adicionar/editar/excluir opções do tema.', 'devhelper'),
		'text' => __('Gerenciar Opções', 'devhelper'),
		'href' => admin_url().'edit.php?post_type=wpthemeoptions'
	); add_settings_field( 'themeoptions_button', __('Opções do Tema', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-themeoptions', $field_args );

} // End Function



function devhelper_developer_display_section_themeoptions(){
	echo __('As opções do tema são muito úteis em qualquer site. Você pode criar valores que são alterados direto pelo painel e chamá-los utilizar a seguinte
		função no php: ');
	echo "options('options_slug'); ".__('para exibir o valor e', 'devhelper')." options('options_slug', false) para resgatar o valor.";
}

?>
