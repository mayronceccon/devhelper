<?php

/* ===============================================================
	DEVELOPER MENU LINK/PAGE
=============================================================== */
add_action( 'admin_menu', 'devhelper_menu_developer' );
function devhelper_menu_developer(){
	add_menu_page(
		__('Desenvolvedor', 'devhelper'), // Page title
		__('Desenvolvedor', 'devhelper'), // Menu Title
		'manage_options', // Capability
		'devhelper_page', // admin.php?page=thisfield
		'devhelper_developer_page', // Function
		'dashicons-media-code', // Icon Name (http://melchoyce.github.io/dashicons)
		300 // Menu Position
	);
}



/* ===============================================================
	DEVELOPER HTML
=============================================================== */
function devhelper_developer_page(){
global $wpstarterversion;
?>
<div class="wrap">
	<form class="devhelper-developer" method="post" enctype="multipart/form-data" action="options.php">


		<!-- TITLE -->
		<div class="title">
			<h2>
				<i class="dashicons dashicons-media-code"></i>
				<?php _e('Opções do Desenvolvedor', 'devhelper'); ?>
				<span>(<?php bloginfo('name'); ?>)</span>
			</h2>
		</div><!-- end .title -->


		<!-- UPDATED TRUE -->
		<div class="updated-true" <?php if( isset($_GET['settings-updated']) AND $_GET['settings-updated'] == 'true' ){ echo 'style="display: block;"'; } ?>>
			<?php _e('Alterações salvas com sucesso.', 'devhelper'); ?>
		</div><!-- end .updated-true -->


		<!-- BUTTONS -->
		<div class="buttons">
			<div class="left">
				<?php _e('Precisa de ajuda?', 'devhelper'); ?>
				<a href="http://mattdeveloper.github.io/wpstarter/" target="_blank" title="<?php _e('Saiba mais sobre o Dev Helper', 'devhelper'); echo ' v'.$wpstarterversion; ?>"><?php _e('Clique aqui', 'devhelper'); ?></a>.
			</div><!-- end .left -->

			<div class="right">
				<input type="submit" class="button-primary" value="<?php _e('Salvar Alterações', 'devhelper'); ?>" />
			</div><!-- end .right -->
		<br class="clear">
		</div><!-- end .buttons -->


		<!-- CONTENT -->
		<div class="content">
			<!-- Sidebar -->
			<aside class="sidebar">
				<ul>
					<li class="active"><a href="javascript:void(0);" data-section="general"><?php _e('Geral', 'devhelper'); ?></a></li>
					<li><a href="javascript:void(0);" data-section="seo"><?php _e('SEO', 'devhelper'); ?></a></li>
					<li><a href="javascript:void(0);" data-section="thumbnails"><?php _e('Thumbnails', 'devhelper'); ?></a></li>
					<li class="divider"></li>
					<li><a href="javascript:void(0);" data-section="themeoptions"><?php _e('Opções do Tema', 'devhelper'); ?></a></li>
					<li><a href="javascript:void(0);" data-section="customposttypes"><?php _e('Custom Post Types', 'devhelper'); ?></a></li>
					<li><a href="javascript:void(0);" data-section="customfields"><?php _e('Custom Fields', 'devhelper'); ?></a></li>
					<li class="divider"></li>
					<li><a href="javascript:void(0);" data-section="wplogin"><?php _e('WP Login', 'devhelper'); ?></a></li>
					<li><a href="javascript:void(0);" data-section="footer"><?php _e('Rodapé', 'devhelper'); ?></a></li>
					<li class="divider"></li>
					<li><a href="javascript:void(0);" data-section="removemenus"><?php _e('Remover Menus', 'devhelper'); ?></a></li>
					<li><a href="javascript:void(0);" data-section="reordermenu"><?php _e('Reordenar Menu', 'devhelper'); ?></a></li>
					<li class="divider"></li>
					<li><a href="javascript:void(0);" data-section="adminbar"><?php _e('Admin Bar', 'devhelper'); ?></a></li>
					<li><a href="javascript:void(0);" data-section="advanced"><?php _e('Avançado', 'devhelper'); ?></a></li>
				</ul>
			</aside><!-- end .sidebar -->

			<!-- Content Sections -->
			<div class="fields">
				<?php settings_fields('wpstarterDeveloper'); devhelper_do_settings_sections('devhelper_page'); ?>
				<div style="display:none;"><?php devhelper_do_settings_sections('devhelper_themeoptions'); ?></div>

				<?php require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-general.php'); ?>
				<?php require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-customposttypes.php'); ?>
				<?php require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-customfields.php'); ?>
			</div><!-- end .fields -->
		</div><!-- end .content -->


		<!-- BUTTONS -->
		<div class="buttons">
			<div class="left">
				<?php _e('Este é um projeto Open Source. Ajude-nos a melhorá-lo', 'devhelper'); ?> <a href="https://github.com/mattdeveloper/devhelper" target="_blank">https://github.com/mattdeveloper/wpstarter</a>.
			</div><!-- end .left -->

			<div class="right">
				<input type="submit" class="button-primary" value="<?php _e('Salvar Alterações', 'devhelper'); ?>" />
			</div><!-- end .right -->
		<br class="clear">
		</div><!-- end .buttons -->


	</form><!-- end .devhelper-developer -->
</div><!-- end .wrap -->

<?php }



/* ===============================================================
	DEVELOPER CONFIG SECTIONS
=============================================================== */
// Config general is in the html
require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-seo.php');
require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-thumbnails.php');

require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-themeoptions.php');
// Config custom post types is in the html
// Config custom fields is in the html

require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-wplogin.php');
require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-footer.php');

require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-removemenus.php');
require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-reordermenu.php');

require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-adminbar.php');
require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/config-advanced.php');



/* ===============================================================
	DEVELOPER SHOW SECTIONS
=============================================================== */
function devhelper_developer_display_section($section){}
function devhelper_do_settings_sections($page){  // Custom Do Settings Sections. Base: WordPress 4.0
	global $wp_settings_sections, $wp_settings_fields;

	if( !isset($wp_settings_sections[$page]) ){
		return;
	}

	foreach( (array)$wp_settings_sections[$page] as $section ){
		echo '<article class="'.$section['id'].'">';
			if( $section['title'] ){
				echo "<h3>{$section['title']}</h3>\n";
			}

			if( $section['callback'] ){
				call_user_func( $section['callback'], $section );
			}

			if ( !isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section['id']]) ){
				continue;
			}

			echo '<table class="form-table">';
			do_settings_fields( $page, $section['id'] );
			echo '</table>';
		echo '</article>';
	}
}



/* ===============================================================
 * Function to display the settings on the page
 * This is setup to be expandable by using a switch on the type variable.
 * In future you can add multiple types to be display from this function,
 * Such as checkboxes, select boxes, file upload boxes etc.
=============================================================== */
function devhelper_developer_display_setting($args)
{
	extract($args);

	if( isset($themeopt) AND $themeopt == true ){ $option_name = 'wpstarterThemeOptions'; }else{ $option_name = 'wpstarterDeveloper'; }
	$options = get_option( $option_name );

	switch($type){

		/* Type: Button */
		case 'button':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr($options[$id]);
			echo "<a href=\"$href\" class=\"button\">$text</a>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;


		/* Type: Text */
		case 'text':
			$options;
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr($options[$id]);
			echo "<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;


		/* Type: Textarea */
		case 'textarea':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr($options[$id]);
			if( isset($rows) AND is_numeric($rows) AND $rows > 0 ){ $rows = $rows; }else{ $rows = 3; }
			echo "<textarea class='regular-text $class' id='$id' name='".$option_name."[$id]' rows='$rows'>$options[$id]</textarea>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;


		/* Type: Repeater */
		case 'repeater':
			$options[$id] = ($options[$id]);

			// Show Fields
			echo '<div class="repeater-fileds view_'.$id.'">';
			if( is_array($options[$id]) ){
				foreach( $options[$id] as $value ){
					if( str_replace(' ', '', $value) != '' ){
						echo "<div>
								<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id][]' value='$value'>
								<a href=\"javascript:void(0);\" class=\"remove-repeater-field\">".__('Remover', 'devhelper')."</a>
							</div>
						";
					}
				}
			}
			echo '</div><!-- end .repeater-fields -->';

			// Copy of the input to clone
			echo '<div class="copy_'.$id.'" style="display:none;">';
			echo "<div>
					<input class='regular-text $class' type='text' id='$id' name='" . $option_name . "[$id][]' value=''>
					<a href=\"javascript:void(0);\" class=\"remove-repeater-field\">".__('Remover', 'devhelper')."</a>
				</div>
			";
			echo '</div><!-- end .copy_* -->';

			// Button to Add New Fields
			echo '<a href="javascript:void(0);" class="button-primary add-repeater-field" data-id="'.$id.'">'.__('Adicionar Novo', 'devhelper').'</a>';

			//Description
			echo ($desc != '') ? "<br /><span class='description'>$desc<br>"."</span>" : "";
			echo '<span class="description" style="display:block;"><b>'.__('Obs', 'devhelper').":</b> ".__('Deixe um valor em branco e ele será excluído automaticamente.', 'devhelper').'</span>';
		break;


		/* Type: Select */
		case 'select':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr($options[$id]);
			if( is_array($fields) AND sizeof($fields) >= 1 ){
				echo "<select id='$id' name='".$option_name."[$id]'>";
					foreach( $fields as $key=>$value ){
						echo "<option value='$key' ".( $key==$options[$id] ? 'selected' : '' ).">$value</option>";
					}
				echo "</select>";
				echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			}else{
				echo __('O desenvolvedor do site não especificou os valores para este campo.', 'devhelper');
			}
		break;


		/* Type: Checkbox */
		case 'checkbox':
			if( is_array($fields) AND sizeof($fields) >= 1 ){
				echo '<ul class="checkbox '.$class.'">';
					foreach( $fields as $key=>$value ){
						echo '<li>';
						echo '<label>';
							echo "<input type=\"checkbox\" name='".$option_name."[$id][]' id=\"$id\" value='$key' ".( (is_array($options[$id]) AND in_array($key, $options[$id]) ) ? 'checked' : '' ).">";
							echo $value;
						echo '</label>';
						echo '</li>';
					}
				echo '</ul>';
				echo ($desc != '') ? "<span class='description'>$desc</span>" : "";
			}else{
				echo __('O desenvolvedor do site não especificou os valores para este campo.', 'devhelper');
			}
		break;


		/* Type: Checkbox Menu(Developer) */
		case 'checkbox-menu':
			echo '<ul class="checkbox '.$class.'">';
				foreach( $fields as $key=>$value ){
					if( strstr($key, '*sub*') ){ // If is a submenu
						echo '<li class="sub">';
						echo '<label>';
							echo "<input type=\"checkbox\" name='".$option_name."[$id][]' id=\"$id\" value='$key' ".( (is_array($options[$id]) AND in_array($key, $options[$id]) ) ? 'checked' : '' ).">";
							echo $value;
						echo '</label>';
						echo '</li>';
					}else{ // If is not a submenu
						echo '<li>';
						echo '<label>';
							echo "<input type=\"checkbox\" name='".$option_name."[$id][]' id=\"$id\" value='$key' ".( (is_array($options[$id]) AND in_array($key, $options[$id]) ) ? 'checked' : '' ).">";
							echo $value;
						echo '</label>';
						echo '</li>';
					}
				}
			echo '</ul>';
		break;


		/* Type: Image */
		case 'image':
			$options[$id]  = stripslashes($options[$id]);
			$options[$id]  = esc_attr($options[$id]);
			$image_details = wp_get_attachment_metadata($options[$id]);
			$image_file    = ( isset($image_details['file']) AND $image_details['file'] != '' ) ? get_site_url().'/wp-content/uploads/'.$image_details['file'] : '';
			$image_show    = ( $image_file != '' ) ? 'style="display:block;"' : '';
			echo "<input type='hidden' id='$id' name='".$option_name."[$id]' value='$options[$id]'>"; // Image ID
			echo '<input type="text" id="" disabled class="regular-text '.$id.'_imageurl image-url" value="'.$image_file.'"> '; // Image URL
			echo '<input type="button" id="" data-id="'.$id.'" class="button add-image" value="'.__('Enviar Imagem', 'devhelper').'">'; // Select Image
			echo ' <input type="button" class="clean-image button" data-id="'.$id.'" value="'.__('Limpar', 'devhelper').'">'; // Clean Image
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; // Field Description
			echo '<div class="img-preview imgprev_'.$id.'" '.$image_show.'><img src="'.$image_file.'" max-height="100" alt=""></div>'; // Image Preview
		break;


		/* Type: Color Picker */
		case 'color-picker':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr($options[$id]);
			if( $options[$id] == '' AND isset($default) AND $default != '' ){ $options[$id] = $default; }
			echo ($desc != '') ? "<span class='description'>$desc</span>" : "";
			echo "<br><input class='color-field $class' type='text' id='$id' name='".$option_name."[$id]' value='$options[$id]' data-default-color=\"$default\" />";
		break;


		/* Type: Sortable */
		case 'sortable':
			echo '<ul class="sortable '.$class.'">';
				if( is_array($fields) AND sizeof($fields) >= 1 ){
					foreach( $fields as $key=>$value ){
						echo '<li>';
							echo $value;
							echo "<input class='regular-text' type='hidden' id='$id' name='".$option_name."[$id][]' value='$key' />";
						echo '</li>';
					}
				}
			echo '</ul><!-- end .sortable -->';
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;


		/* Type: Repeater More(Developer) */
		case 'repeater-more':
			$options[$id] = ($options[$id]);

			// Validating Fields
			if( is_array($fields) AND sizeof($fields) >= 1 ){

				// Show Fields
				echo '<div class="repeater-fileds view_more_'.$id.'">';
				if( is_array($options[$id]) AND sizeof($options[$id]) >= 1 ){
					echo "<div>";

						/* Count Fields */
						$cnt_fields  = sizeof($fields);
						$fields_size = 100 / $cnt_fields;

						/* Getting Fields Names */
						$fields_names = array();
						foreach( $fields as $key=>$value ){
							$fields_names[] = $value;
						}

						/* Loop Saved Data */
						$cnt_field_name = 0;
						foreach( $options[$id] as $uniqid=>$thefields ){
							foreach( $thefields as $key=>$value ){
								echo '<div style="width: '.($fields_size-1).'%; padding-right: 1%; margin-bottom: 0; float: left;">';
									echo '<i style="font-size:13px;">'.$fields_names[$cnt_field_name].'</i><br>';
									echo "<input class='regular-text $class' type='text' id='$id' name='wpstarterDeveloper[$id][$uniqid][$key]' value='$value'>";
								echo '</div>';
								$cnt_field_name++;
							}

							echo '<br style="clear:both;"><a href="javascript:void(0);" class="remove-repeater-field-more" style="display:block; margin-bottom:10px">'.__('Remover', 'devhelper').'</a>';

							// Clean loop count
							$cnt_field_name = 0;
						}
					echo "</div>";
				}
				echo '</div><!-- end .repeater-fields -->';

				// Copy of the input to clone
				echo '<div class="copy_more_'.$id.'" style="display:none;">';
				echo "<div>";
					/* Count Fields / Set Width */
					$cnt_fields    = sizeof($fields);
					$fields_size   = 100 / $cnt_fields;

					/* Creating Fields */
					foreach( $fields as $key=>$value ){
						echo '<div style="width: '.($fields_size-1).'%; padding-right: 1%; margin-bottom: 0; float: left;">';
							echo '<i style="font-size:13px;">'.$value.'</i><br>';
							echo "<input class=\"regular-text $class\" type=\"text\" id=\"$id\" data-name=\"$option_name\" data-key=\"$key\" name=\"\" value=\"\">";
						echo '</div>';
					}

					// Remove
					echo "<br style=\"clear:both;\"><a href=\"javascript:void(0);\" class=\"remove-repeater-field-more\">".__('Remover', 'devhelper')."</a>";
				echo "</div>";
				echo '</div><!-- end .copy_* -->';

				// Button to Add New Fields
				echo '<a href="javascript:void(0);" class="button-primary add-repeater-field-more" data-id="'.$id.'">Adicionar Novo</a>';

				//Description
				echo ($desc != '') ? "<br /><span class='description'>$desc<br>"."</span>" : "";
				echo '<span class="description" style="display:block;"><b>'.__('Obs', 'devhelper').":</b> ".__('Deixe um valor em branco e ele será excluído automaticamente.', 'devhelper').'</span>';

			} // End if validating fields
		break;
	}
}



/* ===============================================================
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
=============================================================== */
function devhelper_validate_settings($input)
{
  foreach($input as $k => $v)
  {
    $newinput[$k] = trim($v);

    // Check the input is a letter or a number
    if(!preg_match('/^[A-Z0-9 _]*$/i', $v)) {
      $newinput[$k] = '';
    }
  }

  return $newinput;
}



/* ===============================================================
	DEVELOPER CONFIG CODES
=============================================================== */
require_once(DEVHELPER__PLUGIN_DIR.'framework/devhelper/developers/_configcodes.php');

?>
