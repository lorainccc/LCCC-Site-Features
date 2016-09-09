<?php

function custom_badges() { 
	// creating (registering) the custom type 
	register_post_type( 'badges', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'LCCC badges', 'reverie' ), /* This is the Title of the Group */
			'singular_name' => __( ' LCCC badge', 'reverie' ), /* This is the individual type */
			'all_items' => __( 'All LCCC badges', 'reverie' ), /* the all items menu item */
			'add_new' => __( 'Add New LCCC badge', 'reverie' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Custom LCCC badge', 'reverie' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'reverie' ), /* Edit Dialog */
			'edit_item' => __( 'Edit LCCC badges', 'reverie' ), /* Edit Display Title */
			'new_item' => __( 'New LCCC badge', 'reverie' ), /* New Display Title */
			'view_item' => __( 'View LCCC badge', 'reverie' ), /* View Display Title */
			'search_items' => __( 'Search LCCC badges', 'reverie' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'reverie' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'reverie' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example custom post type', 'reverie' ), /* Custom Type Description */
			'taxonomies' => array('category'),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' =>5, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-shield', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'LCCC_badges', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'badges' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'badges' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_badges');


?>