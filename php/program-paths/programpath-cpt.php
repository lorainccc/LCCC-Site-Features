<?php

// Register Custom Post Type
function lc_program_pathways() {

	$labels = array(
		'name'                  => _x( 'Pathways', 'Post Type General Name', 'lorainccc' ),
		'singular_name'         => _x( 'Pathway', 'Post Type Singular Name', 'lorainccc' ),
		'menu_name'             => __( 'Program Pathway', 'lorainccc' ),
		'name_admin_bar'        => __( 'Program Pathway', 'lorainccc' ),
		'archives'              => __( 'Program Pathway Archives', 'lorainccc' ),
		'parent_item_colon'     => __( 'Parent Program Pathway', 'lorainccc' ),
		'all_items'             => __( 'All Program Pathways', 'lorainccc' ),
		'add_new_item'          => __( 'Add New Program Pathway', 'lorainccc' ),
		'add_new'               => __( 'Add New Program Pathway', 'lorainccc' ),
		'new_item'              => __( 'New Program Pathway', 'lorainccc' ),
		'edit_item'             => __( 'Edit Program Pathway', 'lorainccc' ),
		'update_item'           => __( 'Update Program Pathway', 'lorainccc' ),
		'view_item'             => __( 'View Program Pathway', 'lorainccc' ),
		'search_items'          => __( 'Search Program Pathway', 'lorainccc' ),
		'not_found'             => __( 'Not found', 'lorainccc' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lorainccc' ),
		'featured_image'        => __( 'Featured Image', 'lorainccc' ),
		'set_featured_image'    => __( 'Set featured image', 'lorainccc' ),
		'remove_featured_image' => __( 'Remove featured image', 'lorainccc' ),
		'use_featured_image'    => __( 'Use as featured image', 'lorainccc' ),
		'insert_into_item'      => __( 'Insert into Program Pathway', 'lorainccc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Program Pathway', 'lorainccc' ),
		'items_list'            => __( 'Program Pathway list', 'lorainccc' ),
		'items_list_navigation' => __( 'Program Pathway list navigation', 'lorainccc' ),
		'filter_items_list'     => __( 'Filter Program Pathway list', 'lorainccc' ),
	);
	$args = array(
		'label'                 => __( 'Pathway', 'lorainccc' ),
		'description'           => __( 'Pathway Description', 'lorainccc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
  'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'lc_program_paths', $args );

}
add_action( 'init', 'lc_program_pathways', 0 );

?>