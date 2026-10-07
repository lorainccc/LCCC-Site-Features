<?php

function lc_create_draft_post( $postID = 0 ){

    if ( !$postID ) {
        $lc_draft_post = $_GET['lc_draft_post'];
        $lc_postID = $_GET['lcpostID'];
    }

    // 
    $lc_post = get_post( $lc_postID );

    $current_user = wp_get_current_user( $lc_post->ID );
  // If a post is previously published, but now an lccc editor or lccc advanced editor is looking to update it
  // we grab the post  and duplicate it and set it to pending.

     $lc_draftPost = array(
        'menu_order' => $lc_post->menu_order,
        'comment_status' => ( $lc_post->comment_status == 'open' ? 'open' : 'closed' ),
        'ping_status' => ( $lc_post->ping_status == 'open' ? 'open' : 'closed' ),
        'post_author' => $current_user->ID,
        'post_category' => (isset( $lc_post->post_category) ? $lc_post->post_category : array() ),
        'tax_input'=> ( isset($lc_post->tax_input) ? $lc_post->tax_input : array() ),
        'post_content' => $lc_post->post_content,
        'post_excerpt' => $lc_post->excerpt,
        'post_parent' => $lc_post->parent_id,
        'post_password' => $lc_post->post_password,
        'post_status' => 'draft',
        'post_title' => $lc_post->post_title,
        'post_type' => $lc_post->post_type,

        //'tags_input' => ( isset($lc_post['tax_input']['post_tag']) ? $lc_post['tax_input']['post_tag'] : '' ),
          
        'page_template' => $lc_post->page_template
    );
    
    // Insert Post into Database (Creating a new draft post)
    $lc_newId = wp_insert_post($lc_draftPost);
    
    $lc_post_meta = get_post_meta( $postID );
     
    // Add Post Meta from REQUEST object
    if( isset($lc_post_meta['meta']) ){
     foreach ( $lc_post_meta['meta'] as $key => $value ){
      if ($key != '_edit_lock' && $key != '_edit_last'){
       foreach ($value as $newvalue){
        add_post_meta($lc_newId, $key, $newvalue, true);
       }
      }
     }
    }
 

       if($lc_post->_thumbnail_id <> ''){
         set_post_thumbnail( $lc_newId, $lc_post->_thumbnail_id);
       }
 
       if($lc_post->post_type == 'lccc_events'){
 
         // Get the Post Meta
         $lc_post_meta = get_post_meta( $lc_postID );
         // Combine Array to an associative array, call positions by key name
         $lc_post_meta = array_combine(array_keys($lc_post_meta), array_column($lc_post_meta, '0'));
         
         if( count($lc_post_meta) > 0){
           add_post_meta($lc_newId, 'event_meta_box_stocker_spektrix_event_id', $lc_post_meta['event_meta_box_stocker_spektrix_event_id'], true);
           add_post_meta($lc_newId, 'event_meta_box_stocker_spektrix_event_instance_id', $lc_post_meta['event_meta_box_stocker_spektrix_event_instance_id'], true);
           add_post_meta($lc_newId, '_wp_old_slug', $lc_post_meta['_wp_old_slug'], true);
         }
       }
 
    // Add Post Meta Field to indicate this is a draft of a live page
    update_post_meta($lc_newId, '_lc_publishedId',$lc_postID);

    // Send user to newly drafted page in editor
    wp_redirect(admin_url('post.php?action=edit&post=' . $lc_newId));
    exit();
}  