<?php
if( function_exists("register_field_group") AND devOpt('active_seo', false) == 'yes' )
{
	register_field_group(array (
		'id' => 'acf_seo-por-devhelper',
		'title' => 'SEO '.__('por', 'devhelper').' Dev Helper',
		'fields' => array (
			array (
				'key' => 'field_5417404fefc6b',
				'label' => __('Ativar', 'devhelper'),
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_5417409befc6c',
				'label' => __('Ativar configurações de SEO para este post?', 'devhelper'),
				'name' => 'devhelper_seo_enable',
				'type' => 'select',
				'required' => 1,
				'choices' => array (
					'yes' => __('Sim', 'devhelper'),
					'no' => __('Não', 'devhelper')
				),
				'default_value' => 'yes',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5418b8691f0d6',
				'label' => __('Geral', 'devhelper'),
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5417409befc6c',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_5418b87e1f0d7',
				'label' => __('Título Forçado', 'devhelper'),
				'name' => 'devhelper_seo_title',
				'type' => 'text',
				'instructions' => __('Caso não deseje que o título padrão que seria <b>Nome do Post - Nome do Site</b> apareça na tag title você pode alterar o valor aqui. Deixe em branco e o título padrão aparecerá. O número máximo de caracteres é de 64.', 'devhelper'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 64,
			),
			array (
				'key' => 'field_5418b91f4418c',
				'label' => __('Meta Descrição', 'devhelper'),
				'name' => 'devhelper_seo_meta_description',
				'type' => 'textarea',
				'instructions' => __('Escreva um resumo do post. Este texto é o que aparecerá no Google quando este post/página aparecer nos resultados de pesquisa. O número máximo de caracteres é de 150.', 'devhelper'),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => 150,
				'rows' => 3,
				'formatting' => 'none',
			),
			array (
				'key' => 'field_5418ba9f6a6a8',
				'label' => __('Social Facebook e Google+', 'devhelper'),
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5417409befc6c',
							'operator' => '==',
							'value' => 'yes',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_5418ca0f98ff7',
				'label' => __('Título Forçado', 'devhelper'),
				'name' => 'devhelper_seo_social_title',
				'type' => 'text',
				'instructions' => __('Se você não quiser usar o título padrão do post/página e sim outro nas redes sociais você deve inseri-lo aqui. O número máximo de caracteres é de 64.', 'devhelper'),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => 64,
			),
			array (
				'key' => 'field_5418cbb479f27',
				'label' => __('Descrição', 'devhelper'),
				'name' => 'devhelper_seo_social_description',
				'type' => 'textarea',
				'instructions' => __('Se você não quiser usar a meta descrição padrão do post/página e sim outro nas redes sociais você deve inseri-la aqui. O número máximo de caracteres é de 150.', 'devhelper'),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => 150,
				'rows' => 3,
				'formatting' => 'none',
			),
			array (
				'key' => 'field_5418d0cd4744b',
				'label' => __('Imagem', 'devhelper'),
				'name' => 'devhelper_seo_social_image',
				'type' => 'image',
				'instructions' => __('Se você quiser selecionar uma imagem para as redes sociais referente a este post/página escolha uma imagem aqui. A imagem deve ser quadrada, caso o contrário o facebook ou o google+ poderá recortar a imagem.', 'devhelper'),
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => $devhelper_use_seo_on,
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 999,
	));
}
?>