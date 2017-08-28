<?php

// Register Custom Post Type
function lc_success_stories() {

	$labels = array(
		'name'                  => _x( 'Success Stories', 'Post Type General Name', 'lorainccc' ),
		'singular_name'         => _x( 'Success Story', 'Post Type Singular Name', 'lorainccc' ),
		'menu_name'             => __( 'Success Stories', 'lorainccc' ),
		'name_admin_bar'        => __( 'Success Story', 'lorainccc' ),
		'archives'              => __( 'Success Story Archives', 'lorainccc' ),
		'attributes'            => __( 'Success Story Attributes', 'lorainccc' ),
		'parent_item_colon'     => __( 'Parent Success Story:', 'lorainccc' ),
		'all_items'             => __( 'All Success Story', 'lorainccc' ),
		'add_new_item'          => __( 'Add New Success Story', 'lorainccc' ),
		'add_new'               => __( 'Add New Success Story', 'lorainccc' ),
		'new_item'              => __( 'New Success Story', 'lorainccc' ),
		'edit_item'             => __( 'Edit Success Story', 'lorainccc' ),
		'update_item'           => __( 'Update Success Story', 'lorainccc' ),
		'view_item'             => __( 'View Success Story', 'lorainccc' ),
		'view_items'            => __( 'View Success Stories', 'lorainccc' ),
		'search_items'          => __( 'Search Success Story', 'lorainccc' ),
		'not_found'             => __( 'Not found', 'lorainccc' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lorainccc' ),
		'featured_image'        => __( 'Featured Image', 'lorainccc' ),
		'set_featured_image'    => __( 'Set featured image', 'lorainccc' ),
		'remove_featured_image' => __( 'Remove featured image', 'lorainccc' ),
		'use_featured_image'    => __( 'Use as featured image', 'lorainccc' ),
		'insert_into_item'      => __( 'Insert into Success Story', 'lorainccc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Success Story', 'lorainccc' ),
		'items_list'            => __( 'Success Stories list', 'lorainccc' ),
		'items_list_navigation' => __( 'Success Stories list navigation', 'lorainccc' ),
		'filter_items_list'     => __( 'Filter Success Stories', 'lorainccc' ),
	);
	$args = array(
		'label'                 => __( 'Success Story', 'lorainccc' ),
		'description'           => __( 'LCCC Success Stories', 'lorainccc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'post-formats', 'excerpt'),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
  'menu_icon'             => 'dashicons-id-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'lc_success_story', $args );

}
add_action( 'init', 'lc_success_stories', 0 );

?>