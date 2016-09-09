<?php

 /**
  *  LCCC Department Contact Custom Post Type
  */

// Register Custom Post Type
function lc_dept_contact_info() {

	$labels = array(
		'name'                  => _x( 'Department Contact Info', 'Post Type General Name', 'lorainccc' ),
		'singular_name'         => _x( 'Department Contact Info', 'Post Type Singular Name', 'lorainccc' ),
		'menu_name'             => __( 'Department Contact Info', 'lorainccc' ),
		'name_admin_bar'        => __( 'Department Contact Info', 'lorainccc' ),
		'archives'              => __( 'Department Contact Info Archives', 'lorainccc' ),
		'parent_item_colon'     => __( 'Department Contact Info Item:', 'lorainccc' ),
		'all_items'             => __( 'All Department Contact Info', 'lorainccc' ),
		'add_new_item'          => __( 'Add New Department Contact Info', 'lorainccc' ),
		'add_new'               => __( 'Add New Department Contact Info', 'lorainccc' ),
		'new_item'              => __( 'New Department Contact Info', 'lorainccc' ),
		'edit_item'             => __( 'Edit Department Contact Info', 'lorainccc' ),
		'update_item'           => __( 'Update Department Contact Info', 'lorainccc' ),
		'view_item'             => __( 'View Department Contact Info', 'lorainccc' ),
		'search_items'          => __( 'Search Department Contact Info', 'lorainccc' ),
		'not_found'             => __( 'Department Contact Info Not found', 'lorainccc' ),
		'not_found_in_trash'    => __( 'Department Contact Info Not found in Trash', 'lorainccc' ),
		'featured_image'        => __( 'Featured Image', 'lorainccc' ),
		'set_featured_image'    => __( 'Set featured image', 'lorainccc' ),
		'remove_featured_image' => __( 'Remove featured image', 'lorainccc' ),
		'use_featured_image'    => __( 'Use as featured image', 'lorainccc' ),
		'insert_into_item'      => __( 'Insert into item', 'lorainccc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'lorainccc' ),
		'items_list'            => __( 'Items list', 'lorainccc' ),
		'items_list_navigation' => __( 'Items list navigation', 'lorainccc' ),
		'filter_items_list'     => __( 'Filter items list', 'lorainccc' ),
	);
	$args = array(
		'label'                 => __( 'Department Contact Info', 'lorainccc' ),
		'description'           => __( 'LCCC Department Contact Info', 'lorainccc' ),
		'labels'                => $labels,
  'supports'              => array( 'title', ),
  'taxonomies'            => array( 'category', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-clock',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'lc_contact_info', $args );

}
add_action( 'init', 'lc_dept_contact_info', 0 );

?>