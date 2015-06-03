<?php

/**
 * The theme options use the name of
 * developers options created before for just
 * have one value on wp_options table
**/



/* ===============================================================
	THEME OPTIONS LINK/PAGE
=============================================================== */
add_action( 'admin_menu', 'wpstarter_menu_themeoptions' );
function wpstarter_menu_themeoptions(){
	add_menu_page(
		__('Opções do Tema', 'wpstarter'), // Page title
		__('Opções do Tema', 'wpstarter'), // Menu Title
		'manage_options', // Capability
		'wpstarter_themeoptions', // admin.php?page=thisfield
		'wpstarter_themeoptions_page', // Function
		'dashicons-admin-generic', // Icon Name (http://melchoyce.github.io/dashicons)
		200 // Menu Position
	);
}



/* ===============================================================
	DISPLAY LINK ON SIDEBAR MENU
=============================================================== */
add_action( 'admin_menu', 'remove_themeoptions_page', 999 );
function remove_themeoptions_page(){
	if( devOpt('themeoptions_display', false) != 'yes' ){
		remove_menu_page( 'wpstarter_themeoptions' );
	}
}



/* ===============================================================
	RECREATE FUNCTION ADD SETTINGS SECTION // From WP v4.0
=============================================================== */
function wpstarter_add_settings_section($id, $title, $callback, $page) {
	global $wp_settings_sections;

	if ( 'misc' == $page ) {
		_deprecated_argument( __FUNCTION__, '3.0', sprintf( __( 'The "%s" options group has been removed. Use another settings group.' ), 'misc' ) );
		$page = 'general';
	}

	if ( 'privacy' == $page ) {
		_deprecated_argument( __FUNCTION__, '3.5', sprintf( __( 'The "%s" options group has been removed. Use another settings group.' ), 'privacy' ) );
		$page = 'reading';
	}

	$wp_settings_sections[$page][$id] = array('id' => $id, 'title' => $title, 'callback' => $callback);
}



/* ===============================================================
	RECREATE FUNCTION ADD SETTINGS FIELD // From WP v4.0
=============================================================== */
function wpstarter_add_settings_field($id, $title, $callback, $page, $section = 'default', $args = array()) {
	global $wp_settings_fields;

	if ( 'misc' == $page ) {
		_deprecated_argument( __FUNCTION__, '3.0', __( 'The miscellaneous options group has been removed. Use another settings group.' ) );
		$page = 'general';
	}

	if ( 'privacy' == $page ) {
		_deprecated_argument( __FUNCTION__, '3.5', __( 'The privacy options group has been removed. Use another settings group.' ) );
		$page = 'reading';
	}

	$wp_settings_fields[$page][$section][$id] = array('id' => $id, 'title' => $title, 'callback' => $callback, 'args' => $args);
}



/* ===============================================================
	CREATING SECTIONS AND FIELDS
=============================================================== */
function wpstarterDeveloperions_config($key, $name){
	global $themeopt_empty;

	// Select All Fields For This Menu
	$sql_fields = new WP_Query(array(
		'meta_query'     => array( 'key'=>'wpthemeoptions_menu', 'value'=>$key ),
		'post_type'      => 'wpthemeoptions',
		'post_status'    => 'publish',
		'meta_key'       => 'wpthemeoptions_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
		'posts_per_page' => -1
	));
	
	if( $sql_fields->have_posts() ) :

	// Add settings section
	wpstarter_add_settings_section( 'themeoptions-'.$key, $name, 'wpstarter_developer_display_section', 'wpstarter_themeoptions' ); 

	// Loop Fields
	while( $sql_fields->have_posts() ) : $sql_fields->the_post();

		// Verify the field menu
		if( get_post_meta(get_the_ID(), 'wpthemeoptions_menu', true) == $key ){

			// Get Fields Configurartion
			$field_slug  = 'wpthemeopt'.get_post_meta(get_the_ID(), 'wpthemeoptions_slug', true);
			$field_desc  = get_post_meta(get_the_ID(), 'wpthemeoptions_description', true);
			$field_title = ((get_the_title() != '') ? get_the_title() : 'Título não definido');

			/* -- If type is not select -- */
			if( get_post_meta(get_the_ID(), 'wpthemeoptions_type', true) != 'select' ){
				$field_args = array(
					'type'      => get_post_meta(get_the_ID(), 'wpthemeoptions_type', true),
					'id'        => $field_slug,
					'name'      => $field_slug,
					'desc'      => $field_desc,
					'label_for' => $field_slug
				); wpstarter_add_settings_field( $field_slug, $field_title, 'wpstarter_developer_display_setting', 'wpstarter_themeoptions', 'themeoptions-'.$key, $field_args );
			
			/* -- If type IS SELECT -- */
			}else if( get_post_meta(get_the_ID(), 'wpthemeoptions_type', true) == 'select' ){

				// Get Values
				$get_select_values = explode(',', get_post_meta(get_the_ID(), 'wpthemeoptions_select_values', true));
				foreach( $get_select_values as $value ){

					$filtered = false;

					if( substr($value, 0, 1) == ' ' ){ // Remove white space before
						echo 'oi1';
						$value = substr($value, 1, strlen($value));
						$filtered = true;
					}

					if( substr($value, -1) == ' ' ){ // Remove white space after
						echo 'oi2';
						$value = substr($value, 0, (strlen($value)-1));
						$filtered = true;
					}

					if( $filtered == false ){
						$current_value = $value;
					}

					$select_values[$value] = $value;
				}

				// Register Field
				$field_args = array(
					'type'      => get_post_meta(get_the_ID(), 'wpthemeoptions_type', true),
					'id'        => $field_slug,
					'name'      => $field_slug,
					'desc'      => $field_desc,
					'label_for' => $field_slug,
					'fields'    => $select_values
				); wpstarter_add_settings_field( $field_slug, $field_title, 'wpstarter_developer_display_setting', 'wpstarter_themeoptions', 'themeoptions-'.$key, $field_args );
			}

		} // If is for this menu

	// If don't have any field for this section...
	endwhile; else:
		$themeopt_empty[] = '
		<article class="themeoptions-'.$key.'">
			<h3 class="title">'.$name.'</h3>
			<p>'.__('As opções do tema não estão configuradas corretamente ou não foram criadas pelo desenvolvedor.', 'wpstarter').'</p>
		</article><!-- end themeoptions-'.$key.' -->
		';
	endif;

} // End Function

function teste($input){
	return $input;
}


/* ===============================================================
	LOOP MENU TO CALL THE FUNCTION TO CREATE SETIONS AND FIELDS
=============================================================== */
$wpstarter_themeoptions_menus_first  = true;
$wpstarter_themeoptions_menus        = devOpt('themeoptions_menus', false);
$wpstarter_themeoptions_menus_exists = false;

add_action('admin_init', 'themeopt_loop_menu', 1 );
function themeopt_loop_menu(){
	global $wpstarter_themeoptions_menus_first, $wpstarter_themeoptions_menus, $wpstarter_themeoptions_menus_exists;

	if( is_array($wpstarter_themeoptions_menus) AND sizeof($wpstarter_themeoptions_menus) >= 1 ){
		foreach( $wpstarter_themeoptions_menus as $key=>$value ){
			if( $value != '' ){
				add_action( 'admin_init', wpstarterDeveloperions_config($key, $value), 10000, 2 );
				$wpstarter_themeoptions_menus_exists = true;
			}
		}
	}
}



/* ===============================================================
	THEMEOPTIONS HTML
=============================================================== */
function wpstarter_themeoptions_page(){
global $wpstarterversion;
?>
<div class="wrap">
	<form class="wpstarter-developer" method="post" enctype="multipart/form-data" action="options.php">


		<!-- TITLE -->
		<div class="title">
			<h2>
				<i class="dashicons dashicons-admin-generic"></i>
				<?php _e('Opções do Tema', 'wpstarter'); ?>
				<span>(<?php bloginfo('name'); ?>)</span>
			</h2>
		</div><!-- end .title -->


		<!-- UPDATED TRUE -->
		<div class="updated-true" <?php if( isset($_GET['settings-updated']) AND $_GET['settings-updated'] == 'true' ){ echo 'style="display: block;"'; } ?>>
			<?php _e('Alterações salvas com sucesso.', 'wpstarter'); ?>
		</div><!-- end .updated-true -->


		<!-- BUTTONS -->
		<div class="buttons">
			<div class="left">
				<?php _e('Aqui você pode alterar algumas opções do tema criadas pelo desenvolvedor.', 'wpstarter'); ?>
			</div><!-- end .left -->

			<div class="right">
				<input type="submit" class="button-primary" value="<?php _e('Salvar Alterações', 'wpstarter'); ?>" />
			</div><!-- end .right -->
		<br class="clear">
		</div><!-- end .buttons -->


		<!-- CONTENT -->
		<div class="content">
			<!-- Sidebar -->
			<aside class="sidebar">
				<ul>
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

					/* -- Get Values -- */
					$first_menu = true;
					if( sizeof($wpstarter_themeoptions_menus) >= 1 ){
						foreach( $wpstarter_themeoptions_menus as $key=>$value ){
							echo '
							<li'.( ($first_menu == true) ? ' class="active"' : '' ).'>
								<a href="javascript:void(0);" data-section="'.$key.'">
									'.$value.'
								</a>
							</li>
							'; $first_menu = false;
						} unset( $first_menu );
					}else{
						echo '
						<li class="active">
							<a href="javascript:void(0);" data-section="generalempty">
								'.__('Erro', 'wpstarter').'
							</a>
						</li>
						';
					}
					?>
				</ul>		
			</aside><!-- end .sidebar -->

			<!-- Content Sections -->
			<div class="fields">
				<?php settings_fields('wpstarterDeveloper'); wpstarter_do_settings_sections('wpstarter_themeoptions'); ?>
				<div style="display:none;"><?php wpstarter_do_settings_sections('wpstarter_developer'); ?></div>

				<?php if( $GLOBALS['wpstarter_themeoptions_menus_exists'] == false ){ // If is empty ?>
					<article class="themeoptions-errorempty" style="display: block;">
						<h3 class="title"><?php _e('Erro', 'wpstarter'); ?></h3>
						<p><?php _e('As opções do tema não estão configuradas corretamente ou não foram criadas pelo desenvolvedor.', 'wpstarter'); ?></p>
					</article><!-- end themeoptions-generalempty -->
				<?php }?>

				<?php
					if( isset($GLOBALS['themeopt_empty']) AND is_array($GLOBALS['themeopt_empty']) ){
						$cnt_loop_themeopts = 1;
						foreach( $GLOBALS['themeopt_empty'] as $html ){
							if( $cnt_loop_themeopts == 1 ){
								echo str_replace('<article', '<article style="display:block"', $html);
							}else{
								echo $html;
							} $cnt_loop_themeopts++;
						} // End Foreach
					} // End If
				?>
			</div><!-- end .fields -->
		</div><!-- end .content -->


		<!-- BUTTONS -->
		<div class="buttons">
			<div class="left">
				<?php _e('Opções criadas com o', 'wpstarter'); ?> <a href="http://getwpstarter.com/" target="_blank">WP Starter</a>.
			</div><!-- end .left -->

			<div class="right">
				<input type="submit" class="button-primary" value="<?php _e('Salvar Alterações', 'wpstarter'); ?>" />
			</div><!-- end .right -->
		<br class="clear">
		</div><!-- end .buttons -->


	</form><!-- end .wpstarter-developer -->
</div><!-- end .wrap -->

<?php
} // End function wpstarter_themeoptions_page



/* ===============================================================
	CALL THEME OPTIONS VALUES
=============================================================== */
function options($string, $echo=true){ // 1. Option // 2. True to Echo
	$option = get_option('wpstarterDeveloper');
	$string = 'wpthemeopt'.$string;
	if( $echo == true ){ // Echo Option
		echo $option[$string];
	}else{ // Return Option
		return $option[$string];
	}
}

?>