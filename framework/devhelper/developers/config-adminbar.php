<?php

add_action( 'admin_init', 'wpstarterDeveloper_adminbar_settings' );
function wpstarterDeveloper_adminbar_settings(){

	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-adminbar', __('Admin Bar', 'devhelper'), 'devhelper_developer_display_section', 'devhelper_page' );

	/* ===============================================================
		FIELD: ADMIN BAR
	=============================================================== */
	$field_args = array(
		'type'      => 'checkbox',
		'id'        => 'adminbar_remove_items',
		'name'      => 'adminbar_remove_items',
		'desc'      => __('Selecione os itens que deseja remover da barra de ferramentas. Os itens que você selecionar acima servem para todos os tipos de usuários.', 'devhelper'),
		'fields'    => array(
				'linkwpstarter' => __('Dev Helper Link', 'devhelper'),
				'wp-logo'       => __('Logo do WordPress', 'devhelper'),
				'site-name'     => get_bloginfo('name'),
				'comments'      => __('Comentários', 'devhelper'),
				'new-content'   => __('Novo', 'devhelper'),
			),
		'label_for' => 'adminbar_remove_items'
	); add_settings_field( 'adminbar_remove_items', __('Remover Itens', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-adminbar', $field_args );

	/* ===============================================================
		FIELD: ADMIN BAR
	=============================================================== */
	$field_args = array(
		'type'      => 'repeater-more',
		'id'        => 'adminbar_add_links',
		'name'      => 'adminbar_add_links',
		'desc'      => __('Os campos ID, Conteúdo e Href são obrigatórios. Se deixar algum deles em branco não ativaremos o link. Em location(campo opcional)
					   os valores aceitos são <b>before</b> ou <b>after</b>.', 'devhelper').'<br>'.
						"<span style=\"display:block; margin:10px 0 -10px 0;\">".
							__("Shortcodes disponíveis para usar nos campos Conteúdo e Href:", 'devhelper').
							"<br>
							<b>[siteurl]</b> => ".get_bloginfo('url')."<br>
							<b>[themeroot]</b> => ".THEMEROOT."
						</span>
						",
		'fields'    => array(
				'id'       => __('ID', 'devhelper'),
				'content'  => __('Conteúdo', 'devhelper'),
				'href'     => __('Href', 'devhelper'),
				'target'   => __('Target', 'devhelper'),
				'title'    => __('Title', 'devhelper'),
				'class'    => __('Class', 'devhelper'),
				'location' => __('Location', 'devhelper')
			),
		'label_for' => 'adminbar_add_links'
	); add_settings_field( 'adminbar_add_links', __('Adicionar Links', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-adminbar', $field_args );



} // End Function

?>
