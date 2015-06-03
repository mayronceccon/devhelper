<?php

add_action( 'admin_init', 'wpstarterDeveloper_thumbnails_settings' );
function wpstarterDeveloper_thumbnails_settings(){

	// Register the settings with Validation callback
	register_setting( 'wpstarterDeveloper', 'wpstarterDeveloper', '' );

	// Add settings section
	add_settings_section( 'developer-thumbnails', __('Thumbnails', 'wpstarter'), 'wpstarter_developer_display_section_thumbnail', 'wpstarter_developer' );

	/* ===============================================================
		FIELD: ENABLE
	=============================================================== */
	$field_args = array(
		'type'      => 'select',
		'id'        => 'thumbnails_enable',
		'name'      => 'thumbnails_enable',
		'desc'      => __('Marque sim se deseja ativar as Thumbnails nativas do WordPress.', 'wpstarter'),
		'label_for' => 'thumbnails_enable',
		'fields'    => array( 'no'=>__('Não', 'wpstarter'), 'yes'=>__('Sim', 'wpstarter') ),
	); add_settings_field( 'thumbnails_enable', __('Ativar Thumbnails', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-thumbnails', $field_args );

	/* ===============================================================
		FIELD: SIZES
	=============================================================== */
	$field_args = array(
		'type'      => 'repeater',
		'id'        => 'thumbnails_sizes',
		'name'      => 'thumbnails_sizes',
		'desc'      => __('Adicione um tamanho por vez separando com / os valores. Os valores são id/largura/altura/cortar', 'wpstarter').'.<br>'.
						__('Exemplo', 'wpstarter').' thumb-posts/400/400/false',
		'label_for' => 'thumbnails_sizes',
	); add_settings_field( 'thumbnails_sizes', __('Tamanhos', 'wpstarter'), 'wpstarter_developer_display_setting', 'wpstarter_developer', 'developer-thumbnails', $field_args );

} // End Function



function wpstarter_developer_display_section_thumbnail(){
	echo '<p>';
	echo '<b>'.__('Thumbnails Nativas', 'wpstarter').'</b><br>';
	echo __('O WordPress tem suporte a thumbnails, você pode criar diversos tamanhos para suas imagens, porém todas as imagens enviadas serão cortadas, gerando assim vários arquivos da mesma imagem. O único problema com isso tudo é o espaço no servidor, porém hoje a maioria dos servidores tem uma quantidade boa de espaço para armazenar estas imagens. Para criar as thumbnails tem um campo abaixo chamado Thumbnails WordPress com explicações de como os tamanhos devem ser criados, você pode criar os diferentes tamanhos lá.', 'wpstarter');
	echo '</p>';

	echo '<p>';
	echo '<b>TimThumb</b><br>';
	echo __('Uma opção que criamos é a de utilizar o TimThumb. TimThumb é uma classe php que gera miniaturas na hora que uma primeira pessoa acessa página, ele cria automaticamente os tamanhos de imagem que você deseja. Essas imagens são armazenadas em uma pasta chamada cache que está dentro do seu tema em <b>_framework/thumb/cache/</b>. Você pode apagar os arquivos desta pasta quando quiser para limpar espaço em seu servidor e as imagens serão geradas automaticamente depois.');
	echo '</p>';

	echo '<p>';
	echo '<b>'.__('Utilizando o TimThumb', 'wpstarter').'</b><br>';
	echo __('Para utilizar o TimThumb antes de tudo você deve dar permissão de escrita(777) na pasta <b>_framework/thumb/cache/</b> do seu tema caso o seu servidor não dê essa permissão a ela e então você deve chamar a função <b>thumb</b> dentro de uma tag php passando alguns valores(caminho da imagem, largura, altura, como cortá-la).', 'wpstarter').'<br>';
	echo __('Abaixo segue os exemplos de como deve ser usada a função <b>thumb</b>. Para ler a documentação de "crop"', 'wpstarter').
		 ' <a href="http://www.binarymoon.co.uk/2011/03/timthumb-proportional-scaling-security-improvements/" target="_blank">'.__('clique aqui').'</a>.<br>';
	echo '<span style="margin: 5px 0 15px 20px; display: block;">';
	echo "<b>thumb( 'http://example.com/my_image.png' , 300, 300, 1 );</b>".' - '.__('Será gerada uma imagem de 300x300 cortada.', 'wpstarter').'<br>';
	echo "<b>thumb( 'http://example.com/my_image.png' , 300, 300, 2 );</b>".' - '.__('A imagem terá 300x300 porém não será cortada e terá uma borda se preciso.', 'wpstarter').'<br>';
	echo "<b>thumb( 'http://example.com/my_image.png' , 300, 300, 3 );</b>".' - '.__('Gera uma imagem com no máximo 300 de largura e 300 de altura.', 'wpstarter').'<br>';
	echo '</span>';
	echo '</p>';

	echo '<p>';
	echo '<b>'.__('Utilizando').' '.__('Thumbnails Nativas', 'wpstarter').'</b><br>';
	echo __('Você pode ativar e configurar as thumbnails nativas do WordPress através dos campos abaixo. Leia as explicações abaixo deles para entender melhor o que deve ser feito.', 'wpstarter');
	echo '</p>';
}

?>
