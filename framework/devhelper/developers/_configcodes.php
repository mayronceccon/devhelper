<?php
/*
 * Codes Order
 *
 * 00. Get Options
 * 01. General
 * 02. SEO
 * 03. Thumbnails
 * 04. Theme Options
 * 05. Custom Post Types
 * 06. Custom Fields
 * 07. WP Login
 * 08. Footer
 * 09. Remove Menus
 * 10. Reorder Menu
 * 11. Admin Bar
 * 12. Advanced
*/



/* ===============================================================
	00. CONFIG: GET DEVELOPER OPTIONS
=============================================================== */
function devOpt($string, $echo=true){ // 1. Developer Option // 2. True to Echo
	$option = get_option('wpstarterDeveloper');
	if( !isset($option[$string]) ){
		$option[$string] = '';
	}else{
		if( $echo == true ){ // Echo Option
			echo $option[$string];
		}else{ // Return Option
			return $option[$string];
		}
	}
}



/* ===============================================================
	01. GENERAL
=============================================================== */
// Nothing to do



/* ===============================================================
	02. CONFIG: SEO
=============================================================== */
require_once('_configseo.php');



/* ===============================================================
	03. CONFIG: THUMBNAILS
=============================================================== */
if( devOpt('thumbnails_enable', false) == 'yes' ){
	add_theme_support('post-thumbnails');

	if( is_array(devOpt('thumbnails_sizes', false)) AND sizeof(devOpt('thumbnails_sizes', false)) >= 1 ){

		foreach(devOpt('thumbnails_sizes', false) as $value){

			$thumbnail = str_replace(' ', '', $value);
			$thumbnail = str_replace('.', '', $thumbnail);
			$thumbnail = explode('/', $thumbnail);

			if( count($thumbnail) == 4 ){ // Validating parameters
				$thumbnail['id']     = $thumbnail[0];
				$thumbnail['width']  = $thumbnail[1];
				$thumbnail['height'] = $thumbnail[2];
				$thumbnail['crop']   = $thumbnail[3];

				if( is_numeric($thumbnail['width']) AND is_numeric($thumbnail['height'])){
					if( $thumbnail['crop'] == 'false' OR $thumbnail['crop'] == false ){
						$thumbnail['crop'] = false;
					}else{
						$thumbnail['crop'] = true;
					}
					add_image_size( $thumbnail['id'], $thumbnail['width'], $thumbnail['height'], $thumbnail['crop'] );
				}else{
					continue;
				}
			}else{
				continue;
	        }

	        unset($thumbnail);
		}
	}
}


/* ===============================================================
	04. CONFIG: THEME OPTIONS
=============================================================== */
add_action( 'init', 'wpthemeoptions_post_types', 0 );
function wpthemeoptions_post_types(){
	$labels = array(
		'name'                => _x( 'Editar Opções', 'Post Type General Name', 'wpstarter' ),
		'singular_name'       => _x( 'Editar Opção', 'Post Type Singular Name', 'wpstarter' ),
		'menu_name'           => __( 'Gerenciar Opções', 'wpstarter' ),
		'all_items'           => __( 'Todas as Opções', 'wpstarter' ),
		'add_new_item'        => __( 'Adicionar Nova Opção', 'wpstarter' ),
		'add_new'             => __( 'Adicionar Nova', 'wpstarter' ),
		'edit_item'           => __( 'Editar Opção', 'wpstarter' ),
		'update_item'         => __( 'Atualizar Opção', 'wpstarter' ),
		'search_items'        => __( 'Buscar Opções', 'wpstarter' ),
		'not_found'           => __( 'Nada encontrado', 'wpstarter' ),
		'not_found_in_trash'  => __( 'Nada encontrado na lixeira', 'wpstarter' ),
	);

	$args = array(
		'label'               => 'wpthemeoptions',
		'description'         => __( 'Opções do Tema.', 'wpstarter' ),
		'labels'              => $labels,
		'supports'            => array( 'title', ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 9999999,
		'can_export'          => false,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'wpthemeoptions', $args );
}
require_once('_configthemeoptions.php');



/* ===============================================================
	05. CONFIG: CUSTOM POST TYPES
=============================================================== */
add_action( 'init', 'developers_post_types', 0 );
function developers_post_types(){
	$labels = array(
		'name'                => _x( 'Custom Post Types', 'Post Type General Name', 'wpstarter' ),
		'singular_name'       => _x( 'Custom Post Type', 'Post Type Singular Name', 'wpstarter' ),
		'menu_name'           => __( 'Custom Post Type', 'wpstarter' ),
		'all_items'           => __( 'Todos Itens', 'wpstarter' ),
		'add_new_item'        => __( 'Adicionar Novo Item', 'wpstarter' ),
		'add_new'             => __( 'Adicionar Novo', 'wpstarter' ),
		'edit_item'           => __( 'Editar Item', 'wpstarter' ),
		'update_item'         => __( 'Atualizar Item', 'wpstarter' ),
		'search_items'        => __( 'Buscar Itens', 'wpstarter' ),
		'not_found'           => __( 'Nada encontrado', 'wpstarter' ),
		'not_found_in_trash'  => __( 'Nada encontrado na lixeira', 'wpstarter' ),
	);

	$args = array(
		'label'               => 'customposttypes',
		'description'         => __( 'Tipos de post customizados.', 'wpstarter' ),
		'labels'              => $labels,
		'supports'            => array( 'title', ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 9999999,
		'can_export'          => false,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'customposttypes', $args );
}

/* ----- LOOP Developer Custom Post Types ----- */
require_once('_configcustomposttypes.php');



/* ===============================================================
	07. CONFIG: WP LOGIN
=============================================================== */

/* ----- CSS: Background Color ----- */
if( devOpt('wplogin_bg_color', false) != '' and strstr(devOpt('wplogin_bg_color', false), '#') ){
	$wpstarter_login['bg'] = devOpt('wplogin_bg_color', false);
}else{
	$wpstarter_login['bg'] = '#ecf0f1';
}


/* ----- CSS: Login Image ----- */
if( devOpt('wplogin_image', false) != '' ){
	$wpstarter_login['img'] = wp_get_attachment_image_src( devOpt('wplogin_image', false), 'full' );
	$wpstarter_login['img'] = $wpstarter_login['img'][0];
}else{
	$wpstarter_login['img'] = THEMEROOT.'/_framework/wpstarter/_assets/img/wplogin-wpstarter.png';
}

/* ----- CSS: Background Color ----- */
if( devOpt('wplogin_color', false) != '' and strstr(devOpt('wplogin_color', false), '#') ){
	$wpstarter_login['btn-color'] = devOpt('wplogin_color', false);
}else{
	$wpstarter_login['btn-color'] = '#3498db';
}

/* ----- CSS: Make Changes ----- */
add_action('login_enqueue_scripts', 'wpstarter_login_css');
function wpstarter_login_css(){
	global $wpstarter_login;
	echo '
	<style>
		/* -- Background -- */
		body.login { background: '.$wpstarter_login['bg'].'; }

		/* -- Image -- */
		.login h1 a {
			background-image: url(\''.$wpstarter_login['img'].'\');
			background-size: 100px auto;
			width: 300px;
			height: 60px;
		}

		/* -- Input -- */
		.login input[type=text], .login input[type=password] {
			background: #fff;
			border: 1px solid #eee;

			font-size: 14px;
			font-weight: 100;
			padding: 5px;

			-webkit-box-shadow: none;
			   -moz-box-shadow: none;
					box-shadow: none;
		}

			.login input[type=text]:focus, .login input[type=password]:focus, input[type=checkbox]:focus {
				background: #fff;
				border: 1px solid #ccc;
				-webkit-box-shadow: none;
				   -moz-box-shadow: none;
						box-shadow: none;
			}

		/* -- Remember Me -- */
		.login .forgetmenot {
			margin-top: 5px;
		}

		/* -- Login Button -- */
		.login .button-primary {
			background: transparent;
			background-color: transparent;
			border: 1px solid '.$wpstarter_login['btn-color'].';

			width: 120px;
			color: '.$wpstarter_login['btn-color'].';
			text-transform: uppercase;

			-webkit-box-shadow: none;
			   -moz-box-shadow: none;
					box-shadow: none;
			-webkit-border-radius: 0px;
			   -moz-border-radius: 0px;
					border-radius: 0px;
		}

			.login .button-primary:hover, .login .button-primary:focus, .login .button-primary:active {
				background: '.$wpstarter_login['btn-color'].';
				background-color: '.$wpstarter_login['btn-color'].';
				border-color: '.$wpstarter_login['btn-color'].';
				-webkit-box-shadow: none;
				   -moz-box-shadow: none;
						box-shadow: none;
			}

			.login .button-primary:focus {
				background: transparent;
				color: '.$wpstarter_login['btn-color'].';
			}

		/* -- Links -- */
		.login p#nav, .login p#backtoblog {
			text-align: center;
		}

			.login p#nav a:hover, .login p#backtoblog a:hover {
				color: '.$wpstarter_login['btn-color'].';
			}
	</style>
	';
}

/* ----- LOGO: URL ----- */
if( str_replace(' ', '', devOpt('wplogin_url', false)) != '' ){ $wpstarter_login['url'] = devOpt('wplogin_url', false); }else{ $wpstarter_login['url'] = 'https://mattdeveloper.github.com/wpstarter'; }

add_filter('login_headerurl', 'wpstarter_login_logo_url');
function wpstarter_login_logo_url(){
	global $wpstarter_login;
    return $wpstarter_login['url'];
}

/* ----- LOGO: TITLE ----- */
if( str_replace(' ', '', devOpt('wplogin_title', false)) != '' ){ $wpstarter_login['title'] = devOpt('wplogin_title', false); }else{ $wpstarter_login['title'] = __('WP Starter - Construindo temas de forma simples e eficaz!', 'wpstarter').'.'; }

add_filter('login_headertitle', 'wpstarter_login_logo_url_title');
function wpstarter_login_logo_url_title(){
	global $wpstarter_login;
    return $wpstarter_login['title'];
}



/* ===============================================================
	08. CONFIG: FOOTER
=============================================================== */
if( str_replace(' ', '', devOpt('developer_footer_text', false)) != '' ){
	$wpstarter_footer_txt = devOpt('developer_footer_text', false);
}else{
	$wpstarter_footer_txt = __('Criado com', 'wpstarter').' <a href="http://mattdeveloper.github.io/wpstarter/" target="_blank">WP Starter</a> v'.$wpstarterversion.'.';
}

add_filter('admin_footer_text', 'wpstarter_footer_admin');
function wpstarter_footer_admin(){
	global $wpstarter_footer_txt;
	return $wpstarter_footer_txt;
}



/* ===============================================================
	09. CONFIG: REMOVE MENUS
=============================================================== */
add_action('plugins_loaded', 'config_remove_menu');
function config_remove_menu(){
	$wpstarter_current_user = wp_get_current_user();
	$wpstarter_current_user = $wpstarter_current_user->user_level;

	/* ----- Verify the User Level ----- */
	if( is_array(devOpt('removemenus_user', false)) AND in_array($wpstarter_current_user, devOpt('removemenus_user', false)) ){

		/* -- Menus -- */
		if( is_array(devOpt('removemenus_url', false)) ){

			add_action( 'admin_menu', 'wpstarter_removemenus', 1000 );
			function wpstarter_removemenus(){
				foreach( devOpt('removemenus_url', false) as $value ){
					if( strstr($value, '*sub*') ){ // If is submenu
						$submenu = explode('*sub*', $value);
						remove_submenu_page( $submenu[0], $submenu[1] );
					}else{
						remove_menu_page( $value );
					}
				}
			}
		}

		/* -- Manual Remove Menu -- */
		if( is_array(devOpt('removemenus_manual_url', false)) ){

			add_action( 'admin_menu', 'wpstarter_manual_removemenus', 1000 );
			function wpstarter_manual_removemenus(){
				foreach( devOpt('removemenus_manual_url', false) as $value ){
					if( !strstr($value, 'wpstarter_developer') ){ // Blocking developers to remove the developer page
						if( !strstr($value, '*') ){ // If not disable with *
							remove_menu_page( $value );
						}
					}
				}
			}
		}

		/* ----- Manual Remove Submenus ----- */
		if( is_array(devOpt('removesubmenus_manual_url', false)) ){

			add_action( 'admin_menu', 'wpstarter_manual_removesubmenus', 1000 );
			function wpstarter_manual_removesubmenus(){
				foreach( devOpt('removesubmenus_manual_url', false) as $value ){
					$values = explode(' ', $value);
					if( !strstr($value, '*') ){ // If not disable *
						remove_submenu_page( $values[0], $values[1] );
					}
				}
			}
		}
	}
}



/* ===============================================================
	10. CONFIG: REORDER MENU
=============================================================== */
add_action('plugins_loaded', 'config_reorder_menu');
function config_reorder_menu(){
	if( is_array(devOpt('reordermenu_order', false)) AND is_array(devOpt('removemenus_user', false)) AND in_array($wpstarter_current_user, devOpt('removemenus_user', false)) ){ // Verify user level by Remove Menu Items

		/* -- Get Menus -- */
		$wpstarter_reorder_menu = array();
		foreach( devOpt('reordermenu_order', false) as $value ){
			if( $value != '' ){
				$wpstarter_reorder_menu[] = $value;
			}
		}

		add_filter('custom_menu_order', 'wpstarter_menu_order');
		add_filter('menu_order', 'wpstarter_menu_order');

		function wpstarter_menu_order($menu_ord){
			global $wpstarter_reorder_menu;

			if( is_array($wpstarter_reorder_menu) AND sizeof($wpstarter_reorder_menu) >= 1 ){
				if(!$menu_ord) return true;
				return $wpstarter_reorder_menu;
			}
		}
	}
}



/* ===============================================================
	11. CONFIG: ADMIN BAR
=============================================================== */

/* ----- ADD LEGGO IMAME/LINK ----- */
add_action('admin_bar_menu', 'wpstarter_adminbar_leggo_link', 1);
function wpstarter_adminbar_leggo_link(){
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'id'      => 'linkwpstarter',
		'title'   => '<img src="'.THEMEROOT.'/_framework/wpstarter/_assets/img/adminbar-wpstarter.png" alt="'.__('WP Starter', 'wpstarter').'">',
		'href'    => 'https://mattdeveloper.github.com/wpstarter',
		'meta'    => array(
				'target' => '_blank',
				'title'  => __('WP Starter - Construindo temas de forma simples e eficaz!', 'wpstarter')
			)
	));
}

/* ----- REMOVE ITEMS ----- */
if( is_array(devOpt('adminbar_remove_items', false)) AND sizeof(devOpt('adminbar_remove_items', false)) >= 1 ){

	add_action('wp_before_admin_bar_render', 'wpstarter_admin_bar_remove', 25);
	function wpstarter_admin_bar_remove(){
		global $wp_admin_bar;

		foreach( devOpt('adminbar_remove_items', false) as $key=>$value ){
			if( $value != '' ){

				/* -- Agency Leggo -- */
				if( $value == 'linkwpstarter' ){
					$wp_admin_bar->remove_menu('linkwpstarter');
				}

				/* -- WP Logo -- */
				if( $value == 'wp-logo' ){
					$wp_admin_bar->remove_menu('wp-logo');
					$wp_admin_bar->remove_menu('menu-toggle');
				}

				/* -- Site Name -- */
				if( $value == 'site-name' ){
					$wp_admin_bar->remove_menu('site-name');
				}

				/* -- Comments -- */
				if( $value == 'comments' ){
					$wp_admin_bar->remove_node('comments');
				}

				/* -- New Content -- */
				if( $value == 'new-content' ){
					$wp_admin_bar->remove_node('new-content');
				}
			}
		}
	}
}

/* ----- ADD ITEMS ----- */
if( is_array(devOpt('adminbar_add_links', false)) AND sizeof(devOpt('adminbar_add_links', false)) >= 1 ){

	/* ----- BEFORE ----- */
	add_action('admin_bar_menu', 'wpstarter_adminbar_add_before', 1);
	function wpstarter_adminbar_add_before(){
		global $wp_admin_bar;

		foreach( devOpt('adminbar_add_links', false) as $thefield ){
			if( $thefield['location'] == 'before' OR $thefield['location'] == '' ){

				if( str_replace(' ', '', $thefield['id']) != '' AND str_replace(' ', '', $thefield['content']) != '' AND str_replace(' ', '', $thefield['href']) != '' ){
					$wp_admin_bar->add_menu( array(
						'id'      => $thefield['id'],
						'title'   => str_replace('[siteurl]', get_bloginfo('url'), str_replace('[themeroot]', THEMEROOT, $thefield['content'])),
						'href'    => str_replace('[siteurl]', get_bloginfo('url'), str_replace('[themeroot]', THEMEROOT, $thefield['href'])),
						'meta'    => array(
								'class'  => $thefield['class'],
								'target' => $thefield['target'],
								'title'  => $thefield['title']
							)
					));
				}
			}
		}
	}

	/* ----- AFTER ----- */
	add_action('wp_before_admin_bar_render', 'wpstarter_adminbar_add_after', 1);
	function wpstarter_adminbar_add_after(){
		global $wp_admin_bar;

		echo $thefield['title'];

		foreach( devOpt('adminbar_add_links', false) as $thefield ){
			if( $thefield['location'] == 'after' ){

				if( str_replace(' ', '', $thefield['id']) != '' AND str_replace(' ', '', $thefield['content']) != '' AND str_replace(' ', '', $thefield['href']) != '' ){
					$wp_admin_bar->add_menu( array(
						'id'      => $thefield['id'],
						'title'   => str_replace('[siteurl]', get_bloginfo('url'), str_replace('[themeroot]', THEMEROOT, $thefield['content'])),
						'href'    => str_replace('[siteurl]', get_bloginfo('url'), str_replace('[themeroot]', THEMEROOT, $thefield['href'])),
						'meta'    => array(
								'class'  => $thefield['class'],
								'target' => $thefield['target'],
								'title'  => $thefield['title']
							)
					));
				}
			}
		}
	}
}



/* ===============================================================
	12. CONFIG: ADVANCED
=============================================================== */

/* ----- WP HEAD ----- */
if( is_array(devOpt('developer_advanced_wphead', false)) AND sizeof(devOpt('developer_advanced_wphead', false)) >= 1 ){
	add_filter('init', 'wpstarter_filter_wphead');
	function wpstarter_filter_wphead(){

		/* -- feed_links // alternate -- */
		if( in_array(0, devOpt('developer_advanced_wphead', false)) ){
			remove_action('wp_head', 'feed_links_extra', 3); // Remove category feeds
			remove_action('wp_head', 'feed_links', 2); // Remove Post and Comment Feeds
		}

		/* -- rsd_link // EditURI -- */
		if( in_array(1, devOpt('developer_advanced_wphead', false)) ){
			remove_action('wp_head', 'rsd_link');
		}

		/* -- wlwmanifest_link // wlwmanifest -- */
		if( in_array(2, devOpt('developer_advanced_wphead', false)) ){
			remove_action('wp_head', 'wlwmanifest_link');
		}

		/* -- wp_generator // generator -- */
		if( in_array(3, devOpt('developer_advanced_wphead', false)) ){
			remove_action('wp_head', 'wp_generator');
		}

		/* -- rel_canonical // canonical -- */
		if( in_array(4, devOpt('developer_advanced_wphead', false)) ){
			remove_action('wp_head', 'rel_canonical');
		}

		/* -- wp_shortlink_wp_head // shortlink -- */
		if( in_array(5, devOpt('developer_advanced_wphead', false)) ){
			remove_action('wp_head', 'wp_shortlink_wp_head');
		}
	}
}

/* ----- GOOGLE ANALYTICS ----- */
if( str_replace(' ', '', devOpt('developer_advanced_google_analytics', false)) != '' ){

	add_action('wp_footer', 'wpstarter_google_analytics');
	function wpstarter_google_analytics(){

		if( !strstr(devOpt('developer_advanced_google_analytics', false), '<script>') ){
			echo "\n<script>\n".devOpt('developer_advanced_google_analytics', false)."\n</script>\n\n";
		}else{
			devOpt('developer_advanced_google_analytics'); echo "\n";
		}

	}
}

?>
