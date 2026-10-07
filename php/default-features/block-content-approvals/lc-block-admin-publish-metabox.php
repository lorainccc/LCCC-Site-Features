<?php
 
/*
 *	Code adapted from https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress
 *	Created July 2016.
 *
 */

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'lc_block_admin_publish_meta_box_setup' );
add_action( 'load-post-new.php', 'lc_block_admin_publish_meta_box_setup' );

/* Meta box setup function */
function lc_block_admin_publish_meta_box_setup() {
 /* Add meta boxes on the 'add_meta_boxes' hook. */
 add_action( 'add_meta_boxes', 'lc_add_block_admin_publish_meta_box' );

 /* Save post meta on the 'save_post' hook. */
 add_action( 'save_post', 'lc_block_admin_publish_save_info', 10, 2 );
}

/* Create one or meta boxes to be displayed on the post editor screen */
function lc_add_block_admin_publish_meta_box() {
    add_meta_box(
     'lc_block_admin_publish_metabox',                                  // Unique ID (ID of Div Tag ** Note: DO NOT NAME same as field(s) below **)
     esc_html__( 'LCCC Publishing', 'lorainccc' ),                      // Title & Text Domain
     'lc_show_block_admin_publish_meta_box',                            // Callback function
     'page',                                                            // Admin Page or Post Type
     'side',                                                            // Context (Position)
     'high'                                                             // Priority
    );
   }

/* Display the post meta box */
function lc_show_block_admin_publish_meta_box( $post ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'lc_block_admin_publish_nonce' ); ?>
    
    <?php

        echo '<p>Current Status: <span class="lc-post-status">' . $post->post_status . '</span></p>';

        $lc_published_id = get_post_meta($post->ID, '_lc_publishedId', true);

        echo '<p>Published Page ID: <span class="lc-post-status"><a href="' . get_permalink($lc_published_id) . '" target="_blank">' . $lc_published_id  . '</a></span></p>';

        if( $post->post_status != 'publish'){
            echo '<a href="admin.php?page=lc_content_revisions&lc_publish_post=true&lcpostID=' . $post->ID . '" class="lc-post-publish-btn">Publish</a>';
        }

        


}

/* Save the meta box's post metadata */
function lc_block_admin_publish_save_info( $post_id, $post ) {

    /* Verify the nonce before proceeding */
    if ( !isset( $_POST['lc_block_admin_publish_nonce'] ) || !wp_verify_nonce( $_POST['lc_block_admin_publish_nonce'], basename( __FILE__ ) ) )
     return $post_id;
   
    /* Get the post type object */
    $post_type = get_post_type_object ( $post->post_type );
   
    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
     return $post_id;
    
    /* Enable Badge Widget Options */
    /* Get the posted data and sanitize it for use as a date value. */
    $new_meta_value = ( isset( $_POST['lc_microsite_enable_badges'] ) ? sanitize_text_field($_POST['lc_microsite_enable_badges'] ) : '' );
   
    /* Get the meta key. */
    $meta_key = 'lc_microsite_enable_badges';
   
     /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta ($post_id, $meta_key, true );
   
    update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
}


function update_block_admin_publish_meta_values( $post_id, $meta_key, $new_meta_value, $meta_value ) {

  /* If a new meta value was added and there was no previous value, add it. */
 if ( $new_meta_value && '' == $meta_value )
   add_post_meta( $post_id, $meta_key, $new_meta_value, true );

 /* If the new meta value was added and there was no previous value, add it. */
 elseif ( $new_meta_value && $new_meta_value != $meta_value )
  update_post_meta( $post_id, $meta_key, $new_meta_value );

 /* If there is no new meta value but an old value exists, delete it. */
 elseif ( '' == $new_meta_value && $meta_value )
  delete_post_meta( $post_id, $meta_key, $meta_value );

}