<article class="developer-customfields">
	<h3 class="title"><?php _e('Custom Fields', 'wpstarter'); ?></h3>
	
	<p><?php _e('O plugin', 'wpstarter'); ?>
	<a href="http://www.advancedcustomfields.com/" target="_blank" title="<?php _e('Abrir em nova guia.', 'wpstarter'); ?>">Advanced Custom Fields</a>
	<?php _e('está implementado automaticamente no tema. Para um painel de administração mais limpo decidimos retirar os links do plugin do menu do WordPress e colocá-los aqui.', 'wpstarter'); ?></p>

	<p><?php _e('Caso queira você pode instalar o plugin através de plugins e os links do plugin iram aparecer no menu do WordPress, porém, nós não recomendamos isso pois não irá acrescentar em nada
	no seu tema já que o plugin completo está implementado no tema. Para exibir os links no menu do WordPress recomendamos que abra o arquivo 
	<b>_framework/framework.php</b> e mude o valor da constante <b>ACF_LITE</b> na linha <b>59</b> para <b>false</b>.', 'wpstarter'); ?></p>

	<p><a class="button" href="<?php echo admin_url(); ?>edit.php?post_type=acf"><?php _e('Campos Personalizados', 'wpstarter'); ?></a></p>

</article><!-- end .developer-custompostype -->