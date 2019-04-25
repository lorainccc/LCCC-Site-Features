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
    if( ( 'post' == get_post_type() || 'page' == get_post_type() || 'lccc_announcement' == get_post_type() || 'lccc_events' == get_post_type() ) && $text == 'Update'  ){
     return 'Save as Draft';
    }  else {
     return $translation;
    }
    if ( ( 'post' == get_post_type() || 'page' == get_post_type() || 'lccc_announcement' == get_post_type() || 'lccc_events' == get_post_type() ) && $text  == 'Publish' ) {
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
		
		echo "------ Postarr -------\n\n";
		echo "<pre>";
   var_dump($postarr);
		echo "</pre>";
  echo "\n\n";
  echo "------ data -------\n\n";
		echo "<pre>";
   var_dump($data);
	 echo "</pre>";
  echo "\n\n";
 }

//add_action('wp_insert_post_data', 'lc_dup_wp_insert_post', 15, 2);

 


 function lc_newpage_admin_notice(){

  global $pagenow;
		global $post;
		
		if ( $pagenow == 'post-new.php' ){

   echo '<div class="notice notice-info">';
   echo '  <p>Click save draft to continue working on this page.  Clicking Submit for Review will notify the Admins to review the page and approve it.</p>';
   echo '</div>';
  }

  if ( $pagenow == 'post.php' ){
			if (get_post_status($post->ID) == 'draft' ){
				if (get_post_meta($post->ID, '_lc_publishedId') != '' ){
					$published_post = get_post_meta($post->ID, '_lc_publishedId', true);
					
					
					echo '<div class="notice notice-error">';
					echo ' <p>Click save draft to continue working on this page.    <a href="'. get_permalink($published_post) .'" target="_blank">Click here to view the currently published page</a>.<ul style="list-style-type: disc; margin: 0 0 0 30px;"><li>Click the "Save Draft" button to continue saving changes.</li><li>Click the "Submit for Review" button when you are ready for the admins to review your changes.</li></ul></p>';
					echo '</div>';
				} else {
					echo '<div class="notice notice-info">';
					echo ' <p>Click save draft to continue working on this page.  Clicking Submit for Review will notify the Admins to review the page and approve it.</p>';
					echo '</div>';
				}
			}
			if (get_post_status($post->ID) == 'pending' ){
					echo '<div class="notice notice-warning">';
					echo ' <p>This page is currently pending approval.  The admins have been notified.</p>';
					echo '</div>';
			}
			if (get_post_status($post->ID) == 'publish' ){
    echo '<div class="notice notice-info">';
    echo ' <p><strong>Editing this page will result in creating a duplicate for review.</strong>  When approved the page content will be added to the published post, and this copy will be deleted.</p>';
    echo '</div>';
			}
  }

 }

add_action( 'admin_notices', 'lc_newpage_admin_notice' );



?>