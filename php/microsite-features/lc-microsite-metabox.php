<?php 

/*
		*	Code adapted from https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress
		*	Created July 2016.
		*
		*/

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'lc_microsite_features_meta_boxes_setup' );
add_action( 'load-post-new.php', 'lc_microsite_features_meta_boxes_setup' );

/* Meta box setup function */
function lc_microsite_features_meta_boxes_setup() {
 /* Add meta boxes on the 'add_meta_boxes' hook. */
 add_action( 'add_meta_boxes', 'lc_add_microsite_features_meta_box' );

 /* Save post meta on the 'save_post' hook. */
 add_action( 'save_post', 'lc_microsite_features_save_info', 10, 2 );
}


/* Create one or meta boxes to be displayed on the post editor screen */
function lc_add_microsite_features_meta_box() {
 add_meta_box(
  'lc_microsite_features_metabox',                                    // Unique ID (ID of Div Tag ** Note: DO NOT NAME same as field(s) below **)
  esc_html__( 'LCCC Microsite Features', 'lorainccc' ),               // Title & Text Domain
  'lc_show_microsite_features_meta_box',                              // Callback function
  'page',                                                             // Admin Page or Post Type
  'side',                                                           // Context (Position)
  'default'                                                           // Priority
 );
}

/* Display the post meta box */
function lc_show_microsite_features_meta_box( $object, $box ) { ?>

<?php wp_nonce_field( basename( __FILE__ ), 'lc_microsite_features_nonce' ); ?>

<p>Currently these features only work with the Gateway Template or Grouped Content Template</p>

<label for="lc_microsite_enable_badges"><?php _e( 'Enable Badges: ', 'lorainccc' ); ?></label><br>
<?php 

    $lcEnableBadges = get_post_meta( $object->ID, 'lc_microsite_enable_badges' , true);

        ?>
    <label class="switch">
        <input type="checkbox" name='lc_microsite_enable_badges' <?php checked( $lcEnableBadges, 1); ?> value='1' style="display:none;">
        <div class="slider round"></div>
    </label>
    <p class="description" id="tagline-description">Enables Badge Sidebar Display. Badges will show at the bottom of the page template, above the footer.</p>

    <label for="lc_microsite_enable_top_button_menu"><?php _e( 'Enable Top Button Menu: ', 'lorainccc' ); ?></label><br>
<?php 

    $lcEnableTopButtonMenu = get_post_meta( $object->ID, 'lc_microsite_enable_top_button_menu' , true);

        ?>
    <label class="switch">
        <input type="checkbox" name='lc_microsite_enable_top_button_menu' <?php checked( $lcEnableTopButtonMenu, 1); ?> value='1' style="display:none;">
        <div class="slider round"></div>
    </label>
    <p class="description" id="tagline-description">Enables Top Button Menu Display.</p>

    <label for="lc_microsite_enable_secondary_top_menu"><?php _e( 'Enable Secondary Top Menu: ', 'lorainccc' ); ?></label><br>
<?php 

    $lcEnableSecondaryTopMenu = get_post_meta( $object->ID, 'lc_microsite_enable_secondary_top_menu' , true);

        ?>
    <label class="switch">
        <input type="checkbox" name='lc_microsite_enable_secondary_top_menu' <?php checked( $lcEnableSecondaryTopMenu, 1); ?> value='1' style="display:none;">
        <div class="slider round"></div>
    </label>
    <p class="description" id="tagline-description">Enables Secondary Top Menu Display.</p>
 
    <label for="lc_microsite_grouping_category"><?php _e( 'Category of Content Items: ', 'lorainccc' ); ?></label><br>
    <select id="lc_podcast_explicit_content" name="lc_podcast_explicit_content">
          
    <?php 

    $lcCategoryContentItems = get_post_meta( $object->ID, 'lc_microsite_grouping_category' , true);

    $lc_categories = get_categories();
    foreach( $lc_categories as $category ) {

        echo "<option value='" . $category->slug . "'" . selected( $lcCategoryContentItems, $category->slug ) . ">" . $category->name . "</option>";
    }

        ?>

    </select>

    <p class="description" id="tagline-description">Category of Content Items allows a grouping of content to be displayed as a list in the template.</p>
    
<?php

}

/* Save the meta box's post metadata */
function lc_microsite_features_save_info( $post_id, $post ) {

    /* Verify the nonce before proceeding */
    if ( !isset( $_POST['lc_microsite_features_nonce'] ) || !wp_verify_nonce( $_POST['lc_microsite_features_nonce'], basename( __FILE__ ) ) )
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


    /* Enable Top Button Menu Option */
    /* Get the posted data and sanitize it for use as a date value. */
    $new_meta_value = ( isset( $_POST['lc_microsite_enable_top_button_menu'] ) ? sanitize_text_field($_POST['lc_microsite_enable_top_button_menu'] ) : '' );
   
    /* Get the meta key. */
    $meta_key = 'lc_microsite_enable_top_button_menu';
   
     /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta ($post_id, $meta_key, true );
   
    update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

    /* Enable Top Secondary Menu Option */
    /* Get the posted data and sanitize it for use as a date value. */
    $new_meta_value = ( isset( $_POST['lc_microsite_enable_secondary_top_menu'] ) ? sanitize_text_field($_POST['lc_microsite_enable_secondary_top_menu'] ) : '' );
   
    /* Get the meta key. */
    $meta_key = 'lc_microsite_enable_secondary_top_menu';
   
     /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta ($post_id, $meta_key, true );
   
    update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

}


function update_microsite_features_meta_values( $post_id, $meta_key, $new_meta_value, $meta_value ) {

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