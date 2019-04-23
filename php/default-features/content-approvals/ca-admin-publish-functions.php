<?php

class lc_admin_publishfunctions{
	
	function lc_admin_publishfunctions() {
	
		//Post Update Functions	
		add_action( 'save_post', array($this, 'lc_post_update'), 10 );
		add_action( 'publish_future_post', array($this, 'lc_post_update'), 10);
		
	}

	function lc_post_update($id){
		
				$current_post_id = $id;
		
		$_lc_publishedId = get_post_meta($current_post_id, '_lc_publishedId', true);
		
			if($_lc_publishedId != false){

				//if( $_REQUEST['save'] == 'Publish' && $_REQUEST['post_status'] == 'publish' ) {
				if (isset($_REQUEST['publish'])) {
					
					$lc_updatePost = array(
							'ID' => $_lc_publishedId,
							'menu_order' => $_REQUEST['menu_order'],
							'comment_status' => ($_REQUEST['comment_status'] == 'open' ? 'open' : 'closed'),
							'ping_status' => ($_REQUEST['ping_status'] == 'open' ? 'open' : 'closed'),
							'post_author' => $_REQUEST['post_author'],
							'post_category' => (isset($_REQUEST['post_category']) ? $_REQUEST['post_category'] : array()),
							'tax_input'=> (isset($_REQUEST['tax_input']) ? $_REQUEST['tax_input'] : array()),
							'post_content' => $_REQUEST['content'],
							'post_excerpt' => $_REQUEST['excerpt'],
							'post_parent' => $_REQUEST['parent_id'],
							'post_password' => $_REQUEST['post_password'],
							'post_status' => 'publish',
							'post_title' => $_REQUEST['post_title'],
							'post_type' => $_REQUEST['post_type'],
							'tags_input' => (isset($_REQUEST['tax_input']['post_tag']) ? $_REQUEST['tax_input']['post_tag'] : ''),
     						'page_template' => $_REQUEST['page_template'],
							'thumbnail' => $_REQUEST['thumbnail']   
					);

					// Insert Post into Database
					wp_update_post($lc_updatePost);

										//Clear existing Meta Data
					$lc_existing = get_post_custom($_lc_publishedId);
					foreach ($lc_existing as $ekey => $evalue) {
						delete_post_meta($_lc_publishedId, $ekey);
					}

					// Add Post Meta from draft post
					$custom = get_post_custom($current_post_id);
					foreach ($custom as $ckey => $cvalue) {
						if ($ckey != '_edit_lock' && $ckey != '_edit_last' && $ckey != '_lc_publishedId') {
							foreach ($cvalue as $mvalue) {
								add_post_meta($_lc_publishedId, $ckey, $mvalue, true);
							}
						}
					}
					
					//Delete Draft Post, forcing delete since 2.9, no sending to trash_comment
					wp_delete_post($current_post_id, true);
		
					// Send user to new edit page
					wp_redirect(admin_url('post.php?action=edit&post=' . $_lc_publishedId));
					exit();
					
			}

		}
	
	}
}
	add_action('init', function() {
		global $lc_admin_publishfunctions; $lc_admin_publishfunctions = new lc_admin_publishfunctions();
	});

?>