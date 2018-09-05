<?php

function lc_editor_admin_notice(){
	 global $pagenow;
		global $post;
	
				$published_post = get_post_meta($post->ID, '_lc_publishedId', true);

//	echo 'Published Post ID: ' . $published_post;
//	echo '<br/>';
//	echo 'Currenty Post ID: ' . $post->ID;
	
	 if ( $pagenow == 'post.php' ){
			if (get_post_status($post->ID) == 'draft' ){

				if ( $published_post != '' ){
					echo '<div class="notice notice-error">';
					echo ' <p><strong>This page is a draft of a live page.</strong>  <a href="'. get_permalink($published_post) .'" target="_blank">Click here to view the currently published page</a>.<ul style="list-style-type: disc; margin: 0 0 0 30px;"><li>To replace the currently published page with this version, click the "Publish" button.</li><li>To make changes and publish later,click the "Save Draft" button.</li></ul>';
					echo '</div>';
				} else {
					echo '<div class="notice notice-info">';
					echo ' <p>Click save draft to continue working on this page.  Clicking Publish will publish the post and approve it.</p>';
					echo '</div>';
				}
				
			}elseif(get_post_status($post->ID) == 'pending') {
					
				if ( $published_post != '' ){
					echo '<div class="notice notice-error">';
					echo ' <p><strong>This page is a pending version of a live page.</strong>  <a href="'. get_permalink($published_post) .'" target="_blank">Click here to view the currently published page</a>.<ul style="list-style-type: disc; margin: 0 0 0 30px;"><li>To replace the currently published page with this version, click the "Publish" button.</li><li>To make changes and publish later, click the "Save as Pending" button.</li></ul></p>';
					echo '</div>';
				} else {
					echo '<div class="notice notice-info">';
					echo ' <p>Click save as pending to continue working on this page.  Clicking Publish will publish the post and approve it.</p>';
					echo '</div>';
				}
				
			}			
		}
	
}

add_action( 'admin_notices', 'lc_editor_admin_notice' );

?>