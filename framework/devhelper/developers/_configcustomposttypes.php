<?php

/* ===============================================================
	SQL ALL CUSTOM POST TYPES BY USERS
=============================================================== */
$sql_custom_post_types = new WP_Query(array( 'post_type'=>'customposttypes', 'order'=>'ASC', 'post_status'=>'publish', 'posts_per_page'=>-1 ));
if( $sql_custom_post_types->have_posts() ) : while( $sql_custom_post_types->have_posts() ) : $sql_custom_post_types->the_post();


	/* ----- GENERAL / GERAL ----- */
	$helper_posttype[$post->ID]['post_slug']          = str_replace(' ', '', get_post_meta($post->ID, 'post_slug', true)); // OK
	$helper_posttype[$post->ID]['post_name_singular'] = get_post_meta($post->ID, 'post_name_singular', true); // OK
	$helper_posttype[$post->ID]['post_name_plural']   = get_post_meta($post->ID, 'post_name_plural', true); // OK


	/* ----- LABELS / RÓTULOS ----- */
	$helper_posttype[$post->ID]['post_menu']               = get_post_meta($post->ID, 'post_menu', true); // OK
	$helper_posttype[$post->ID]['post_add_new']            = get_post_meta($post->ID, 'post_add_new', true); // OK
	$helper_posttype[$post->ID]['post_add_new_item']       = get_post_meta($post->ID, 'post_add_new_item', true); // OK
	$helper_posttype[$post->ID]['post_edit_item']          = get_post_meta($post->ID, 'post_edit_item', true); // OK
	$helper_posttype[$post->ID]['post_update_item']        = get_post_meta($post->ID, 'post_update_item', true); // OK
	$helper_posttype[$post->ID]['post_view_item']          = get_post_meta($post->ID, 'post_view_item', true); // OK
	$helper_posttype[$post->ID]['post_search']             = get_post_meta($post->ID, 'post_search', true); // OK
	$helper_posttype[$post->ID]['post_all_items']          = get_post_meta($post->ID, 'post_all_items', true); // OK
	$helper_posttype[$post->ID]['post_not_found']          = get_post_meta($post->ID, 'post_not_found', true); // OK
	$helper_posttype[$post->ID]['post_not_found_in_trash'] = get_post_meta($post->ID, 'post_not_found_in_trash', true); // OK


	/* ----- OPTIONS / OPÇÕES ----- */
	$helper_posttype[$post->ID]['post_exclude_search'] = get_post_meta($post->ID, 'post_exclude_search', true); // OK
	if( $helper_posttype[$post->ID]['post_exclude_search'] == 'yes' ){ $helper_posttype[$post->ID]['post_exclude_search'] = true; }else{ $helper_posttype[$post->ID]['post_exclude_search'] = false; }
	
	$helper_posttype[$post->ID]['post_export']         = get_post_meta($post->ID, 'post_export', true); // OK
	if( $helper_posttype[$post->ID]['post_export'] == 'yes' ){ $helper_posttype[$post->ID]['post_export'] = true; }else{ $helper_posttype[$post->ID]['post_export'] = false; }

	$helper_posttype_supports[$post->ID][] = 'title';
	if( is_array(get_post_meta($post->ID, 'post_supports', true)) ){ // OK
		foreach( get_post_meta($post->ID, 'post_supports', true) as $devhelper_supports_field => $devhelper_supports_key ){
			$helper_posttype_supports[$post->ID][] = $devhelper_supports_key;
		} unset($devhelper_supports_field); unset($devhelper_supports_key);
	}


	/* ----- VISIBILITY / VISIBILIDADE ----- */
	$helper_posttype[$post->ID]['post_admin_bar_display'] = get_post_meta($post->ID, 'post_admin_bar_display', true); // OK
	if( $helper_posttype[$post->ID]['post_admin_bar_display'] == 'yes' ){ $helper_posttype[$post->ID]['post_admin_bar_display'] = true; }else{ $helper_posttype[$post->ID]['post_admin_bar_display'] = false; }
	
	$helper_posttype[$post->ID]['post_sidebar_display']   = get_post_meta($post->ID, 'post_sidebar_display', true); // OK
	if( $helper_posttype[$post->ID]['post_sidebar_display'] == 'yes' ){ $helper_posttype[$post->ID]['post_sidebar_display'] = true; }else{ $helper_posttype[$post->ID]['post_sidebar_display'] = false; }
	
	$helper_posttype[$post->ID]['post_sidebar_position']  = get_post_meta($post->ID, 'post_sidebar_position', true); // OK


	/* ----- CAPABILITIES / CAPACIDADE ----- */
	$helper_posttype[$post->ID]['post_capability'] = get_post_meta($post->ID, 'post_capability', true); // OK


endwhile; endif; // Sql All Custom Post Types



/* ===============================================================
	CREATING CUSTOM POST TYPES
=============================================================== */
if( $sql_custom_post_types->post_count >= 1 ){

	/* -- Function To Create Custom Posts -- */
	function create_post($post_id, $post_args, $cnt_post_types){
		global $helper_posttype_supports, $helper_posttype_taxonomies;

		$labels = array(
			'name'                => $post_args[$post_id]['post_name_plural'], 'Post Type General Name',
			'singular_name'       => $post_args[$post_id]['post_name_singular'], 'Post Type Singular Name',
			'menu_name'           => $post_args[$post_id]['post_menu'],
			'all_items'           => $post_args[$post_id]['post_all_items'],
			'view_item'           => $post_args[$post_id]['post_view_item'],
			'add_new_item'        => $post_args[$post_id]['post_add_new_item'],
			'add_new'             => $post_args[$post_id]['post_add_new'],
			'edit_item'           => $post_args[$post_id]['post_edit_item'],
			'update_item'         => $post_args[$post_id]['post_update_item'],
			'search_items'        => $post_args[$post_id]['post_search'],
			'not_found'           => $post_args[$post_id]['post_not_found'],
			'not_found_in_trash'  => $post_args[$post_id]['post_not_found_in_trash'],
		);
		$args = array(
			'label'               => $post_args[$post_id]['post_slug'],
			'labels'              => $labels,
			'supports'            => $helper_posttype_supports[$post_id],
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => $post_args[$post_id]['post_sidebar_display'],
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => $post_args[$post_id]['post_admin_bar_display'],
			'menu_position'       => (int)($post_args[$post_id]['post_sidebar_position']),
			'can_export'          => $post_args[$post_id]['post_export'],
			'has_archive'         => true,
			'exclude_from_search' => $post_args[$post_id]['post_exclude_search'],
			'publicly_queryable'  => true,
			'capability_type'     => $post_args[$post_id]['post_capability'],
		); register_post_type( $post_args[$post_id]['post_slug'], $args );
		// echo $post_args[$post_id]['post_slug'].' - '.($post_args[$post_id]['post_sidebar_position']+$cnt_post_types).'<br>';
	} // Functon create_post


	/* -- Loop On Custom Posts -- */
	$devhelper_current_custom_post_type_cnt = 0;
	foreach( $helper_posttype as $helperposts_key => $helperposts_value ){
		add_action('init', create_post($helperposts_key, $helper_posttype, $devhelper_current_custom_post_type_cnt) );
		// $devhelper_current_custom_post_type_cnt++;
	}


} // If Have Custom Post Types



/* ===============================================================
	UNSET & RESET
=============================================================== */
// wp_reset_query();
unset( $sql_custom_post_types ); // SQL Post Types
unset( $helper_posttype ); // All Post Types
unset( $devhelper_taxonomies_field ); // All Taxonomies
unset( $devhelper_supports_field ); // All Supports
unset( $devhelper_current_custom_post_type_cnt ); // Count current post type list
?>