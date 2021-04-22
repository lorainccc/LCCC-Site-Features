<?php

/*
 *  
 * 
 */

 // Register Custom Post Type
function lc_content_tiles() {

	$labels = array(
		'name'                  => _x( 'Content Tiles', 'Post Type General Name', 'lorainccc' ),
		'singular_name'         => _x( 'Content Tile', 'Post Type Singular Name', 'lorainccc' ),
		'menu_name'             => __( 'Content Tiles', 'lorainccc' ),
		'name_admin_bar'        => __( 'Post Type', 'lorainccc' ),
		'archives'              => __( 'Content Tile Archives', 'lorainccc' ),
		'attributes'            => __( 'Content Tile Attributes', 'lorainccc' ),
		'parent_item_colon'     => __( 'Parent Content Tile:', 'lorainccc' ),
		'all_items'             => __( 'All Content Tiles', 'lorainccc' ),
		'add_new_item'          => __( 'Add New Content Tile', 'lorainccc' ),
		'add_new'               => __( 'Add New Content Tile', 'lorainccc' ),
		'new_item'              => __( 'New Content Tile', 'lorainccc' ),
		'edit_item'             => __( 'Edit Content Tile', 'lorainccc' ),
		'update_item'           => __( 'Update Content Tile', 'lorainccc' ),
		'view_item'             => __( 'View Content Tile', 'lorainccc' ),
		'view_items'            => __( 'View Content Tiles', 'lorainccc' ),
		'search_items'          => __( 'Search Content Tile', 'lorainccc' ),
		'not_found'             => __( 'Not found', 'lorainccc' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lorainccc' ),
		'featured_image'        => __( 'Featured Image', 'lorainccc' ),
		'set_featured_image'    => __( 'Set featured image', 'lorainccc' ),
		'remove_featured_image' => __( 'Remove featured image', 'lorainccc' ),
		'use_featured_image'    => __( 'Use as featured image', 'lorainccc' ),
		'insert_into_item'      => __( 'Insert into Content Tile', 'lorainccc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Content Tile', 'lorainccc' ),
		'items_list'            => __( 'Content Tile list', 'lorainccc' ),
		'items_list_navigation' => __( 'Content Tile list navigation', 'lorainccc' ),
		'filter_items_list'     => __( 'Filter Content Tile list', 'lorainccc' ),
	);
	$args = array(
		'label'                 => __( 'Content Tile', 'lorainccc' ),
		'description'           => __( 'Post Type Description', 'lorainccc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'post-formats' ),
		'taxonomies'            => array( 'lc_content_tile_categories' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'				=> 'dashicons-grid-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'lc_content_tile', $args );

}
add_action( 'init', 'lc_content_tiles', 0 );



// Register Custom Taxonomy
function lc_content_tiles_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Tile Groups', 'Taxonomy General Name', 'lorainccc' ),
		'singular_name'              => _x( 'Tile Group', 'Taxonomy Singular Name', 'lorainccc' ),
		'menu_name'                  => __( 'Tile Groups', 'lorainccc' ),
		'all_items'                  => __( 'All Tile Groups', 'lorainccc' ),
		'parent_item'                => __( 'Parent Tile Group', 'lorainccc' ),
		'parent_item_colon'          => __( 'Parent Tile Group:', 'lorainccc' ),
		'new_item_name'              => __( 'New Tile Group Name', 'lorainccc' ),
		'add_new_item'               => __( 'Add New Tile Group', 'lorainccc' ),
		'edit_item'                  => __( 'Edit Tile Group', 'lorainccc' ),
		'update_item'                => __( 'Update Tile Group', 'lorainccc' ),
		'view_item'                  => __( 'View Tile Group', 'lorainccc' ),
		'separate_items_with_commas' => __( 'Separate tile groups with commas', 'lorainccc' ),
		'add_or_remove_items'        => __( 'Add or remove tile groups', 'lorainccc' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'lorainccc' ),
		'popular_items'              => __( 'Popular Tile Groups', 'lorainccc' ),
		'search_items'               => __( 'Search Tile Groups', 'lorainccc' ),
		'not_found'                  => __( 'Not Found', 'lorainccc' ),
		'no_terms'                   => __( 'No tile groups', 'lorainccc' ),
		'items_list'                 => __( 'Tile Groups list', 'lorainccc' ),
		'items_list_navigation'      => __( 'Tile Groups list navigation', 'lorainccc' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'lc_content_tile_categories', array( 'lc_content_tile' ), $args );

}
add_action( 'init', 'lc_content_tiles_taxonomy', 0 );