<?php

// Register Custom Post Type
function gateway_menu_cpt() {

	$labels = array(
		'name'                  => _x( 'Gateway Menu Items', 'Post Type General Name', 'gateway_menu' ),
		'singular_name'         => _x( 'Gateway Menu Item', 'Post Type Singular Name', 'gateway_menu' ),
		'menu_name'             => __( 'Gateway Menu', 'gateway_menu' ),
		'name_admin_bar'        => __( 'Gateway Menu Item', 'gateway_menu' ),
		'archives'              => __( 'Gateway Menu Item Archives', 'gateway_menu' ),
		'parent_item_colon'     => __( 'Parent Item:', 'gateway_menu' ),
		'all_items'             => __( 'All Items', 'gateway_menu' ),
		'add_new_item'          => __( 'Add New Gateway Menu Item', 'gateway_menu' ),
		'add_new'               => __( 'Add New Gateway Menu Item', 'gateway_menu' ),
		'new_item'              => __( 'New Item', 'gateway_menu' ),
		'edit_item'             => __( 'Edit Item', 'gateway_menu' ),
		'update_item'           => __( 'Update Item', 'gateway_menu' ),
		'view_item'             => __( 'View Item', 'gateway_menu' ),
		'search_items'          => __( 'Search Gateway Menu Item', 'gateway_menu' ),
		'not_found'             => __( 'Gateway Menu Item Not found', 'gateway_menu' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'gateway_menu' ),
		'featured_image'        => __( 'Featured Image', 'gateway_menu' ),
		'set_featured_image'    => __( 'Set featured image', 'gateway_menu' ),
		'remove_featured_image' => __( 'Remove featured image', 'gateway_menu' ),
		'use_featured_image'    => __( 'Use as featured image', 'gateway_menu' ),
		'insert_into_item'      => __( 'Insert into Gateway Menu Item', 'gateway_menu' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'gateway_menu' ),
		'items_list'            => __( 'Gateway Menu Items list', 'gateway_menu' ),
		'items_list_navigation' => __( 'Gateway Menu Items list navigation', 'gateway_menu' ),
		'filter_items_list'     => __( 'Filter Gateway Menu Items list', 'gateway_menu' ),
	);
	$args = array(
		'label'                 => __( 'Gateway Menu Item', 'gateway_menu' ),
		'description'           => __( 'This is the custom post type to create the Gateway menu', 'gateway_menu' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' => 'dashicons-exerpt-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'gateway_menu', $args );

}
add_action( 'init', 'gateway_menu_cpt', 0 );


?>