<?php
/* -- Clean Values -- */
$wpstarter_themeoptions_menus = devOpt('themeoptions_menus', false);
if( is_array($wpstarter_themeoptions_menus) ){
	foreach( $wpstarter_themeoptions_menus as $key=>$value ){
		if( $value == '' ){
			unset($wpstarter_themeoptions_menus[$key]);
		}
	}
}


/* -- Create Import Files -- */
if(function_exists("register_field_group"))
{
	if( sizeof($wpstarter_themeoptions_menus) >= 1 ){
		register_field_group(array (
			'id' => 'acf_detalhes-da-opcao',
			'title' => __('Detalhes da Opção', 'wpstarter'),
			'fields' => array (
				/* array (
					'key' => 'field_541dc41842d90',
					'label' => __('Mensagem', 'wpstarter'),
					'name' => '',
					'type' => 'message',
					'message' => __('Mensagem de teste...', 'wpstarter'),
				), */
				array (
					'key' => 'field_541ef7174b00d',
					'label' => __('Básico', 'wpstarter'),
					'name' => '',
					'type' => 'tab',
				),
				array (
					'key' => 'field_541dc288a5f9a',
					'label' => __('Menu', 'wpstarter'),
					'name' => 'wpthemeoptions_menu',
					'type' => 'select',
					'instructions' => __('Para criar os menus você precisa ir em <b>Desenvolvedor</b>, depois <b>Opções do Tema</b>. Você não pode criar novas opções do tema sem antes criar os menus.', 'wpstarter'),
					'required' => 1,
					'choices' => $wpstarter_themeoptions_menus,
					'default_value' => '',
					'allow_null' => 0,
					'multiple' => 0,
				),
				array (
					'key' => 'field_541dc44fce21f',
					'label' => __('Slug / ID', 'wpstarter'),
					'name' => 'wpthemeoptions_slug',
					'type' => 'text',
					'instructions' => __('<b>Exemplo:</b> telefone<br>
		<b>Atenção:</b> Não use caracteres especiais nem espaços neste campo. Para exibir os valores de um campo personalizado utilize a seguinte função no php: <i>echo options(\'field_id\', false);</i>', 'wpstarter'),
					'required' => 1,
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'html',
					'maxlength' => '',
				),
				array (
					'key' => 'field_541ef7374b00f',
					'label' => __('Tipo', 'wpstarter'),
					'name' => '',
					'type' => 'tab',
				),
				array (
					'key' => 'field_541dc4c98f5e6',
					'label' => __('Tipo', 'wpstarter'),
					'name' => 'wpthemeoptions_type',
					'type' => 'select',
					'required' => 1,
					'choices' => array (
						'text' => __('Texto', 'wpstarter'),
						'textarea' => __('Textarea', 'wpstarter'),
						'repeater' => __('Campo Repetido (Retorna um Array)', 'wpstarter'),
						'select' => __('Seleção', 'wpstarter'),
						'image' => __('Imagem (Retorna o ID)', 'wpstarter'),
						'color-picker' => __('Seleção de Cor', 'wpstarter'),
					),
					'default_value' => 'text',
					'allow_null' => 0,
					'multiple' => 0,
				),
				array (
					'key' => 'field_542d9166d6d7b',
					'label' => __('Valores', 'wpstarter'),
					'name' => 'wpthemeoptions_select_values',
					'type' => 'text',
					'instructions' => __('Separe os valores por vírgula. Exemplo: valor 1, valor 2, valor 3.<br>O campo é obrigatório.', 'wpstarter'),
					'required' => 1,
					'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_541dc4c98f5e6',
								'operator' => '==',
								'value' => 'select',
							),
						),
						'allorany' => 'all',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				),
				array (
					'key' => 'field_541ef7274b00e',
					'label' => __('Outros', 'wpstarter'),
					'name' => '',
					'type' => 'tab',
				),
				array (
					'key' => 'field_541eece36e491',
					'label' => __('Ordem', 'wpstarter'),
					'name' => 'wpthemeoptions_order',
					'type' => 'number',
					'instructions' => __('Escolha a ordem que o campo será exibido na seção escolhida no campo Menu.', 'wpstarter'),
					'required' => 1,
					'default_value' => 1,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => 1,
					'max' => '',
					'step' => '',
				),
				array (
					'key' => 'field_541dc54c8f5e7',
					'label' => __('Descrição', 'wpstarter'),
					'name' => 'wpthemeoptions_description',
					'type' => 'text',
					'instructions' => __('A descrição do campo aparece abaixo dele. O campo é opcional.', 'wpstarter'),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'formatting' => 'html',
					'maxlength' => '',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'wpthemeoptions',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'default',
				'hide_on_screen' => array (
					0 => 'permalink',
					1 => 'the_content',
					2 => 'excerpt',
					3 => 'custom_fields',
					4 => 'discussion',
					5 => 'comments',
					6 => 'revisions',
					7 => 'slug',
					8 => 'author',
					9 => 'format',
					10 => 'featured_image',
					11 => 'categories',
					12 => 'tags',
					13 => 'send-trackbacks',
				),
			),
			'menu_order' => 0,
		));
	}else{
		register_field_group(array (
			'id' => 'acf_detalhes-da-opcao',
			'title' => 'Detalhes da Opção',
			'fields' => array (
				array (
					'key' => 'field_541dc41842d90',
					'label' => __('Erro', 'wpstarter'),
					'name' => '',
					'type' => 'message',
					'message' => __('Você não criou nenhum menu para as opções do tema. Vá para a página Desenvolvedor e na aba Opções do Tema crie pelo menos um menu.', 'wpstarter'),
				)
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'wpthemeoptions',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'default',
				'hide_on_screen' => array (
					0 => 'permalink',
					1 => 'the_content',
					2 => 'excerpt',
					3 => 'custom_fields',
					4 => 'discussion',
					5 => 'comments',
					6 => 'revisions',
					7 => 'slug',
					8 => 'author',
					9 => 'format',
					10 => 'featured_image',
					11 => 'categories',
					12 => 'tags',
					13 => 'send-trackbacks',
				),
			),
			'menu_order' => 0,
		));
	}
}

?>