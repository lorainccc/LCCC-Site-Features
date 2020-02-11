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

/* Register Post Meta Fields */

// Podcast Episode File URL
register_post_meta('post', 'lc_podcast_url',
  array(
    'object_subtype'  => 'lccc_podcasts',
    'show_in_rest'    => 'true',
    'type'            => 'string',
    'single'          => true,
  )
);

// Podcast Episode Explicit Setting
register_post_meta('post', 'lc_podcast_explicit',
  array(
    'object_subtype'  => 'lccc_podcasts',
    'show_in_rest'    => 'true',
    'type'            => 'string',
    'single'          => true,
  )
);

// Podcast Episode Caption Setting
register_post_meta('post', 'lc_podcast_captioned',
  array(
    'object_subtype'  => 'lccc_podcasts',
    'show_in_rest'    => 'true',
    'type'            => 'boolean',
    'single'          => true,
  )
);

// Podcast Episode Duration
register_post_meta('post', 'lc_podcast_duration',
  array(
    'object_subtype'  => 'lccc_podcasts',
    'show_in_rest'    => 'true',
    'type'            => 'string',
    'single'          => true,
  )
);

// Podcast Episode Filesize
register_post_meta('post', 'lc_podcast_filesize',
  array(
    'object_subtype'  => 'lccc_podcasts',
    'show_in_rest'    => 'true',
    'type'            => 'string',
    'single'          => true,
  )
);

// Podcast Episode Mimetype
register_post_meta('post', 'lc_podcast_mime',
  array(
    'object_subtype'  => 'lccc_podcasts',
    'show_in_rest'    => 'true',
    'type'            => 'string',
    'single'          => true,
  )
);

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

     <hr/>
<?php
	$lc_podcast_url = get_post_meta( $object->ID, 'lc_podcast_url', true );
	$lc_podcast_duration = get_post_meta( $object->ID, 'lc_podcast_duration', true );
	$lc_podcast_mime = get_post_meta( $object->ID, 'lc_podcast_mime', true );
	$lc_podcast_explicit = get_post_meta( $object->ID, 'lc_podcast_explicit', true );
	$lc_podcast_captioned = get_post_meta( $object->ID, 'lc_podcast_captioned', true );
?>
     <p>
      <label for="lc_podcast_closed_captioned">
        <?php esc_html_e( 'Closed Captioned', 'lorainccc' ); ?>
        <input type="checkbox" id="lc_podcast_closed_captioned" name="lc_podcast_closed_captioned" <?php checked( $lc_podcast_captioned ); ?> />
      </label>
    </p>

    <p>
      <label for="lc_podcast_explicit_content">
        <?php esc_html_e( 'Explicit Content', 'lorainccc' ); ?>
        <select id="lc_podcast_explicit_content" name="lc_podcast_explicit_content">
          <option value="no"<?php selected( $lc_podcast_explicit, 'no' ); ?>><?php esc_html_e( 'No' ); ?></option>
          <option value="yes"<?php selected( $lc_podcast_explicit, 'yes' ); ?>><?php esc_html_e( 'Yes' ); ?></option>
          <option value="clean"<?php selected( $lc_podcast_explicit, 'clean' ); ?>><?php esc_html_e( 'Clean', 'lorainccc' ); ?></option>
        </select>
      </label>
    </p>

     <p>
       <label for="podcasting-enclosure-url"><?php esc_html_e( 'Podcast Audio', 'lorainccc' ); ?></label>
       <input type="text" id="podcasting-enclosure-url" name="podcast_enclosure_url" value="<?php echo esc_url( $lc_podcast_url ); ?>" size="35" />
       <input type="button" id="podcasting-enclosure-button" value="<?php esc_attr_e( 'Choose File', 'lorainccc' ); ?>" class="button"data-modal-title="<?php esc_attr_e( 'Podcast Audio File', 'lorainccc' ); ?>" data-modal-button="<?php esc_attr_e( 'Select this file' ); ?>" />
     </p>

    <?php

   }
   
/* Save the meta box's post metadata */
function lc_podcasts_save_info( $post_id, $post ) {

    /* Verify the nonce before proceeding */
    if ( !isset( $_POST['lc_podcasts_post_nonce'] ) || !wp_verify_nonce( $_POST['lc_podcasts_post_nonce'], basename( __FILE__ ) ) )
     return $post_id;
   
    /* Get the post type object */
    $post_type = get_post_type_object( $post->post_type );
   
    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
     return $post_id;
   
    /* Path Link Field */
    /* Get the posted data and sanitize it for use as a date value. */
    $new_meta_value = ( isset( $_POST['lc_podcasts_link_field'] ) ? sanitize_text_field($_POST['lc_podcasts_link_field'] ) : '' );
   
    /* Get the meta key. */
    $meta_key = 'lc_podcasts_link_field';
   
     /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post_id, $meta_key, true );
   
    update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
   
     /* Path Link Label Field */
    /* Get the posted data and sanitize it for use as a date value. */
    $new_meta_value = ( isset( $_POST['lc_podcasts_link_label_field'] ) ? sanitize_text_field($_POST['lc_podcasts_link_label_field'] ) : '' );
   
    /* Get the meta key. */
    $meta_key = 'lc_podcasts_link_label_field';
   
     /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post_id, $meta_key, true );
   
    update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

    if ( isset( $_POST['lc_podcast_closed_captioned'] ) && 'on' === $_POST['lc_podcast_closed_captioned'] ) {
      $lc_podcast_captioned = 1;
    }
  
    if ( isset( $_POST['lc_podcast_explicit_content'] ) && in_array( $_POST['lc_podcast_explicit_content'], array( 'yes', 'no', 'clean' ), true ) ) {
      $lc_podcast_explicit = sanitize_text_field( $_POST['lc_podcast_explicit_content'] );
    }

    $_post = wp_unslash( $_POST );

    if ( isset( $_post['podcast_enclosure_url'] ) && ! empty( $_post['podcast_enclosure_url'] ) ) {
      $url = sanitize_text_field( $_post['podcast_enclosure_url'] );
    } else {
      // Search for an audio shortcode to determine the audio enclosure url.
      $pattern = get_shortcode_regex();

      if (
        preg_match_all( '/' . $pattern . '/s', $post->post_content, $matches )
        && array_key_exists( 2, $matches )
        && in_array( 'audio', $matches[2], true )
      ){
        preg_match( '/.*mp3=\\"(.*)\\".*/', $matches[0][0], $matches2 );
        if ( isset( $matches2[1] ) ) {
          $url = $matches2[1];
        }
      }
    }

	/**
	 * Retrieve the enclosure and store its metadata in post meta.
	 *
	 * @todo only retrieve enclosure metadata when a podcasting term id is selected and the url has changed.
	 */
	if ( $url ) {
		$lc_podcast_meta = lc_get_podcast_meta_from_url( $url );

		if ( ! empty( $lc_podcast_meta ) ) {

      // Save Podcast Audio File URL

      /* New Meta Value */
      $new_meta_value = $lc_podcast_meta['url'];

      /* Get the meta key. */
      $meta_key = 'lc_podcast_url';

      /* Get the meta value of the custom field key. */
      $meta_value = get_post_meta($post_id, $meta_key, true );

			update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

      /* 
       * Save Podcast Audio File URL, File Size and Mime Type to enclosure custom field
       * Allows WordPress RSS Enclosure function to include the audio file.
       * All three fields are required to be saved on seperate lines.
       */ 

      /* Get the meta key. */
      $meta_key = 'enclosure';
      $new_meta_value .= "\n" . $lc_podcast_meta['filesize'] . "\n" . $lc_podcast_meta['mime'];
			update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

      // Save Podcast Audio File Size

      /* New Meta Value */
      $new_meta_value =  $lc_podcast_meta['filesize'];

      /* Get the meta key. */
      $meta_key = 'lc_podcast_filesize';

      /* Get the meta value of the custom field key. */
      $meta_value = get_post_meta($post_id, $meta_key, true );

      update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

      // Save Podcast Audio File Duration

      /* New Meta Value */
      $new_meta_value = $lc_podcast_meta['duration'];

      /* Get the meta key. */
      $meta_key = 'lc_podcast_duration';

      /* Get the meta value of the custom field key. */
      $meta_value = get_post_meta($post_id, $meta_key, true );
           
      update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
      
      // Save Podcast Audio File Mime Type

      /* New Meta Value */
      $new_meta_value = $lc_podcast_meta['mime'];

      /* Get the meta key. */
      $meta_key = 'lc_podcast_mime';

      /* Get the meta value of the custom field key. */
      $meta_value = get_post_meta($post_id, $meta_key, true );

      update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
		}
  }
    // Save Podcast Explicit Setting

    /* New Meta Value */
    $new_meta_value =  $lc_podcast_explicit;

    /* Get the meta key. */
    $meta_key = 'lc_podcast_explicit';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post_id, $meta_key, true );

    update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

    // Save Podcast Captioned Setting

    /* New Meta Value */
    $new_meta_value =  $lc_podcast_captioned;

    /* Get the meta key. */
    $meta_key = 'lc_podcast_captioned';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post_id, $meta_key, true );

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