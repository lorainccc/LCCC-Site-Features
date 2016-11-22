<?php

 /**
  *  LCCC Department Directory Post Type
  */

// Register Custom Post Type

// Register Custom Post Type
function lc_department_directory() {

	$labels = array(
		'name'                  => _x( 'Directory Entries', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Directory Entry', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Department Directory', 'text_domain' ),
		'name_admin_bar'        => __( 'Department Directory', 'text_domain' ),
		'archives'              => __( 'Department Directory Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Directory Entries', 'text_domain' ),
		'add_new_item'          => __( 'Add New Directory Entry', 'text_domain' ),
		'add_new'               => __( 'Add New Directory Entry', 'text_domain' ),
		'new_item'              => __( 'New Item Directory Entry', 'text_domain' ),
		'edit_item'             => __( 'Edit Directory Entry', 'text_domain' ),
		'update_item'           => __( 'Update Directory Entry', 'text_domain' ),
		'view_item'             => __( 'View Directory Entry', 'text_domain' ),
		'search_items'          => __( 'Search Directory Entry', 'text_domain' ),
		'not_found'             => __( 'Directory Entry Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Directory Entry Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Directory Entry', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Directory Entry', 'text_domain' ),
		'items_list'            => __( 'Directory Entry list', 'text_domain' ),
		'items_list_navigation' => __( 'Directory Entry list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Directory Entry items list', 'text_domain' ),
	);

	$args = array(
		'label'                 => __( 'Directory Entry', 'text_domain' ),
		'description'           => __( 'LCCC Department Directory', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
  'rest_base'             => 'lccc_directory',
  'rest_controller_class' => 'WP_REST_Posts_Controller',
		'menu_icon'             => 'dashicons-id-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);

 //Instead of naming the post type 'lc_dept_dir', the below is used so the slug in the url looks nicer
	register_post_type( 'faculty-staff-dir', $args );

}
add_action( 'init', 'lc_department_directory', 0 );

// Changing text inside of Title field

function lc_faculty_staff_dir_change_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'faculty-staff-dir' == $screen->post_type ) {
          $title = 'Enter First Name followed by Last Name';
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'lc_faculty_staff_dir_change_title_text' );


?>