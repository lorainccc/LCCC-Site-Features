<?php

 /**
  *  LCCC Department Directory Post Type
  */

// Register LCCC Department Directory Custom Post Type
function lc_department_directory() {

	$labels = array(
		'name'                  => _x( 'LCCC Department Directory', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'LCCC Department Directory', 'Post Type Singular Name', 'text_domain' ),
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
		'label'                 => __( 'LCCC Department Directory Entry', 'text_domain' ),
		'description'           => __( 'LCCC Department Directory', 'text_domain' ),
		'labels'                => $labels,
		//'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_rest'			=> true,
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
	register_post_type( 'faculty_staff_dir', $args );

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


// Register Departments Taxonomy
function lcdeptdir_departments() {

	$labels = array(
		'name'                       => _x( 'Departments', 'Taxonomy General Name', 'lorainccc' ),
		'singular_name'              => _x( 'Department', 'Taxonomy Singular Name', 'lorainccc' ),
		'menu_name'                  => __( 'Departments', 'lorainccc' ),
		'all_items'                  => __( 'All Departments', 'lorainccc' ),
		'parent_item'                => __( 'Parent Department', 'lorainccc' ),
		'parent_item_colon'          => __( 'Parent Department:', 'lorainccc' ),
		'new_item_name'              => __( 'New Department Name', 'lorainccc' ),
		'add_new_item'               => __( 'Add New Department', 'lorainccc' ),
		'edit_item'                  => __( 'Edit Department', 'lorainccc' ),
		'update_item'                => __( 'Update Department', 'lorainccc' ),
		'view_item'                  => __( 'View Department', 'lorainccc' ),
		'separate_items_with_commas' => __( 'Separate Department with commas', 'lorainccc' ),
		'add_or_remove_items'        => __( 'Add or remove Departments', 'lorainccc' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'lorainccc' ),
		'popular_items'              => __( 'Popular Departments', 'lorainccc' ),
		'search_items'               => __( 'Search Departments', 'lorainccc' ),
		'not_found'                  => __( 'Not Found', 'lorainccc' ),
		'no_terms'                   => __( 'No Departments', 'lorainccc' ),
		'items_list'                 => __( 'Departments list', 'lorainccc' ),
		'items_list_navigation'      => __( 'Departments list navigation', 'lorainccc' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'lcdeptdir_deptartments', array( 'faculty_staff_dir' ), $args );

}
add_action( 'init', 'lcdeptdir_departments', 0 );


// Register Position Types Taxonomy
function lcdeptdir_positiontype() {

	$labels = array(
		'name'                       => _x( 'Position Types', 'Taxonomy General Name', 'lorainccc' ),
		'singular_name'              => _x( 'Position Type', 'Taxonomy Singular Name', 'lorainccc' ),
		'menu_name'                  => __( 'Position Type', 'lorainccc' ),
		'all_items'                  => __( 'All Position Types', 'lorainccc' ),
		'parent_item'                => __( 'Parent Position Type', 'lorainccc' ),
		'parent_item_colon'          => __( 'Parent Position Type:', 'lorainccc' ),
		'new_item_name'              => __( 'New Position Type', 'lorainccc' ),
		'add_new_item'               => __( 'Add New Position Type', 'lorainccc' ),
		'edit_item'                  => __( 'Edit Position Type', 'lorainccc' ),
		'update_item'                => __( 'Update Position Type', 'lorainccc' ),
		'view_item'                  => __( 'View Position Type', 'lorainccc' ),
		'separate_items_with_commas' => __( 'Separate Position Types with commas', 'lorainccc' ),
		'add_or_remove_items'        => __( 'Add or remove Position Types', 'lorainccc' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'lorainccc' ),
		'popular_items'              => __( 'Popular Position Types', 'lorainccc' ),
		'search_items'               => __( 'Search Position Types', 'lorainccc' ),
		'not_found'                  => __( 'Not Found', 'lorainccc' ),
		'no_terms'                   => __( 'No Position Types', 'lorainccc' ),
		'items_list'                 => __( 'Position Types list', 'lorainccc' ),
		'items_list_navigation'      => __( 'Position Types list navigation', 'lorainccc' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'lcdeptdir_positiontype', array( 'faculty_staff_dir' ), $args );

}
add_action( 'init', 'lcdeptdir_positiontype', 0 );

// Register Alphabet Taxonomy (Hidden Taxonomy used for A-Z Index links)
function lcdeptdir_alphabet(){

		$labels = array(
			'name'                       => _x( 'Alphabet', 'Taxonomy General Name', 'lorainccc' ),
			'singular_name'              => _x( 'Alphabet', 'Taxonomy Singular Name', 'lorainccc' ),
			'menu_name'                  => __( 'Alphabet', 'lorainccc' ),
			'all_items'                  => __( 'All Alphabet', 'lorainccc' ),
			'parent_item'                => __( 'Parent Alphabet', 'lorainccc' ),
			'parent_item_colon'          => __( 'Parent Alphabet:', 'lorainccc' ),
			'new_item_name'              => __( 'New Alphabet', 'lorainccc' ),
			'add_new_item'               => __( 'Add New Alphabet', 'lorainccc' ),
			'edit_item'                  => __( 'Edit Alphabet', 'lorainccc' ),
			'update_item'                => __( 'Update Alphabet', 'lorainccc' ),
			'view_item'                  => __( 'View Alphabet', 'lorainccc' ),
			'separate_items_with_commas' => __( 'Separate Alphabet with commas', 'lorainccc' ),
			'add_or_remove_items'        => __( 'Add or remove Alphabet', 'lorainccc' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'lorainccc' ),
			'popular_items'              => __( 'Popular Alphabet', 'lorainccc' ),
			'search_items'               => __( 'Search Alphabet', 'lorainccc' ),
			'not_found'                  => __( 'Not Found', 'lorainccc' ),
			'no_terms'                   => __( 'No Alphabet', 'lorainccc' ),
			'items_list'                 => __( 'Alphabet list', 'lorainccc' ),
			'items_list_navigation'      => __( 'Alphabet list navigation', 'lorainccc' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => false,
			'show_admin_column'          => false,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'show_in_rest'               => true,
		);
		register_taxonomy( 'lcdeptdir_alphabet', array( 'faculty_staff_dir' ), $args );

}
add_action( 'init', 'lcdeptdir_alphabet', 0 );

// Register Academic Focus/Team Taxonomy
function lcdeptdir_acadfocus_teams() {

	$labels = array(
		'name'                       => _x( 'Academic Focus/Teams', 'Taxonomy General Name', 'lorainccc' ),
		'singular_name'              => _x( 'Academic Focus/Team', 'Taxonomy Singular Name', 'lorainccc' ),
		'menu_name'                  => __( 'Academic Focus/Team', 'lorainccc' ),
		'all_items'                  => __( 'All Academic Focus/Teams', 'lorainccc' ),
		'parent_item'                => __( 'Parent Academic Focus/Team', 'lorainccc' ),
		'parent_item_colon'          => __( 'Parent Academic Focus/Team:', 'lorainccc' ),
		'new_item_name'              => __( 'New Academic Focus/Team', 'lorainccc' ),
		'add_new_item'               => __( 'Add New Academic Focus/Team', 'lorainccc' ),
		'edit_item'                  => __( 'Edit Academic Focus/Team', 'lorainccc' ),
		'update_item'                => __( 'Update Academic Focus/Team', 'lorainccc' ),
		'view_item'                  => __( 'View Academic Focus/Team', 'lorainccc' ),
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
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'lcdeptdir_acadfocus', array( 'faculty_staff_dir' ), $args );

}
add_action( 'init', 'lcdeptdir_acadfocus_teams', 0 );

/* Add Post Admin Filtering */

function remove_date_drop(){

	$screen = get_current_screen();
	
		if ( 'faculty_staff_dir' == $screen->post_type ){
			add_filter('months_dropdown_results', '__return_empty_array');
		}
	}
	
	add_action('admin_head', 'remove_date_drop');

function lc_deptdir_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('lcdeptdir_alphabet','lcdeptdir_deptartments','lcdeptdir_positiontype','lcdeptdir_acadfocus');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'faculty_staff_dir' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'lc_deptdir_add_taxonomy_filters' );


?>