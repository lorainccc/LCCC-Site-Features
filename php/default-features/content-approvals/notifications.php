<?php

 add_action('transition_post_status', 'lc_approval_notify', 10, 3);

	function lc_approval_notify($new, $old, $post){
		if ( ( $new == 'pending' ) ){
			
			//Retreive list of super admins in the network.
			$admins = get_super_admins();
			
			for ($i = 0; $i <=count($admins); $i++){
			
				$user = get_user_by( 'slug', $admins[$i]);
				$notify = get_user_meta( $user->ID, 'postnotice', true );
				
				if( $notify === 'yes' ){
				
				$site_title = get_bloginfo( 'name' );

				$to = $user->user_email;
				
				$subject = '[' . $site_title . '] Page Pending Approval';

				$current_user = wp_get_current_user();

				$edit_page_url = get_bloginfo( 'url' );
				$edit_page_url = $edit_page_url . '/wp-admin/post.php?action=edit&post=' . $post->ID;

				if( $current_user->user_firstname != '' ){
					$submitted_by = $current_user->user_firstname . ' ' . $current_user->user_lastname;
				}else{
					$submitted_by = $current_user->user_login;
				}
										
				$body = '<img src="http://www.lorainccc.edu/wp-content/themes/lorainccc/images/LCCC-Logo.png" style="width:285px; height:59px;"><br/><h1 style="font-size: 16pt;font-family:sans-serif;">Page Approval Notice</h1><p style="font-size: 12pt;font-family:sans-serif;">A pending revision to the Page "' . $post->post_title . '" </p><p style="font-size: 12pt;font-family:sans-serif;">It was submitted by ' . $submitted_by . '.</p><p style="font-size: 12pt;font-family:sans-serif;">Review it here:<a href="' . $edit_page_url . '" target="_blank">' . $edit_page_url . '</a></p>';

				$headers = array('Content-Type: text/html; charset=UTF-8');

				wp_mail( $to, $subject, $body, $headers );
				}
			}
		}elseif( ($old == 'pending' && $new == 'publish' ) ){
			
					$author_id = $post->post_author;

					$author = get_user_by( 'id', $author_id );

					$site_title = get_bloginfo( 'name' );

					$to = $author->user_email;

					$subject = '[' . $site_title . '] Page Approved';

					$body = '<img src="http://www.lorainccc.edu/wp-content/themes/lorainccc/images/LCCC-Logo.png" style="width:285px; height:59px;"><br/><h1 style="font-size: 16pt;font-family:sans-serif;">Page Approval Notice</h1><p style="font-size: 12pt;font-family:sans-serif;">Your revision to, "' . $post->post_title . '", has been approved.</p>';

					$headers = array('Content-Type: text/html; charset=UTF-8');

					wp_mail( $to, $subject, $body, $headers );
			
		}
	}

?>