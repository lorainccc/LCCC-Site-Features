<?php

 /*
  * Program Path Chart Custom Post Type
  * 
  * 
  */


// Register Custom Post Type
function lc_program_path_chart() {

	$labels = array(
		'name'                  => _x( 'Program Pathway Chart Paths', 'Post Type General Name', 'lorainccc' ),
		'singular_name'         => _x( 'Program Pathway Chart Path', 'Post Type Singular Name', 'lorainccc' ),
		'menu_name'             => __( 'Program Pathway Chart Paths', 'lorainccc' ),
		'name_admin_bar'        => __( 'Program Pathway Chart Path', 'lorainccc' ),
		'archives'              => __( 'Program Pathway Chart Archives', 'lorainccc' ),
		'attributes'            => __( 'Program Pathway Chart Attributes', 'lorainccc' ),
		'parent_item_colon'     => __( 'Parent Program Pathway Chart:', 'lorainccc' ),
		'all_items'             => __( 'All Program Pathway Charts', 'lorainccc' ),
		'add_new_item'          => __( 'Add New Program Pathway Chart', 'lorainccc' ),
		'add_new'               => __( 'Add New Program Pathway Chart', 'lorainccc' ),
		'new_item'              => __( 'New Program Pathway Chart', 'lorainccc' ),
		'edit_item'             => __( 'Edit Program Pathway Chart', 'lorainccc' ),
		'update_item'           => __( 'Update Program Pathway Chart', 'lorainccc' ),
		'view_item'             => __( 'View Program Pathway Chart', 'lorainccc' ),
		'view_items'            => __( 'View Program Pathway Charts', 'lorainccc' ),
		'search_items'          => __( 'Search Program Pathway Chart', 'lorainccc' ),
		'not_found'             => __( 'Not found', 'lorainccc' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lorainccc' ),
		'featured_image'        => __( 'Featured Image', 'lorainccc' ),
		'set_featured_image'    => __( 'Set featured image', 'lorainccc' ),
		'remove_featured_image' => __( 'Remove featured image', 'lorainccc' ),
		'use_featured_image'    => __( 'Use as featured image', 'lorainccc' ),
		'insert_into_item'      => __( 'Insert into Program Pathway Chart', 'lorainccc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Program Pathway Chart', 'lorainccc' ),
		'items_list'            => __( 'Program Pathway Charts list', 'lorainccc' ),
		'items_list_navigation' => __( 'Program Pathway Charts list navigation', 'lorainccc' ),
		'filter_items_list'     => __( 'Filter Program Pathway Chart list', 'lorainccc' ),
	);
	$args = array(
		'label'                 => __( 'Program Pathway Chart', 'lorainccc' ),
		'description'           => __( 'Post Type Description', 'lorainccc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'revisions', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-chart-bar',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'lc_program_chart', $args );

}
add_action( 'init', 'lc_program_path_chart', 0 );


// Program Path Chart Custom Taxonomy
// Register Custom Taxonomy
function program_chart_categories() {

	$labels = array(
		'name'                       => _x( 'Program Chart Categories', 'Taxonomy General Name', 'lorainccc' ),
		'singular_name'              => _x( 'Program Chart Category', 'Taxonomy Singular Name', 'lorainccc' ),
		'menu_name'                  => __( 'Program Chart Categories', 'lorainccc' ),
		'all_items'                  => __( 'All Program Chart Items', 'lorainccc' ),
		'parent_item'                => __( 'Program Chart Parent Item', 'lorainccc' ),
		'parent_item_colon'          => __( 'Program Chart Parent Item:', 'lorainccc' ),
		'new_item_name'              => __( 'New Program Chart', 'lorainccc' ),
		'add_new_item'               => __( 'Add New Program Chart', 'lorainccc' ),
		'edit_item'                  => __( 'Edit Program Chart', 'lorainccc' ),
		'update_item'                => __( 'Update Program Chart', 'lorainccc' ),
		'view_item'                  => __( 'View Program Chart', 'lorainccc' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'lorainccc' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'lorainccc' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'lorainccc' ),
		'popular_items'              => __( 'Popular Items', 'lorainccc' ),
		'search_items'               => __( 'Search Items', 'lorainccc' ),
		'not_found'                  => __( 'Not Found', 'lorainccc' ),
		'no_terms'                   => __( 'No items', 'lorainccc' ),
		'items_list'                 => __( 'Items list', 'lorainccc' ),
		'items_list_navigation'      => __( 'Items list navigation', 'lorainccc' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'program_chart', array( 'lc_program_chart' ), $args );

}
add_action( 'init', 'program_chart_categories', 0 );


?>