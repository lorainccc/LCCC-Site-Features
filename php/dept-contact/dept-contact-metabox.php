<?php
/*
		*	Code adapted from https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress
		*	Created July 2016.
		*
		*/

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'lc_dept_contact_info_meta_boxes_setup' );
add_action( 'load-post-new.php', 'lc_dept_contact_info_meta_boxes_setup' );

/* Meta box setup function */
function lc_dept_contact_info_meta_boxes_setup() {
 /* Add meta boxes on the 'add_meta_boxes' hook. */
 add_action( 'add_meta_boxes', 'lc_add_dept_contact_info_meta_box' );

 /* Save post meta on the 'save_post' hook. */
 add_action( 'save_post', 'lc_dept_contact_save_info', 10, 2 );
}

/* Create one or meta boxes to be displayed on the post editor screen */
function lc_add_dept_contact_info_meta_box() {
 add_meta_box(
  'lc_dept_contact_info_metabox',                                 // Unique ID (ID of Div Tag ** Note: DO NOT NAME same as field(s) below **)
  esc_html__( 'Department Contact Info', 'lorainccc' ),           // Title & Text Domain
  'lc_show_dept_contact_info_meta_box',                           // Callback function
  'lc_contact_info',                                              // Admin Page or Post Type
  'normal',                                                       // Context (Position)
  'default'                                                       // Priority
 );
}

/* Display the post meta box */
function lc_show_dept_contact_info_meta_box( $object, $box ) { ?>

 <?php wp_nonce_field( basename( __FILE__ ), 'lc_dept_contact_post_nonce' ); ?>

  <p>
   <label for="lc_dept_extension_field">
    <?php _e( "Department Phone Extension: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_extension_field" id="lc_dept_extension_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_extension_field', true ) ); ?>" size="30" />
  </p>

  <p>
   <label for="lc_dept_email_field">
    <?php _e( "Department Email Address: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_email_field" id="lc_dept_email_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_email_field', true ) ); ?>" size="30" />
  </p>

  <p>
   <label for="lc_dept_fax_number_field">
    <?php _e( "Department Fax Number: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_fax_number_field" id="lc_dept_fax_number_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_fax_number_field', true ) ); ?>" size="30" />
  </p>

  <p>
   <label for="lc_building_field">
    <?php _e( "Department Building: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_building_field" id="lc_building_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_building_field', true ) ); ?>" size="30" />
  </p>

  <p>
   <label for="lc_room_field">
    <?php _e( "Department Room Number: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_room_field" id="lc_room_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_room_field', true ) ); ?>" size="30" />
  </p>

		<h3>Department Office Hours:</h3>

  <p>
   <label for="lc_dept_office_hours_monday_field">
    <?php _e( "Monday: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_office_hours_monday_field" id="lc_dept_office_hours_monday_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_office_hours_monday_field', true ) ); ?>" size="10" />
  </p>

  <p>
   <label for="lc_dept_office_hours_tuesday_field">
    <?php _e( "Tuesday: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_office_hours_tuesday_field" id="lc_dept_office_hours_tuesday_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_office_hours_tuesday_field', true ) ); ?>" size="10" />
  </p>

  <p>
   <label for="lc_dept_office_hours_wednesday_field">
    <?php _e( "Wednesday: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_office_hours_wednesday_field" id="lc_dept_office_hours_wednesday_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_office_hours_wednesday_field', true ) ); ?>" size="10" />
  </p>

  <p>
   <label for="lc_dept_office_hours_thursday_field">
    <?php _e( "Thursday: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_office_hours_thursday_field" id="lc_dept_office_hours_thursday_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_office_hours_thursday_field', true ) ); ?>" size="10" />
  </p>

  <p>
   <label for="lc_dept_office_hours_friday_field">
    <?php _e( "Friday: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_office_hours_friday_field" id="lc_dept_office_hours_friday_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_office_hours_friday_field', true ) ); ?>" size="10" />
  </p>

  <p>
   <label for="lc_dept_office_hours_saturday_field">
    <?php _e( "Saturday: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_office_hours_saturday_field" id="lc_dept_office_hours_saturday_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_office_hours_saturday_field', true ) ); ?>" size="10" />
  </p>

  <p>
   <label for="lc_dept_office_hours_sunday_field">
    <?php _e( "Sunday: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_dept_office_hours_sunday_field" id="lc_dept_office_hours_sunday_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_dept_office_hours_sunday_field', true ) ); ?>" size="10" />
  </p>

		<h3>Social Media Links</h3>

  <p>
   <label for="lc_social_media_facebook_field">
    <?php _e( "Facebook Username: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_social_media_facebook_field" id="lc_social_media_facebook_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_social_media_facebook_field', true ) ); ?>" size="30" />
  </p>
  <p class="description" id="tagline-description"><strong>lorainccc</strong> is LCCC's username. Example: https://www.facebook.com/<strong>lorainccc</strong></p>
<hr />
  <p>
   <label for="lc_social_media_twitter_field">
    <?php _e( "Twitter Username: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_social_media_twitter_field" id="lc_social_media_twitter_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_social_media_twitter_field', true ) ); ?>" size="30" />
  </p>
  <p class="description" id="tagline-description"><strong>lorainccc</strong> is LCCC's username. Example: https://www.twitter.com/<strong>lorainccc</strong></p>

  <?php
}

/* Save the meta box's post metadata */
function lc_dept_contact_save_info( $post_id, $post ) {

 /* Verify the nonce before proceeding */
 if ( !isset( $_POST['lc_dept_contact_post_nonce'] ) || !wp_verify_nonce( $_POST['lc_dept_contact_post_nonce'], basename( __FILE__ ) ) )
  return $post_id;

 /* Get the post type object */
 $post_type = get_post_type_object ( $post->post_type );

 /* Check if the current user has permission to edit the post. */
 if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
  return $post_id;

 /* Extension Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_extension_field'] ) ? sanitize_text_field($_POST['lc_dept_extension_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_extension_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Email Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_email_field'] ) ? sanitize_text_field($_POST['lc_dept_email_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_email_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Fax Number Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_fax_number_field'] ) ? sanitize_text_field($_POST['lc_dept_fax_number_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_fax_number_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

	 /* Building Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_building_field'] ) ? sanitize_text_field($_POST['lc_building_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_building_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
	
 /* Room Number Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_room_field'] ) ? sanitize_text_field($_POST['lc_room_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_room_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

	 /* Monday Office Hours Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_office_hours_monday_field'] ) ? sanitize_text_field($_POST['lc_dept_office_hours_monday_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_office_hours_monday_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

	 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
	
	 /* Tuesday Office Hours Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_office_hours_tuesday_field'] ) ? sanitize_text_field($_POST['lc_dept_office_hours_tuesday_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_office_hours_tuesday_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );
	
	 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
	
	 /* Wednesday Office Hours Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_office_hours_wednesday_field'] ) ? sanitize_text_field($_POST['lc_dept_office_hours_wednesday_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_office_hours_wednesday_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );
	
	 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
	
	 /* Thursday Office Hours Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_office_hours_thursday_field'] ) ? sanitize_text_field($_POST['lc_dept_office_hours_thursday_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_office_hours_thursday_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );
	
	 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
	
	 /* Friday Office Hours Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_office_hours_friday_field'] ) ? sanitize_text_field($_POST['lc_dept_office_hours_friday_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_office_hours_friday_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );
	
	 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
	
 /* Saturday Office Hours Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_office_hours_saturday_field'] ) ? sanitize_text_field($_POST['lc_dept_office_hours_saturday_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_office_hours_saturday_field';
	
  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );
	
	 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
	
  /* Sunday Office Hours Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_dept_office_hours_sunday_field'] ) ? sanitize_text_field($_POST['lc_dept_office_hours_sunday_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_dept_office_hours_sunday_field';
	
  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );
	
	 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
 
 /* Facebook Social Media Link Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_social_media_facebook_field'] ) ? sanitize_text_field($_POST['lc_social_media_facebook_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_social_media_facebook_field';
	
  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );
	
	 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
	
	 /* Twitter Social Media Link Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_social_media_twitter_field'] ) ? sanitize_text_field($_POST['lc_social_media_twitter_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_social_media_twitter_field';
	
  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );
			
 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
}


function update_dept_meta_values( $post_id, $meta_key, $new_meta_value, $meta_value ) {

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