<?php

/*
		*	Code adapted from https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress
		*	Created October 2016.
		*
		*/

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'lc_shared_content_meta_boxes_setup' );
add_action( 'load-post-new.php', 'lc_shared_content_meta_boxes_setup' );

/* Meta box setup function */
function lc_shared_content_meta_boxes_setup() {
 /* Add meta boxes on the 'add_meta_boxes' hook. */
 add_action( 'add_meta_boxes', 'lc_add_shared_content_meta_box' );

 /* Save post meta on the 'save_post' hook. */
 add_action( 'save_post', 'lc_shared_content_save_info', 10, 2 );
}

/* Create one or meta boxes to be displayed on the post editor screen */
function lc_add_shared_content_meta_box() {
 add_meta_box(
  'lc_add_shared_content_meta_box',                            // Unique ID (ID of Div Tag ** Note: DO NOT NAME same as field(s) below **)
  esc_html__( 'LCCC Shared Content', 'lorainccc' ),                 // Title & Text Domain
  'lc_show_shared_content_meta_box',                           // Callback function
  'page',                                                         // Admin Page or Post Type
  'normal',                                                       // Context (Position)
  'default'                                                       // Priority
 );
}

/* Display the post meta box */
function lc_show_shared_content_meta_box( $object, $box ) { ?>

 <?php wp_nonce_field( basename( __FILE__ ), 'lc_shared_content_post_nonce' ); ?>

  <p>
   <label for="lc_shared_content_site_url_field">
    <?php _e( "Site URL to Shared Content: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_shared_content_site_url_field" id="lc_shared_content_site_url_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_shared_content_site_url_field', true ) ); ?>" size="90" />
  </p>
  <p class="description">Site URL without the domain.  Example: <b>/program-pathways/</b> not <b>https://test.lorainccc.edu/program-pathways/</b>.</p>

  <p>
   <label for="lc_shared_content_post_slug_field">
    <?php _e( "Shared Content Post Slug: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_shared_content_post_slug_field" id="lc_shared_content_post_slug_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_shared_content_post_slug_field', true ) ); ?>" size="40" />
  </p>


 <?php
}

/* Save the meta box's post metadata */
function lc_shared_content_save_info( $post_id, $post ) {

 /* Verify the nonce before proceeding */
 if ( !isset( $_POST['lc_shared_content_post_nonce'] ) || !wp_verify_nonce( $_POST['lc_shared_content_post_nonce'], basename( __FILE__ ) ) )
  return $post_id;

 /* Get the post type object */
 $post_type = get_post_type_object ( $post->post_type );

 /* Check if the current user has permission to edit the post. */
 if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
  return $post_id;

 /* Shared Content Site URL Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_shared_content_site_url_field'] ) ? sanitize_text_field($_POST['lc_shared_content_site_url_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_shared_content_site_url_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Shared Content Post Slug Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_shared_content_post_slug_field'] ) ? sanitize_text_field($_POST['lc_shared_content_post_slug_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_shared_content_post_slug_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
 
}


function update_shared_content_meta_values( $post_id, $meta_key, $new_meta_value, $meta_value ) {

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

?>