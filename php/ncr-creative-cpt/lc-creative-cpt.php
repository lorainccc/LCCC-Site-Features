<?php

// Register Custom Post Type
function lc_creative() {

	$labels = array(
		'name'                  => _x( 'Creative Post Types', 'Post Type General Name', 'lorainccc' ),
		'singular_name'         => _x( 'Creative Post Type', 'Post Type Singular Name', 'lorainccc' ),
		'menu_name'             => __( 'Creative Post Types', 'lorainccc' ),
		'name_admin_bar'        => __( 'Creative Post Type', 'lorainccc' ),
		'archives'              => __( 'Creative Item Archives', 'lorainccc' ),
		'attributes'            => __( 'Creative Item Attributes', 'lorainccc' ),
		'parent_item_colon'     => __( 'Creative Parent Item:', 'lorainccc' ),
		'all_items'             => __( 'All Creative Items', 'lorainccc' ),
		'add_new_item'          => __( 'Add New Creative Item', 'lorainccc' ),
		'add_new'               => __( 'Add New', 'lorainccc' ),
		'new_item'              => __( 'New Creative Item', 'lorainccc' ),
		'edit_item'             => __( 'Edit Creative Item', 'lorainccc' ),
		'update_item'           => __( 'Update Creative Item', 'lorainccc' ),
		'view_item'             => __( 'View Creative Item', 'lorainccc' ),
		'view_items'            => __( 'View Creative Items', 'lorainccc' ),
		'search_items'          => __( 'Search Creative Item', 'lorainccc' ),
		'not_found'             => __( 'Not found', 'lorainccc' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lorainccc' ),
		'featured_image'        => __( 'Featured Image', 'lorainccc' ),
		'set_featured_image'    => __( 'Set featured image', 'lorainccc' ),
		'remove_featured_image' => __( 'Remove featured image', 'lorainccc' ),
		'use_featured_image'    => __( 'Use as featured image', 'lorainccc' ),
		'insert_into_item'      => __( 'Insert into Creative item', 'lorainccc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Creative item', 'lorainccc' ),
		'items_list'            => __( 'Creative Items list', 'lorainccc' ),
		'items_list_navigation' => __( 'Creative Items list navigation', 'lorainccc' ),
		'filter_items_list'     => __( 'Creative Filter items list', 'lorainccc' ),
	);
	$args = array(
		'label'                 => __( 'Creative Post Type', 'lorainccc' ),
		'description'           => __( 'NCR Creative Work Post Type', 'lorainccc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'post-formats' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-lightbulb',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'creative', $args );

}
add_action( 'init', 'lc_creative', 0 );