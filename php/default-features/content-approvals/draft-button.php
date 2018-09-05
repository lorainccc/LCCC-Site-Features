<?php

 class lc_contentdrafts {
  
  function lc_contentdrafts(){
  
   
			// Admin head
			add_action('admin_head-post.php', array($this, 'adminHead'));

  }
  
  function adminHead () {
			global $post;

			// Only show on published pages
			if (in_array($post->post_type, array('post', 'page', 'lccc_announcement', 'lccc_events')) && $post->post_status == 'publish') {
				?>
				<script type="text/javascript">

					// Add save draft button to live pages
					jQuery(function($) {

						$('<input type="submit" class="button button-highlighted" tabindex="4" value="Save Draft" id="save-post" name="save">').prependTo('#save-action');

					});

				</script>
				<?php
			}

		}
				
 }

add_action('init', create_function('', 'global $lc_contentdrafts; $lc_contentdrafts = new lc_contentdrafts();'));

?>