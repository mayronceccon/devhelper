<?php
/* -- Clean Values -- */
$devhelper_themeoptions_menus = devOpt('themeoptions_menus', false);
if( is_array($devhelper_themeoptions_menus) ){
	foreach( $devhelper_themeoptions_menus as $key=>$value ){
		if( $value == '' ){
			unset($devhelper_themeoptions_menus[$key]);
		}
	}
}


/* -- Create Import Files -- */
if(function_exists("register_field_group"))
{
	if( sizeof($devhelper_themeoptions_menus) >= 1 ){
		register_field_group(array (
			'id' => 'acf_detalhes-da-opcao',
			'title' => __('Detalhes da Opção', 'devhelper'),
			'fields' => array (
				/* array (
					'key' => 'field_541dc41842d90',
					'label' => __('Mensagem', 'devhelper'),
					'name' => '',
					'type' => 'message',
					'message' => __('Mensagem de teste...', 'devhelper'),
				), */
				array (
					'key' => 'field_541ef7174b00d',
					'label' => __('Básico', 'devhelper'),
					'name' => '',
					'type' => 'tab',
				),
				array (
					'key' => 'field_541dc288a5f9a',
					'label' => __('Menu', 'devhelper'),
					'name' => 'wpthemeoptions_menu',
					'type' => 'select',
					'instructions' => __('Para criar os menus você precisa ir em <b>Desenvolvedor</b>, depois <b>Opções do Tema</b>. Você não pode criar novas opções do tema sem antes criar os menus.', 'devhelper'),
					'required' => 1,
					'choices' => $devhelper_themeoptions_menus,
					'default_value' => '',
					'allow_null' => 0,
					'multiple' => 0,
				),
				array (
					'key' => 'field_541dc44fce21f',
					'label' => __('Slug / ID', 'devhelper'),
					'name' => 'wpthemeoptions_slug',
					'type' => 'text',
					'instructions' => __('<b>Exemplo:</b> telefone<br>
		<b>Atenção:</b> Não use caracteres especiais nem espaços neste campo. Para exibir os valores de um campo personalizado utilize a seguinte função no php: <i>echo options(\'field_id\', false);</i>', 'devhelper'),
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
					'label' => __('Tipo', 'devhelper'),
					'name' => '',
					'type' => 'tab',
				),
				array (
					'key' => 'field_541dc4c98f5e6',
					'label' => __('Tipo', 'devhelper'),
					'name' => 'wpthemeoptions_type',
					'type' => 'select',
					'required' => 1,
					'choices' => array (
						'text' => __('Texto', 'devhelper'),
						'textarea' => __('Textarea', 'devhelper'),
						'repeater' => __('Campo Repetido (Retorna um Array)', 'devhelper'),
						'select' => __('Seleção', 'devhelper'),
						'image' => __('Imagem (Retorna o ID)', 'devhelper'),
						'color-picker' => __('Seleção de Cor', 'devhelper'),
					),
					'default_value' => 'text',
					'allow_null' => 0,
					'multiple' => 0,
				),
				array (
					'key' => 'field_542d9166d6d7b',
					'label' => __('Valores', 'devhelper'),
					'name' => 'wpthemeoptions_select_values',
					'type' => 'text',
					'instructions' => __('Separe os valores por vírgula. Exemplo: valor 1, valor 2, valor 3.<br>O campo é obrigatório.', 'devhelper'),
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
					'label' => __('Outros', 'devhelper'),
					'name' => '',
					'type' => 'tab',
				),
				array (
					'key' => 'field_541eece36e491',
					'label' => __('Ordem', 'devhelper'),
					'name' => 'wpthemeoptions_order',
					'type' => 'number',
					'instructions' => __('Escolha a ordem que o campo será exibido na seção escolhida no campo Menu.', 'devhelper'),
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
					'label' => __('Descrição', 'devhelper'),
					'name' => 'wpthemeoptions_description',
					'type' => 'text',
					'instructions' => __('A descrição do campo aparece abaixo dele. O campo é opcional.', 'devhelper'),
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
					'label' => __('Erro', 'devhelper'),
					'name' => '',
					'type' => 'message',
					'message' => __('Você não criou nenhum menu para as opções do tema. Vá para a página Desenvolvedor e na aba Opções do Tema crie pelo menos um menu.', 'devhelper'),
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