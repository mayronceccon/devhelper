<?php

/* ===============================================================
	GETTING ADMIN MENUS
=============================================================== */
add_action( 'admin_init', 'devhelper_get_menus_for_order', 2 );
function devhelper_get_menus_for_order(){
	global $submenu, $menu, $devhelper_menus_order;

	/* -- Menu -- */
	if( is_array($menu) ){
		foreach( $menu as $key=>$value ){
			if( $value[0] == '' ){ // If don't has a name
				$devhelper_menus_order[$key]['name'] = __('Separador', 'devhelper');
				$devhelper_menus_order[$key]['file'] = $value[2];
			}elseif( $value[2] == 'devhelper_page' ){
				$devhelper_menus_order[$key]['name'] = __('Desenvolvedor', 'devhelper');
				$devhelper_menus_order[$key]['file'] = $value[2];
			}else{
				$devhelper_menus_order[$key]['name'] = preg_replace('/<span\b[^>]*>(.*?)<\/span>/i', '', $value[0]);
				$devhelper_menus_order[$key]['file'] = $value[2];
			}
		}
	}
}



/* ===============================================================
	CREATING SECTION AND FIELDS
=============================================================== */
add_action( 'admin_init', 'devhelperDeveloper_reordermenu_settings' );
function devhelperDeveloper_reordermenu_settings(){
 
	if( is_array($GLOBALS['devhelper_menus_order']) ){
		foreach( $GLOBALS['devhelper_menus_order'] as $key=>$value ){	
			$devhelper_menu_items_order[$value['file']] = $value['name'];
		}
	}

	// Register the settings with Validation callback
	register_setting( 'devhelperDeveloper', 'devhelperDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-reordermenu', __('Reordenar Menu', 'devhelper'), 'devhelper_developer_display_section_reordermenu', 'devhelper_page' ); 

	/* ===============================================================
		FIELD: USER NAME
	=============================================================== */
	$field_args = array(
		'type'      => 'sortable',
		'id'        => 'reordermenu_order',
		'name'      => 'reordermenu_order',
		'fields'    => $devhelper_menu_items_order,
		'label_for' => 'reordermenu_user',
		'class'     => 'reordermenu'
	); add_settings_field( 'reordermenu_user', __('Reordenar', 'devhelper'), 'devhelper_developer_display_setting', 'devhelper_page', 'developer-reordermenu', $field_args );

} // End Function



/* ===============================================================
	BEFORE DISPLAY SECTION SHOW SOME INSTRUCTIONS
=============================================================== */
function devhelper_developer_display_section_reordermenu(){
	
	echo '<p>';
	echo '<b>'.__('Usuários', 'devhelper').'</b><br>';
	echo __('A ordem que você define aqui se aplicará aos tipos de usuários que você escolher na aba', 'devhelper').
		 ' <b>'.__('Remover Menus', 'devhelper').'.</b>';
	echo '</p>';

	echo '<p>';
	echo '<b>'.__('Atenção', 'devhelper').'</b><br>';
	echo __('Depois que você remover os menus na aba', 'devhelper').' <b>'.__('Remover Menus', 'devhelper').'</b> '.__('você precisa salvar as alterações para alterar a ordem deles aqui.', 'devhelper');
	echo '</p>';

	echo '<p>';
	echo '<b>'.__('Dica', 'devhelper').'</b><br>';
	echo __('O link para a página Desenvolvedor só aparece para os administradores, caso retire alguns itens do menu apenas para outros tipos de usuários você precisa marcar administrador também e salvar as alterações para que os links apareçam aqui, então você pode reordená-los, salvar as alterações e depois desmarcar Administrador em Remover Menus.', 'devhelper');
	echo '</p>';
}

?>