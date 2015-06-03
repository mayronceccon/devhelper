<?php
$devhelper_js = array();
$devhelper_use_js = array();
$devhelper_condition_js = array();



/* ===============================================================
	REGISTER JS
=============================================================== */
function new_js($name='', $path='', $footer=false){
	global $devhelper_js;

	if( $name != '' AND $path != '' ){
		$devhelper_js[$name] = $path;

		if( $footer == true ){
			$devhelper_js[$name.'_footer'] = true;
		}else{
			$devhelper_js[$name.'_footer'] = false;
		}
	}
}



/* ===============================================================
	USE JS
=============================================================== */
function use_js($name='', $condition='', $validate=''){
	global $devhelper_js, $devhelper_use_js, $devhelper_condition_js;

	if( $name != '' ){
		if( $condition != '' ){ // If have a condition to insert the JS
			$generate_id = uniqid(); // Get a New ID
			$devhelper_condition_js[$generate_id]['name']      = $name.$generate_id;
			$devhelper_condition_js[$generate_id]['original']  = $name;
			$devhelper_condition_js[$generate_id]['condition'] = $condition;
			$devhelper_condition_js[$generate_id]['validate']  = $validate;
		}else{ // Don't have any conditions
			$generate_id = uniqid(); // Get a New ID
			$devhelper_use_js[$generate_id]['name']     = $name.$generate_id;
			$devhelper_use_js[$generate_id]['path']     = $devhelper_js[$name];
			$devhelper_use_js[$generate_id]['original'] = $name;
		}
	}
}



/* ===============================================================
	INSERT IN HEAD
=============================================================== */
add_action( 'wp_enqueue_scripts', 'devhelper_js_scripts' );
function devhelper_js_scripts(){
	global $devhelper_js, $devhelper_use_js;

	/* Register Styles */
	foreach( $devhelper_use_js as $js ){
		$name     = $js['name'];
		$path     = $js['path'];
		$original = $js['original'];

		if( !strstr($path, 'http://') AND !strstr($path, 'https://') ){ $path = THEMEROOT.'/'.$path; } // Verifying if have http:// or https:// if not, add the template directory url to the path

		if( $devhelper_js[$original.'_footer'] == false ){
			wp_register_script( $name, $path );
		}else{ // Insert before close the tag body
			wp_register_script( $name, $path, array(), null, true );
		}
	}

	/* Enqueue Styles */
	foreach( $devhelper_use_js as $js ){
		$name = $js['name'];
		wp_enqueue_script( $name );
	}
}



/* ===============================================================
	INSERT IN HEAD WITH CONDITION
=============================================================== */
add_action('wp', 'use_js_condition');
function use_js_condition(){
	global $devhelper_condition_js;

	foreach($devhelper_condition_js as $js){
		$js_name      = $js['name'];
		$js_original  = $js['original'];
		$js_condition = $js['condition'];
		$js_validate  = $js['validate'];

		/* -- IS HOME -- */
		if( $js_condition == 'is_home' ){
			if( is_home() ){
				use_js($js_original);
			}

		/* -- IS FRONT PAGE -- */
		}else if( $js_condition == 'is_front_page' ){
			if( is_front_page() ){
				use_js($js_original);
			}

		/* -- IS SINGLE -- */
		}else if( $js_condition == 'is_single' ){
			if( $js_validate != '' ){
				if( is_single($js_validate) ){
					use_js($js_original);
				}
			}else{
				if( is_single() ){
					use_js($js_original);
				}
			}

		/* -- IS SINGULAR -- */
		}else if( $js_condition == 'is_singular' ){
			if( is_singular($js_validate) ){
				use_js($js_original);
			}

		/* -- IS CATEGORY -- */
		}else if( $js_condition == 'is_category' ){
			if( is_category($js_validate) ){
				use_js($js_original);
			}

		/* -- IS ARCHIVE -- */
		}else if( $js_condition == 'is_archive' ){
			if( is_archive() ){
				use_js($js_original);
			}

		/* -- IS PAGE -- */
		}else if( $js_condition == 'is_page' ){
			if( is_page($js_validate) ){
				use_js($js_original);
			}

		/* -- IS PAGE TEMPLATE -- */
		}else if( $js_condition == 'is_page_template' ){
			if( is_page_template($js_validate) ){
				use_js($js_original);
			}

		/* -- IS SEARCH -- */
		}elseif( $js_condition == 'is_search' ){
			if( is_search() ){
				use_js($js_original);
			}

		/* -- IS ADMIN -- */
		}else if( $js_condition == 'is_admin' ){
			if( is_admin() ){
				use_js($js_original);
			}
		}
	}
}


?>