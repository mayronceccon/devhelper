<?php

add_action( 'admin_init', 'wpstarterDeveloper_seo_settings' );
function wpstarterDeveloper_seo_settings(){
 
	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-seo', __('SEO', 'wpstarter'), 'wpstarter_developer_display_section_seo', 'wpstarter_developer' ); 

	/* ===============================================================
		FIELD: ACTIVE SEO
	=============================================================== */
	$field_args = array(
		'type'      => 'select',
		'id'        => 'active_seo',
		'name'      => 'active_seo',
		'fields'    => array('no'=>__('Não', 'wpstarter'), 'yes'=>__('Sim', 'wpstarter')),
		'desc'      => '<b><i class="dashicons dashicons-megaphone"></i> '.__('Atenção', 'wpstarter').':</b> '.__('Caso esteja usando algum plugin para SEO como por exemplo o', 'wpstarter').'
					   <a href="https://wordpress.org/plugins/wordpress-seo/" target="_blank" title="'.__('Abrir em nova guia.', 'wpstarter').'">WordPress SEO by Yoast</a> '.
					   __('deixe a opção marcada como não.', 'wpstarter'),
		'label_for' => 'active_seo'
	); add_settings_field( 'active_seo', __('Ativar SEO', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-seo', $field_args );

	/* ===============================================================
		FIELD: POST TYPES
	=============================================================== */
	function get_registered_post_types(){
		/* -- Initial Configs -- */
		global $wp_post_types;
		$return = '';
		/* -- Loop Post Types -- */
		foreach( array_keys($wp_post_types) as $post_type ){
			if( $post_type != 'acf' AND $post_type != 'customposttypes' AND $post_type != 'nav_menu_item' AND $post_type != 'revision' AND $post_type != 'attachment' AND $post_type != 'wpthemeoptions' ){
				$return .= '<b>'.$post_type.'</b>, ';
			}
		}
		/* -- If don't have any post types -- */
		if( $return == '' ){}
		/* -- Return Post Types -- */
		return substr($return, 0, (strlen($return)-2));
	}

	$field_args = array(
		'type'      => 'text',
		'id'        => 'developer_seo_posttypes',
		'name'      => 'developer_seo_posttypes',
		'desc'      => __('Insira os post types que você quer que os campos de SEO apareçam. Insira os post types separados por vírgula.', 'wpstarter').'<br>'.
					   __('Os post types atuais no seu tema são:', 'wpstarter').' '.get_registered_post_types().'<br>'.
					   __('Os post types citados acima servem de exemplo de como devem ser inseridos no input com a vírgula.', 'wpstarter'),
		'label_for' => 'developer_seo_posttypes',
	); add_settings_field( 'developer_seo_posttypes', __('Post Types', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-seo', $field_args );

	/* ===============================================================
		FIELD: FACEBOOK PAGE
	=============================================================== */
	$field_args = array(
		'type'      => 'text',
		'id'        => 'developer_seo_facebook',
		'name'      => 'developer_seo_facebook',
		'desc'      => __('Caso tenha uma página ou conta no facebook insira a url aqui.', 'wpstarter').'<br>'.
					   '<b>'.__('Exemplo', 'wpstarter').':</b> https://www.facebook.com/agleggo',
		'label_for' => 'developer_seo_facebook',
	); add_settings_field( 'developer_seo_facebook', __('Página no Facebook', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-seo', $field_args );

	/* ===============================================================
		FIELD: GOOGLE+ PAGE
	=============================================================== */
	$field_args = array(
		'type'      => 'text',
		'id'        => 'developer_seo_google',
		'name'      => 'developer_seo_google',
		'desc'      => __('Caso tenha uma página no Google+ insira a url aqui.', 'wpstarter').'<br>'.
					   '<b>'.__('Exemplo', 'wpstarter').':</b> http://google.com/+AgenciaLeggoComunicacao',
		'label_for' => 'developer_seo_google',
	); add_settings_field( 'developer_seo_google', __('Página no Google+', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-seo', $field_args );

	/* ===============================================================
		FIELD: GOOGLE WEBMASTERS
	=============================================================== */
	$field_args = array(
		'type'      => 'text',
		'id'        => 'developer_seo_google_webmasters',
		'name'      => 'developer_seo_google_webmasters',
		'desc'      => __('Quando você se cadastra no Google Webmaster você recebe um arquivo com um código(ou apenas o código), você pode inserir apenas este código aqui.', 'wpstarter').
					   ' '.__('Campo opcional.', 'wpstarter'),
		'label_for' => 'developer_seo_google_webmasters',
	); add_settings_field( 'developer_seo_google_webmasters', __('Google Webmasters', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-seo', $field_args );

} // End Function


function wpstarter_developer_display_section_seo(){
	echo '<p>';
	_e('As configurações de SEO do WP Starter incluem: <i>Título Forçado</i>, <i>Meta Description</i> e <i>configurações para Facebook e para o Google+</i>.', 'wpstarter');

	echo '<br>';

	_e('As configurações citadas acima junto com as configurações nesta página só terão efeito se você marcar a opção <b>Ativar SEO</b> como <b>Sim</b>.', 'wpstarter');
	echo '</p>';
}

?>