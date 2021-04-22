<?php

// Register Custom Post Type
function content_group_cpt() {

	$labels = array(
		'name'                  => _x( 'Content Group Items', 'Post Type General Name', 'lorainccc' ),
		'singular_name'         => _x( 'Content Group Item', 'Post Type Singular Name', 'lorainccc' ),
		'menu_name'             => __( 'Content Group', 'lorainccc' ),
		'name_admin_bar'        => __( 'Content Group Item', 'lorainccc' ),
		'archives'              => __( 'Content Group Item Archives', 'lorainccc' ),
		'parent_item_colon'     => __( 'Parent Item:', 'lorainccc' ),
		'all_items'             => __( 'All Items', 'lorainccc' ),
		'add_new_item'          => __( 'Add New Content Group Item', 'lorainccc' ),
		'add_new'               => __( 'Add New Content Group Item', 'lorainccc' ),
		'new_item'              => __( 'New Item', 'lorainccc' ),
		'edit_item'             => __( 'Edit Item', 'lorainccc' ),
		'update_item'           => __( 'Update Item', 'lorainccc' ),
		'view_item'             => __( 'View Item', 'lorainccc' ),
		'search_items'          => __( 'Search Content Group Item', 'lorainccc' ),
		'not_found'             => __( 'Content Group Item Not found', 'lorainccc' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lorainccc' ),
		'featured_image'        => __( 'Featured Image', 'lorainccc' ),
		'set_featured_image'    => __( 'Set featured image', 'lorainccc' ),
		'remove_featured_image' => __( 'Remove featured image', 'lorainccc' ),
		'use_featured_image'    => __( 'Use as featured image', 'lorainccc' ),
		'insert_into_item'      => __( 'Insert into Content Group Item', 'lorainccc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'lorainccc' ),
		'items_list'            => __( 'Content Group Items list', 'lorainccc' ),
		'items_list_navigation' => __( 'Content Group Items list navigation', 'lorainccc' ),
		'filter_items_list'     => __( 'Filter Content Group Items list', 'lorainccc' ),
	);
	$args = array(
		'label'                 => __( 'Content Group Item', 'lorainccc' ),
		'description'           => __( 'This is the custom post type to create the Gateway menu', 'lorainccc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' 			=> 'dashicons-exerpt-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'content_group', $args );

}
add_action( 'init', 'content_group_cpt', 0 );


?>