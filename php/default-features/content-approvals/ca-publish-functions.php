<?php

class lc_publishfunctions{
	
	function lc_publishfunctions() {
	
		//Pre-Post Update Function	
		add_action( 'pre_post_update', array($this, 'lc_pre_post_update'), 10 );
		
	}
	
 function lc_pre_post_update($id){
  $current_user = wp_get_current_user();
  // If a post is previously published, but now an lccc editor or lccc advanced editor is looking to update it
  // we grab the post  and duplicate it and set it to pending.
		
  if( ($_REQUEST['save'] == 'Save as Draft' || $_REQUEST['save'] == 'Save Draft') && $_REQUEST['post_status'] == 'publish' ) {
				
   $lc_draftPost = array(
     'menu_order' => $_REQUEST['menu_order'],
     'comment_status' => ($_REQUEST['comment_status'] == 'open' ? 'open' : 'closed'),
				 'ping_status' => ($_REQUEST['ping_status'] == 'open' ? 'open' : 'closed'),
				 'post_author' => $current_user->ID,
         'post_category' => (isset($_REQUEST['post_category']) ? $_REQUEST['post_category'] : array()),
         'tax_input'=> (isset($_REQUEST['tax_input']) ? $_REQUEST['tax_input'] : array()),
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

			if($_REQUEST['_thumbnail_id'] <> ''){
				set_post_thumbnail( $newId, $_REQUEST['_thumbnail_id']);
			}

   // Add Post Meta Field to indicate this is a draft of a live page
   update_post_meta($newId, '_lc_publishedId', $id);
			
			if( ($_REQUEST['save'] == 'Save as Draft' || $_REQUEST['save'] == 'Save Draft') ) {
			// Send user to newly drafted page in editor
   wp_redirect(admin_url('post.php?action=edit&post=' . $newId));
			exit();
			}else{
			//Send user to list of posts or pages
			wp_redirect(admin_url('edit.php?post_type=' . $_REQUEST['post_type'] ));
   exit();
			}
  }
		
 }
	
}

add_action('init', function() {
  global $lc_publishfunctions; $lc_publishfunctions = new lc_publishfunctions();
});

?>