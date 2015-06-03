<?php

add_action( 'admin_init', 'wpstarterDeveloper_adminbar_settings' );
function wpstarterDeveloper_adminbar_settings(){

	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-adminbar', __('Admin Bar', 'wpstarter'), 'wpstarter_developer_display_section', 'wpstarter_developer' );

	/* ===============================================================
		FIELD: ADMIN BAR
	=============================================================== */
	$field_args = array(
		'type'      => 'checkbox',
		'id'        => 'adminbar_remove_items',
		'name'      => 'adminbar_remove_items',
		'desc'      => __('Selecione os itens que deseja remover da barra de ferramentas. Os itens que você selecionar acima servem para todos os tipos de usuários.', 'wpstarter'),
		'fields'    => array(
				'linkwpstarter' => __('WP Starter Link', 'wpstarter'),
				'wp-logo'       => __('Logo do WordPress', 'wpstarter'),
				'site-name'     => get_bloginfo('name'),
				'comments'      => __('Comentários', 'wpstarter'),
				'new-content'   => __('Novo', 'wpstarter'),
			),
		'label_for' => 'adminbar_remove_items'
	); add_settings_field( 'adminbar_remove_items', __('Remover Itens', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-adminbar', $field_args );

	/* ===============================================================
		FIELD: ADMIN BAR
	=============================================================== */
	$field_args = array(
		'type'      => 'repeater-more',
		'id'        => 'adminbar_add_links',
		'name'      => 'adminbar_add_links',
		'desc'      => __('Os campos ID, Conteúdo e Href são obrigatórios. Se deixar algum deles em branco não ativaremos o link. Em location(campo opcional)
					   os valores aceitos são <b>before</b> ou <b>after</b>.', 'wpstarter').'<br>'.
						"<span style=\"display:block; margin:10px 0 -10px 0;\">".
							__("Shortcodes disponíveis para usar nos campos Conteúdo e Href:", 'wpstarter').
							"<br>
							<b>[siteurl]</b> => ".get_bloginfo('url')."<br>
							<b>[themeroot]</b> => ".THEMEROOT."
						</span>
						",
		'fields'    => array(
				'id'       => __('ID', 'wpstarter'),
				'content'  => __('Conteúdo', 'wpstarter'),
				'href'     => __('Href', 'wpstarter'),
				'target'   => __('Target', 'wpstarter'),
				'title'    => __('Title', 'wpstarter'),
				'class'    => __('Class', 'wpstarter'),
				'location' => __('Location', 'wpstarter')
			),
		'label_for' => 'adminbar_add_links'
	); add_settings_field( 'adminbar_add_links', __('Adicionar Links', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-adminbar', $field_args );



} // End Function

?>
