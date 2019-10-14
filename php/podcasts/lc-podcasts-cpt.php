<?php 
/*
  * Podcast Custom Post Type
  * 
  * 
  */


// Register Custom Post Type
function lc_podcasts() {

	$labels = array(
		'name'                  => _x( 'Podcasts', 'Post Type General Name', 'lorainccc' ),
		'singular_name'         => _x( 'Podcast', 'Post Type Singular Name', 'lorainccc' ),
		'menu_name'             => __( 'Podcast Episodes', 'lorainccc' ),
		'name_admin_bar'        => __( 'Podcast', 'lorainccc' ),
		'archives'              => __( 'Podcast Episode Archives', 'lorainccc' ),
		'attributes'            => __( 'Podcast Episode Attributes', 'lorainccc' ),
		'parent_item_colon'     => __( 'Podcast Episode Parent Item:', 'lorainccc' ),
		'all_items'             => __( 'All Podcast Episodes', 'lorainccc' ),
		'add_new_item'          => __( 'Add New Podcast Episode', 'lorainccc' ),
		'add_new'               => __( 'Add New Podcast Episode', 'lorainccc' ),
		'new_item'              => __( 'New Podcast Episode', 'lorainccc' ),
		'edit_item'             => __( 'Edit Podcast Episode', 'lorainccc' ),
		'update_item'           => __( 'Update Podcast Episode', 'lorainccc' ),
		'view_item'             => __( 'View Podcast Episode', 'lorainccc' ),
		'view_items'            => __( 'View Podcast Episodes', 'lorainccc' ),
		'search_items'          => __( 'Search Podcast Episodes', 'lorainccc' ),
		'not_found'             => __( 'Not found', 'lorainccc' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lorainccc' ),
		'featured_image'        => __( 'Featured Image', 'lorainccc' ),
		'set_featured_image'    => __( 'Set featured image', 'lorainccc' ),
		'remove_featured_image' => __( 'Remove featured image', 'lorainccc' ),
		'use_featured_image'    => __( 'Use as featured image', 'lorainccc' ),
		'insert_into_item'      => __( 'Insert into Podcast Episode', 'lorainccc' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Podcast Episode', 'lorainccc' ),
		'items_list'            => __( 'Podcast Episode list', 'lorainccc' ),
		'items_list_navigation' => __( 'Podcast Episode list navigation', 'lorainccc' ),
		'filter_items_list'     => __( 'Filter Podcast Episode list', 'lorainccc' ),
	);
	$args = array(
		'label'                 => __( 'Podcast', 'lorainccc' ),
		'description'           => __( 'Podcast Posts', 'lorainccc' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'post-formats' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'lccc_podcasts', $args );

}
add_action( 'init', 'lc_podcasts', 0 );

?>