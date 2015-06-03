<?php

/* ===============================================================
	GETTING ADMIN MENUS
=============================================================== */
add_action( 'admin_init', 'wpstarter_get_menus_for_order', 2 );
function wpstarter_get_menus_for_order(){
	global $submenu, $menu, $wpstarter_menus_order;

	/* -- Menu -- */
	if( is_array($menu) ){
		foreach( $menu as $key=>$value ){
			if( $value[0] == '' ){ // If don't has a name
				$wpstarter_menus_order[$key]['name'] = __('Separador', 'wpstarter');
				$wpstarter_menus_order[$key]['file'] = $value[2];
			}elseif( $value[2] == 'wpstarter_developer' ){
				$wpstarter_menus_order[$key]['name'] = __('Desenvolvedor', 'wpstarter');
				$wpstarter_menus_order[$key]['file'] = $value[2];
			}else{
				$wpstarter_menus_order[$key]['name'] = preg_replace('/<span\b[^>]*>(.*?)<\/span>/i', '', $value[0]);
				$wpstarter_menus_order[$key]['file'] = $value[2];
			}
		}
	}
}



/* ===============================================================
	CREATING SECTION AND FIELDS
=============================================================== */
add_action( 'admin_init', 'wpstarterDeveloper_reordermenu_settings' );
function wpstarterDeveloper_reordermenu_settings(){
 
	if( is_array($GLOBALS['wpstarter_menus_order']) ){
		foreach( $GLOBALS['wpstarter_menus_order'] as $key=>$value ){	
			$wpstarter_menu_items_order[$value['file']] = $value['name'];
		}
	}

	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-reordermenu', __('Reordenar Menu', 'wpstarter'), 'wpstarter_developer_display_section_reordermenu', 'wpstarter_developer' ); 

	/* ===============================================================
		FIELD: USER NAME
	=============================================================== */
	$field_args = array(
		'type'      => 'sortable',
		'id'        => 'reordermenu_order',
		'name'      => 'reordermenu_order',
		'fields'    => $wpstarter_menu_items_order,
		'label_for' => 'reordermenu_user',
		'class'     => 'reordermenu'
	); add_settings_field( 'reordermenu_user', __('Reordenar', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-reordermenu', $field_args );

} // End Function



/* ===============================================================
	BEFORE DISPLAY SECTION SHOW SOME INSTRUCTIONS
=============================================================== */
function wpstarter_developer_display_section_reordermenu(){
	
	echo '<p>';
	echo '<b>'.__('Usuários', 'wpstarter').'</b><br>';
	echo __('A ordem que você define aqui se aplicará aos tipos de usuários que você escolher na aba', 'wpstarter').
		 ' <b>'.__('Remover Menus', 'wpstarter').'.</b>';
	echo '</p>';

	echo '<p>';
	echo '<b>'.__('Atenção', 'wpstarter').'</b><br>';
	echo __('Depois que você remover os menus na aba', 'wpstarter').' <b>'.__('Remover Menus', 'wpstarter').'</b> '.__('você precisa salvar as alterações para alterar a ordem deles aqui.', 'wpstarter');
	echo '</p>';

	echo '<p>';
	echo '<b>'.__('Dica', 'wpstarter').'</b><br>';
	echo __('O link para a página Desenvolvedor só aparece para os administradores, caso retire alguns itens do menu apenas para outros tipos de usuários você precisa marcar administrador também e salvar as alterações para que os links apareçam aqui, então você pode reordená-los, salvar as alterações e depois desmarcar Administrador em Remover Menus.', 'wpstarter');
	echo '</p>';
}

?>