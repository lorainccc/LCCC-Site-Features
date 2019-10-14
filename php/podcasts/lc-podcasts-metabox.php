<?php
/*
		*	Code adapted from https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress
		*	Created July 2016.
		*
		*/

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'lc_podcasts_meta_boxes_setup' );
add_action( 'load-post-new.php', 'lc_podcasts_meta_boxes_setup' );

/* Meta box setup function */
function lc_podcasts_meta_boxes_setup() {
    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_action( 'add_meta_boxes', 'lc_add_podcasts_meta_box' );
   
    /* Save post meta on the 'save_post' hook. */
    add_action( 'save_post', 'lc_podcasts_save_info', 10, 2 );
   }

/* Create one or meta boxes to be displayed on the post editor screen */
function lc_add_podcasts_meta_box() {
    add_meta_box(
     'lc_add_podcasts_meta_box',                                 // Unique ID (ID of Div Tag ** Note: DO NOT NAME same as field(s) below **)
     esc_html__( 'Podcast Episode Fields', 'lorainccc' ),                 // Title & Text Domain
     'lc_show_podcasts_meta_box',                           // Callback function
     'lccc_podcasts',                                             // Admin Page or Post Type
     'normal',                                                       // Context (Position)
     'default'                                                       // Priority
    );
   }

/* Display the post meta box */
function lc_show_podcasts_meta_box( $object, $box ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'lc_podcasts_post_nonce' ); ?>
   
     <p>
      <label for="lc_podcasts_link_label_field">
       <?php _e( "Podcast Episode More Information Link Label: ", "lorainccc" ); ?>
      </label>
      <input type="text" name="lc_podcasts_link_label_field" id="lc_podcasts_link_label_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_podcasts_link_label_field', true ) ); ?>" size="30" />
     </p>
   
     <p>
      <label for="lc_program_path_link_field">
       <?php _e( "Podcast Episode More Information Link: ", "lorainccc" ); ?>
      </label>
      <input type="text" name="lc_podcasts_link_field" id="lc_podcasts_link_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_podcasts_link_field', true ) ); ?>" size="30" />
     </p>
   
    <?php
   }
   
/* Save the meta box's post metadata */
function lc_podcasts_save_info( $post_id, $post ) {

    /* Verify the nonce before proceeding */
    if ( !isset( $_POST['lc_podcasts_post_nonce'] ) || !wp_verify_nonce( $_POST['lc_podcasts_post_nonce'], basename( __FILE__ ) ) )
     return $post_id;
   
    /* Get the post type object */
    $post_type = get_post_type_object ( $post->post_type );
   
    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
     return $post_id;
   
    /* Path Link Field */
    /* Get the posted data and sanitize it for use as a date value. */
    $new_meta_value = ( isset( $_POST['lc_podcasts_link_field'] ) ? sanitize_text_field($_POST['lc_podcasts_link_field'] ) : '' );
   
    /* Get the meta key. */
    $meta_key = 'lc_podcasts_link_field';
   
     /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta ($post_id, $meta_key, true );
   
    update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
   
     /* Path Link Label Field */
    /* Get the posted data and sanitize it for use as a date value. */
    $new_meta_value = ( isset( $_POST['lc_podcasts_link_label_field'] ) ? sanitize_text_field($_POST['lc_podcasts_link_label_field'] ) : '' );
   
    /* Get the meta key. */
    $meta_key = 'lc_podcasts_link_label_field';
   
     /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta ($post_id, $meta_key, true );
   
    update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
   
   }
   
   
   function update_podcasts_meta_values( $post_id, $meta_key, $new_meta_value, $meta_value ) {
   
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