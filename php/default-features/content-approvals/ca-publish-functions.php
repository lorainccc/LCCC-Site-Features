<?php

 /*
  *
  *
  */

 // Change publish/update button label
 // Filter for pages,
 // badges - post type: badges,
 // lccc-announcement- post type: lccc_announcement,
 // lccc-events- post type: lccc_events

 add_filter( 'gettext', 'lc_change_publish_button', 10, 2 );

 function lc_change_publish_button( $translation, $text ) {
    if( ( 'post' == get_post_type() || 'page' == get_post_type() || 'lccc_announcement' == get_post_type() ) && $text == 'Update'  ){
     return 'Save as Draft';
    }  else {
     return $translation;
    }
    if ( ( 'post' == get_post_type() || 'page' == get_post_type() ) && $text  == 'Publish' ) {
     return 'Submit for Review';
    } else {
     return $translation;
    }
 }

 // Filter wp_insert_post to status to pending review.
 // Filter for pages, badges, lccc-announcement, lccc-events
 // Add Email notification for new and updated posts

 function lc_dup_wp_insert_post($data, $postarr){

/*  if($data['post_type'] == 'post' || $data['post_type'] == 'page'){
   $postarr['post_status'] = 'pending';
   $data['post_status'] = 'pending';
   return $data;
  }*/

/*  if( ('lccc-event' == get_post_type() ) ){
  echo "------ Postarr -------\n\n";
  var_dump($postarr);
  echo "\n\n";
  echo "------ data -------\n\n";
  var_dump($data);
  echo "\n\n";
   }*/
 }

 //add_action('wp_insert_post_data', 'lc_dup_wp_insert_post', 15, 2);

 add_action( 'pre_post_update', array($this, 'lc_pre_post_update') );

 function lc_pre_post_update($id){
  /*if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
   return $id;

  if( !in_array( $_POST['post_type'], array('post', 'page') ) ){
   return $id;
  }
*/
  
  var_dump($_REQUEST);
  
  // If a post is previously published, but now an lccc editor or lccc advanced editor is looking to update it
  // we grab the post and duplicate it and set it to pending.
  
  if( $_REQUEST['save'] == 'Save Draft' && $_REQUEST['post_status'] == 'publish' ) {
   $lc_draftPost = array(
     'menu_order' => $_REQUEST['menu_order'],
     'comment_status' => ($_REQUEST['comment_status'] == 'open' ? 'open' : 'closed'),
				 'ping_status' => ($_REQUEST['ping_status'] == 'open' ? 'open' : 'closed'),
				 'post_author' => $_REQUEST['post_author'],
				 'post_category' => (isset($_REQUEST['post_category']) ? $_REQUEST['post_category'] : array()),
				 'post_content' => $_REQUEST['content'],
				 'post_excerpt' => $_REQUEST['excerpt'],
				 'post_parent' => $_REQUEST['parent_id'],
				 'post_password' => $_REQUEST['post_password'],
				 'post_status' => 'draft',
				 'post_title' => $_REQUEST['post_title'],
				 'post_type' => $_REQUEST['post_type'],
				 'tags_input' => (isset($_REQUEST['tax_input']['post_tag']) ? $_REQUEST['tax_input']['post_tag'] : ''),
     'page_template' => $_REQUEST['page_template']    
   );
   
   // Insert Post into Database (Creating a new draft post)
   $newId = wp_insert_post($lc_draftPost);
   
   // Add Post Meta from REQUEST object
   if( isset($_REQUEST['meta']) ){
    foreach ( $_REQUEST['meta'] as $key => $value ){
     if ($key != '_edit_lock' && $key != '_edit_last'){
      foreach ($value as $newvalue){
       add_post_meta($newId, $key, $newvalue, true);
      }
     }
    }
   }
   
   // Add Post Meta Field to indicate this is a draft of a live page
   update_post_meta($newId, '_lc_publishedId', $id);
   
   // Send user to new edit page
   wp_redirect(admin_url('post.php?action=edit&post=' . $newId));
   exit();
  }

 }

 /*function newpage_admin_notice(){

  global $pagenow;
  if ( $pagenow == 'post-new.php' ){
   echo '<div class="notice notice-info">';
   echo '  <p>Click save draft to continue working on this page.  Clicking Submit for Review will notify the Admins to review the page and approve it.</p>';
   echo '</div>';
  }

  if ( $pagenow == 'post.php' ){
   if ( get_post_meta($_GET["post"]->ID, 'lc_publishedID') != '' ){
    echo '<div class="notice notice-info">';
    echo ' <p>Click save draft to continue working on this page.  Clicking Submit for Review will notify the Admins to review the page and approve it.</p>';
    echo '</div>';
   } else {
    echo '<div class="notice notice-info">';
    echo ' <p><strong>Editing this page will result in creating a duplicate for review.</strong>  When approved the page content will be added to the published post, and this copy will be deleted.</p>';
    echo '</div>';
   }
  }

 }

add_action( 'admin_notices', 'newpage_admin_notice' );*/

?>