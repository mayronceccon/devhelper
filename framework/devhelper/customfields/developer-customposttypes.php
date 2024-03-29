<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_configuracoes-do-custom-post-type',
		'title' => __('Configurações do Custom Post Type', 'devhelper'),
		'fields' => array (
			array (
				'key' => 'field_54128861377ec',
				'label' => __('Geral', 'devhelper'),
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_54128b1975810',
				'label' => __('Post Slug', 'devhelper'),
				'name' => 'post_slug',
				'type' => 'text',
				'instructions' => __("O campo é obrigatório.<br>
	Não use caracteres especiais.<br>
	Quando for fazer uma busca para este post você usará este slug.<br>
	<b>Exemplo se o slug for filmes:</b><br>
	<code>".'$sql_movies'." = new WP_Query( array('post_type'=>'filmes') );</code>", 'devhelper'),
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5413069ff15a8',
				'label' => __('Nome (Singular)', 'devhelper'),
				'name' => 'post_name_singular',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Filme', 'devhelper'),
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5413087d90dcf',
				'label' => __('Nome (Plural)', 'devhelper'),
				'name' => 'post_name_plural',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Filmes', 'devhelper'),
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_541289b0377ee',
				'label' => __('Rótulos', 'devhelper'),
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_5416ce4f3deeb',
				'label' => __('Dica', 'devhelper'),
				'name' => '',
				'type' => 'message',
				'message' => __('Tirando o rótulo <b>Nome no Menu</b> todos eles já tem um valor predefinido. Caso queira você pode alterá-los, porém, não é preciso. De qualquer forma dê uma lida nos rótulos que construímos para o seu post type.', 'devhelper'),
			),
			array (
				'key' => 'field_5413094346cd9',
				'label' => __('Nome no Menu', 'devhelper'),
				'name' => 'post_menu',
				'type' => 'text',
				'instructions' => __('Campo obrigatório.<br><b>Exemplo:</b> Filmes', 'devhelper'),
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130c45af553',
				'label' => __('Adicionar Novo', 'devhelper'),
				'name' => 'post_add_new',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Adicionar Novo', 'devhelper'),
				'required' => 1,
				'default_value' => __('Adicionar Novo', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130a7dd2b36',
				'label' => __('Adicionar Novo Item', 'devhelper'),
				'name' => 'post_add_new_item',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Adicionar Novo Item', 'devhelper'),
				'required' => 1,
				'default_value' => __('Adicionar Novo Item', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130dbdec2c2',
				'label' => __('Editar Item', 'devhelper'),
				'name' => 'post_edit_item',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Editar Item', 'devhelper'),
				'required' => 1,
				'default_value' => __('Editar Item', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130e2e02eba',
				'label' => __('Atualizar Item', 'devhelper'),
				'name' => 'post_update_item',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Atualizar Item', 'devhelper'),
				'required' => 1,
				'default_value' => __('Atualizar Item', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130dfb02eb9',
				'label' => __('Ver Item', 'devhelper'),
				'name' => 'post_view_item',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Ver Item', 'devhelper'),
				'required' => 1,
				'default_value' => __('Ver Item', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130b30d2b37',
				'label' => __('Buscar Item', 'devhelper'),
				'name' => 'post_search',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Buscar Item', 'devhelper'),
				'required' => 1,
				'default_value' => __('Buscar Item', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130c16af552',
				'label' => __('Todos Itens', 'devhelper'),
				'name' => 'post_all_items',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Todos os Itens', 'devhelper'),
				'required' => 1,
				'default_value' => __('Todos os Itens', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130d3569e52',
				'label' => __('Não Encontrado', 'devhelper'),
				'name' => 'post_not_found',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Não encontrado', 'devhelper'),
				'required' => 1,
				'default_value' => __('Não encontrado', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54130ea4e4979',
				'label' => __('Não Encontrado na Lixeira', 'devhelper'),
				'name' => 'post_not_found_in_trash',
				'type' => 'text',
				'instructions' => __('O campo é obrigatório.<br><b>Exemplo:</b> Nada encontrado na lixeira.', 'devhelper'),
				'required' => 1,
				'default_value' => __('Nada encontrado na lixeira', 'devhelper'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5412898b377ed',
				'label' => __('Opções', 'devhelper'),
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_5416c8d26f820',
				'label' => __('Suportes', 'devhelper'),
				'name' => 'post_supports',
				'type' => 'checkbox',
				'instructions' => __('Selecione pelo menos um suporte. Recomendamos que sempre selecione o suporte <b>Title</b>.<br>
	Campos customizados podem ser adicionados ao post type indo na página <b>Desenvolvedor</b> e clicando em <b>Custom Fields</b>.<br>
	<b>Obs:</b> O suporte a títulos já é automaticamente adicionado.', 'devhelper'),
				'choices' => array (
					'editor'          => __('Content (Editor)', 'devhelper'),
					'excerpt'         => __('Excerpt', 'devhelper'),
					'author'          => __('Author', 'devhelper'),
					'thumbnail'       => __('Featured Image', 'devhelper'),
					'comments'        => __('Comments', 'devhelper'),
					'trackbacks'      => __('Trackbacks', 'devhelper'),
					'revisions'       => __('Revisions', 'devhelper'),
					'custom-fields'   => __('Custom Fields', 'devhelper'),
					'page-attributes' => __('Page Attributes', 'devhelper'),
				),
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5416c9905d493',
				'label' => __('Excluir da Pesquisa', 'devhelper'),
				'name' => 'post_exclude_search',
				'type' => 'select',
				'instructions' => __('Posts desse tipo devem ser excluídos dos resultados de pesquisa.', 'devhelper'),
				'required' => 1,
				'choices' => array (
					'no'  => __('Não', 'devhelper'),
					'yes' => __('Sim', 'devhelper'),
				),
				'default_value' => 'no',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5416ca2813a15',
				'label' => __('Ativar Exportação', 'devhelper'),
				'name' => 'post_export',
				'type' => 'select',
				'instructions' => __('Permite à exportação do post type.', 'devhelper'),
				'required' => 1,
				'choices' => array (
					'yes' => __('Sim', 'devhelper'),
					'no'  => __('Não', 'devhelper'),
				),
				'default_value' => 'yes',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_541289d3377ef',
				'label' => __('Visibilidade', 'devhelper'),
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_5416ecaebd106',
				'label' => __('Mostrar na Barra do Admin', 'devhelper'),
				'name' => 'post_admin_bar_display',
				'type' => 'select',
				'instructions' => __('Mostrar o post type na barra de administração do usuário atual.', 'devhelper'),
				'required' => 1,
				'choices' => array (
					'yes' => __('Sim', 'devhelper'),
					'no'  => __('Não', 'devhelper'),
				),
				'default_value' => 'yes',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5416cb1013a17',
				'label' => __('Mostrar na Sidebar do Admin', 'devhelper'),
				'name' => 'post_sidebar_display',
				'type' => 'select',
				'instructions' => __('Mostrar o post type na sidebar do painel de administração.', 'devhelper'),
				'required' => 1,
				'choices' => array (
					'yes' => __('Sim', 'devhelper'),
					'no'  => __('No', 'devhelper'),
				),
				'default_value' => 'yes',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5416cb9c13a18',
				'label' => __('Posição na Sidebar', 'devhelper'),
				'name' => 'post_sidebar_position',
				'type' => 'select',
				'instructions' => __('Escolha a posição do post type na sidebar do painel de administração.', 'devhelper'),
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5416cb1013a17',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array (
					5   => __('5 - below Posts', 'devhelper'),
					10  => __('10 - below Posts', 'devhelper'),
					15  => __('15 - below Links', 'devhelper'),
					20  => __('20 - below Pages', 'devhelper'),
					25  => __('25 - below Comments', 'devhelper'),
					60  => __('60 - below first separator', 'devhelper'),
					65  => __('65 - below Plugins', 'devhelper'),
					70  => __('70 - below Users', 'devhelper'),
					75  => __('75 - below Tools', 'devhelper'),
					80  => __('80 - below Settings', 'devhelper'),
					100 => __('100 - below second separator', 'devhelper'),
				),
				'default_value' => 5,
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5416cd289f583',
				'label' => __('Permalinks', 'devhelper'),
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_5416cd409f584',
				'label' => __('Default Permalinks', 'devhelper'),
				'name' => '',
				'type' => 'message',
				'message' => __('Os permalinks são montados com o valor que você inseriu em <b>Post Slug</b> na aba <b>Geral</b>.
	<b>Exemplo:</b> Se o post slug for filmes o permalink será http://meusite.com/filmes/post-exemplo', 'devhelper'),
			),
			array (
				'key' => 'field_54128a1a377f0',
				'label' => __('Capacidade', 'devhelper'),
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_5416ccb1af809',
				'label' => __('Tipo de Capacidade Base', 'devhelper'),
				'name' => 'post_capability',
				'type' => 'select',
				'instructions' => __('Utilizado como uma base para a construção de capacidades.', 'devhelper'),
				'required' => 1,
				'choices' => array (
					'post' => __('Posts', 'devhelper'),
					'page' => __('Pages', 'devhelper'),
				),
				'default_value' => 'post',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'customposttypes',
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
		'menu_order' => 1,
	));
}
?>