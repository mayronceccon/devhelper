<?php

/* ===============================================================
	GETTING ADMIN MENUS
=============================================================== */
add_action( 'admin_menu', 'devhelper_get_menus', 1 );
function devhelper_get_menus(){
	global $submenu, $menu, $devhelper_menus;

	/* -- Menu -- */
	foreach( $menu as $key=>$value ){
		if( $value[0] != '' AND $value[2] != 'devhelper_page' ){ // If has a Name and is not the developers page
			$devhelper_menus[$key]['name'] = preg_replace('/<span\b[^>]*>(.*?)<\/span>/i', '', $value[0]);
			$devhelper_menus[$key]['file'] = $value[2];

			// Submenu
			if( is_array($submenu[$value[2]]) AND sizeof($submenu[$value[2]]) >= 1 ){
				foreach( $submenu[$value[2]] as $key2=>$value2 ){
					$devhelper_menus[$key]['submenus'][$key2]['name']   = preg_replace('/<span\b[^>]*>(.*?)<\/span>/i', '', $value2[0]);
					$devhelper_menus[$key]['submenus'][$key2]['file']   = $value2[2];
					$devhelper_menus[$key]['submenus'][$key2]['parent'] = $value[0];
				}
			}else{
				$devhelper_menus[$key]['submenus'] = false;
			}
		}
	}
}



/* ===============================================================
	CREATING SECTION AND FIELDS
=============================================================== */
add_action( 'admin_init', 'wpstarterDeveloper_removemenus_settings' );
function wpstarterDeveloper_removemenus_settings(){

	if( is_array($GLOBALS['devhelper_menus']) ){
		foreach( $GLOBALS['devhelper_menus'] as $key=>$value ){	

			$devhelper_menu_items[$value['file']] = $value['name'];
			if( is_array($value['submenus']) ){
				foreach( $value['submenus'] as $key2=>$value2 ){
					$devhelper_menu_items[$value['file'].'*sub*'.$value2['file']] = $value2['name'];
				}
			}
		}
	}
 
	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-removemenus', __('Remover Menus', 'devhelper'), 'devhelper_developer_display_section_removemenus', 'devhelper_page' ); 

	/* ===============================================================
		FIELD: APPLY TO THESE USER's
	=============================================================== */
	$field_args = array(
		'type'      => 'checkbox',
		'id'        => 'removemenus_user',
		'name'      => 'removemenus_user',
		'desc'      => __('Selecione os tipos de usuários que você deseja que os menus e submenus sejam removidos.', 'devhelper'),
		'fields'    => array(
			10 => __('Administrador', 'devhelper'),
			7  => __('Editor', 'devhelper'),
			2  => __('Autor', 'devhelper'),
			1  => __('Colaborador', 'devhelper'),
			0  => __('Assinante', 'devhelper')
		),
		'label_for' => 'removemenus_user'
	); add_settings_field( 'removemenus_user', __('Usuários', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-removemenus', $field_args );

	/* ===============================================================
		FIELD: MENU CHECKBOX
	=============================================================== */
	$field_args = array(
		'type'      => 'checkbox-menu',
		'id'        => 'removemenus_url',
		'name'      => 'removemenus_url',
		'desc'      => '',
		'fields'    => $devhelper_menu_items,
		'label_for' => 'removemenus_url',
		'class'     => 'checkbox-menu-items'
	); add_settings_field( 'removemenus_url', __('Menu Itens', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-removemenus', $field_args );

	/* ===============================================================
		FIELD: MENU ITENS MANUAL
	=============================================================== */
	$field_args = array(
		'type'      => 'repeater',
		'id'        => 'removemenus_manual_url',
		'name'      => 'removemenus_manual_url',
		'desc'      => __('Caso algum menu não apareça nas opções acima você pode removê-lo por aqui. Insira uma url de página por vez. Você deve inserir o nome da página depois de /wp-admin/ na url. Exemplo de remoção:', 'devhelper').' profile.php',
		'label_for' => 'removemenus_manual_url',
	); add_settings_field( 'removemenus_manual_url', __('Menu Itens Manual', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-removemenus', $field_args );

	/* ===============================================================
		FIELD: SUBMENU ITENS MANUAL
	=============================================================== */
	$field_args = array(
		'type'      => 'repeater',
		'id'        => 'removesubmenus_manual_url',
		'name'      => 'removesubmenus_manual_url',
		'desc'      => __('Caso algum submenu não apareça nas opções acima você pode removê-lo por aqui. Insira uma url de página por vez. Para remover um submenu insira o nome do arquivo
						do menu pai e do link que deseja remover. Exemplo: ', 'devhelper').'themes.php theme-editor.php',
		'label_for' => 'removesubmenus_url',
	); add_settings_field( 'removesubmenus_url', __('Submenu Itens Manual', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-removemenus', $field_args );

} // End Function



/* ===============================================================
	BEFORE DISPLAY SECTION SHOW SOME INSTRUCTIONS
=============================================================== */
function devhelper_developer_display_section_removemenus(){
	echo '<p>';
	echo '<b>'.__('Menus', 'devhelper').'</b><br>';
	echo __("No wordpress existe uma função para remover links do menu lateral chamada <b>remove_menu_page</b>. Basta você chamar a função no seu arquivo <b>functions.php</b> passando
		uma string que seria a página a ser removida do menu lateral, por exemplo: <b>remove_menu_page('index.php')</b>. O index.php no caso é a url para a página Painel do wordpress.
		Para facilitar esta tarefa você pode marcar as páginas que deseja que não sejam mostradas em Menu Itens</b>.
	", 'devhelper');
	echo '</p>';

	echo '<p>';
	echo '<b>'.__('Usuários', 'devhelper').'</b><br>';
	echo __("Em Usuários você precisa selecionar quais tipos de usuários terão o menu lateral alterado, em muitas vezes o desenvolvedor cria um usuário para o cliente com funções de editor e muda a exbição dos menus
		apenas para este tipo de usuário.
	", 'devhelper');
	echo '</p>';

	echo '<p>';
	echo '<b>'.__('Desenvolvedor', 'devhelper').'</b><br>';
	echo __("Você não pode desabilitar o item Desenvolvedor do menu por aqui, para fazer isso chame a função <b>hide_developer();</b> no arquivo functions.php do seu tema.", 'devhelper');
	echo '</p>';
}

?>