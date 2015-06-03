<?php

/**
 * The theme options use the name of
 * developers options created before for just
 * have one value on wp_options table
**/



/* ===============================================================
	THEME OPTIONS LINK/PAGE
=============================================================== */
add_action( 'admin_menu', 'devhelper_menu_themeoptions' );
function devhelper_menu_themeoptions(){
	add_menu_page(
		__('Opções do Tema', 'devhelper'), // Page title
		__('Opções do Tema', 'devhelper'), // Menu Title
		'manage_options', // Capability
		'devhelper_themeoptions', // admin.php?page=thisfield
		'devhelper_themeoptions_page', // Function
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
		remove_menu_page( 'devhelper_themeoptions' );
	}
}



/* ===============================================================
	RECREATE FUNCTION ADD SETTINGS SECTION // From WP v4.0
=============================================================== */
function devhelper_add_settings_section($id, $title, $callback, $page) {
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
function devhelper_add_settings_field($id, $title, $callback, $page, $section = 'default', $args = array()) {
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
function devhelperDeveloperions_config($key, $name){
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
	devhelper_add_settings_section( 'themeoptions-'.$key, $name, 'devhelper_developer_display_section', 'devhelper_themeoptions' ); 

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
				); devhelper_add_settings_field( $field_slug, $field_title, 'devhelper_developer_display_setting', 'devhelper_themeoptions', 'themeoptions-'.$key, $field_args );
			
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
				); devhelper_add_settings_field( $field_slug, $field_title, 'devhelper_developer_display_setting', 'devhelper_themeoptions', 'themeoptions-'.$key, $field_args );
			}

		} // If is for this menu

	// If don't have any field for this section...
	endwhile; else:
		$themeopt_empty[] = '
		<article class="themeoptions-'.$key.'">
			<h3 class="title">'.$name.'</h3>
			<p>'.__('As opções do tema não estão configuradas corretamente ou não foram criadas pelo desenvolvedor.', 'devhelper').'</p>
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
$devhelper_themeoptions_menus_first  = true;
$devhelper_themeoptions_menus        = devOpt('themeoptions_menus', false);
$devhelper_themeoptions_menus_exists = false;

add_action('admin_init', 'themeopt_loop_menu', 1 );
function themeopt_loop_menu(){
	global $devhelper_themeoptions_menus_first, $devhelper_themeoptions_menus, $devhelper_themeoptions_menus_exists;

	if( is_array($devhelper_themeoptions_menus) AND sizeof($devhelper_themeoptions_menus) >= 1 ){
		foreach( $devhelper_themeoptions_menus as $key=>$value ){
			if( $value != '' ){
				add_action( 'admin_init', devhelperDeveloperions_config($key, $value), 10000, 2 );
				$devhelper_themeoptions_menus_exists = true;
			}
		}
	}
}



/* ===============================================================
	THEMEOPTIONS HTML
=============================================================== */
function devhelper_themeoptions_page(){
?>
<div class="wrap">
	<form class="devhelper-developer" method="post" enctype="multipart/form-data" action="options.php">


		<!-- TITLE -->
		<div class="title">
			<h2>
				<i class="dashicons dashicons-admin-generic"></i>
				<?php _e('Opções do Tema', 'devhelper'); ?>
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
				<?php _e('Aqui você pode alterar algumas opções do tema criadas pelo desenvolvedor.', 'devhelper'); ?>
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

					/* -- Get Values -- */
					$first_menu = true;
					if( sizeof($devhelper_themeoptions_menus) >= 1 ){
						foreach( $devhelper_themeoptions_menus as $key=>$value ){
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
								'.__('Erro', 'devhelper').'
							</a>
						</li>
						';
					}
					?>
				</ul>		
			</aside><!-- end .sidebar -->

			<!-- Content Sections -->
			<div class="fields">
				<?php settings_fields('devhelperDeveloper'); devhelper_do_settings_sections('devhelper_themeoptions'); ?>
				<div style="display:none;"><?php devhelper_do_settings_sections('devhelper_page'); ?></div>

				<?php if( $GLOBALS['devhelper_themeoptions_menus_exists'] == false ){ // If is empty ?>
					<article class="themeoptions-errorempty" style="display: block;">
						<h3 class="title"><?php _e('Erro', 'devhelper'); ?></h3>
						<p><?php _e('As opções do tema não estão configuradas corretamente ou não foram criadas pelo desenvolvedor.', 'devhelper'); ?></p>
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
				<?php _e('Opções criadas com o', 'devhelper'); ?> <a href="http://mattdeveloper.github.io/devhelper" target="_blank">Dev Helper</a>.
			</div><!-- end .left -->

			<div class="right">
				<input type="submit" class="button-primary" value="<?php _e('Salvar Alterações', 'devhelper'); ?>" />
			</div><!-- end .right -->
		<br class="clear">
		</div><!-- end .buttons -->


	</form><!-- end .devhelper-developer -->
</div><!-- end .wrap -->

<?php
} // End function devhelper_themeoptions_page



/* ===============================================================
	CALL THEME OPTIONS VALUES
=============================================================== */
function options($string, $echo=true){ // 1. Option // 2. True to Echo
	$option = get_option('devhelperDeveloper');
	$string = 'wpthemeopt'.$string;
	if( $echo == true ){ // Echo Option
		echo $option[$string];
	}else{ // Return Option
		return $option[$string];
	}
}

?>