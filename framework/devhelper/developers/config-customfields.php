<article class="developer-customfields">
	<h3 class="title"><?php _e('Custom Fields', 'devhelper'); ?></h3>
	
	<p><?php _e('O plugin', 'devhelper'); ?>
	<a href="http://www.advancedcustomfields.com/" target="_blank" title="<?php _e('Abrir em nova guia.', 'devhelper'); ?>">Advanced Custom Fields</a>
	<?php _e('está implementado automaticamente no tema. Para um painel de administração mais limpo decidimos retirar os links do plugin do menu do WordPress e colocá-los aqui.', 'devhelper'); ?></p>

	<p><?php _e('Caso queira você pode instalar o plugin através de plugins e os links do plugin iram aparecer no menu do WordPress, porém, nós não recomendamos isso pois não irá acrescentar em nada
	no seu tema já que o plugin completo está implementado no tema. Para exibir os links no menu do WordPress recomendamos que abra o arquivo 
	<b>_framework/framework.php</b> e mude o valor da constante <b>ACF_LITE</b> na linha <b>59</b> para <b>false</b>.', 'devhelper'); ?></p>

  <?php if( is_plugin_active('advanced-custom-fields-pro/acf.php') ){ ?>
    <p><a class="button" href="<?php echo admin_url(); ?>edit.php?post_type=acf-field-group" target="_blank"><?php _e('Campos Personalizados', 'devhelper'); ?></a></p>
  <?php }else{ ?>
    <p><a class="button" href="<?php echo admin_url(); ?>edit.php?post_type=acf" target="_blank"><?php _e('Campos Personalizados', 'devhelper'); ?></a></p>
  <?php } ?>

</article><!-- end .developer-custompostype -->