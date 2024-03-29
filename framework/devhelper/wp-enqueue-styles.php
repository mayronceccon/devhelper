<?php
$devhelper_css = array();
$devhelper_use_css = array();
$devhelper_condition_css = array();



/* ===============================================================
	REGISTER CSS
=============================================================== */
function new_css($name='', $path='', $footer=false){
	global $devhelper_css;

	if( $name != '' AND $path != '' ){
		$devhelper_css[$name] = $path;

		if( $footer == true ){
			$devhelper_css[$name.'_footer'] = true;
		}else{
			$devhelper_css[$name.'_footer'] = false;
		}
	}
}



/* ===============================================================
	USE CSS
=============================================================== */
function use_css($name='', $condition='', $validate=''){
	global $devhelper_css, $devhelper_use_css, $devhelper_condition_css;

	if( $name != '' ){
		if( $condition != '' ){ // If have a condition to insert the CSS
			$generate_id = uniqid(); // Get a New ID
			$devhelper_condition_css[$generate_id]['name']      = $name.$generate_id;
			$devhelper_condition_css[$generate_id]['original']  = $name;
			$devhelper_condition_css[$generate_id]['condition'] = $condition;
			$devhelper_condition_css[$generate_id]['validate']  = $validate;
		}else{ // Don't have any conditions
			$generate_id = uniqid(); // Get a New ID
			$devhelper_use_css[$generate_id]['name'] = $name.$generate_id;
			$devhelper_use_css[$generate_id]['path'] = $devhelper_css[$name];
		}
	}
}



/* ===============================================================
	INSERT ON HEAD
=============================================================== */
add_action( 'wp_enqueue_scripts', 'devhelper_css_styles' );
function devhelper_css_styles(){
	global $devhelper_css, $devhelper_use_css;

	/* Register Styles */
	foreach( $devhelper_use_css as $css ){
		$name = $css['name'];
		$path = $css['path'];

		if( !strstr($path, 'http://') AND !strstr($path, 'https://') ){ $path = THEMEROOT.'/'.$path; } // Verifying if have http:// or https:// if not, add the template directory url to the path
		wp_register_style( $name, $path );
	}

	/* Enqueue Styles */
	foreach( $devhelper_use_css as $name ){
		wp_enqueue_style( $name );
	}
}



/* ===============================================================
	INSERT IN HEAD WITH CONDITION
=============================================================== */
add_action('wp', 'use_css_condition');
function use_css_condition(){
	global $devhelper_condition_css;

	foreach($devhelper_condition_css as $css){
		$css_name      = $css['name'];
		$css_original  = $css['original'];
		$css_condition = $css['condition'];
		$css_validate  = $css['validate'];

		/* -- IS HOME -- */
		if( $css_condition == 'is_home' ){
			if( is_home() ){
				use_css($css_original);
			}

		/* -- IS FRONT PAGE -- */
		}else if( $css_condition == 'is_front_page' ){
			if( is_front_page() ){
				use_css($css_original);
			}

		/* -- IS SINGLE -- */
		}else if( $css_condition == 'is_single' ){
			if( $css_validate != '' ){
				if( is_single($css_validate) ){
					use_css($css_original);
				}
			}else{
				if( is_single() ){
					use_css($css_original);
				}
			}

		/* -- IS SINGULAR -- */
		}else if( $css_condition == 'is_singular' ){
			if( is_singular($css_validate) ){
				use_css($css_original);
			}

		/* -- IS CATEGORY -- */
		}else if( $css_condition == 'is_category' ){
			if( is_category($css_validate) ){
				use_css($css_original);
			}

		/* -- IS ARCHIVE -- */
		}else if( $css_condition == 'is_archive' ){
			if( is_archive() ){
				use_css($css_original);
			}

		/* -- IS PAGE -- */
		}else if( $css_condition == 'is_page' ){
			if( is_page($css_validate) ){
				use_css($css_original);
			}

		/* -- IS PAGE TEMPLATE -- */
		}else if( $css_condition == 'is_page_template' ){
			if( is_page_template($css_validate) ){
				use_css($css_original);
			}

		/* -- IS SEARCH -- */
		}elseif( $css_condition == 'is_search' ){
			if( is_search() ){
				use_css($css_original);
			}

		/* -- IS ADMIN -- */
		}else if( $css_condition == 'is_admin' ){
			if( is_admin() ){
				use_css($css_original);
			}
		}
	}
}

?>