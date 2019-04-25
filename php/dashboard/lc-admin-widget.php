<?php
// LCCC Dashboard Widget
// Displays posts/pages last modified more than 6 months ago

add_action('wp_dashboard_setup', 'lc_admin_dashboard_widget');
 
function lc_admin_dashboard_widget() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('lc_dashboard_admin_widget', 'Web Site Information', 'lc_dashboard_admin_widget');
		 // Globalize the metaboxes array, this holds all the widgets for wp-admin
	 
		 global $wp_meta_boxes;
		 
		 // Get the regular dashboard widgets array 
		 // (which has our new widget already but at the end)
	 
		 $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
		 
		 // Backup and delete our new dashboard widget from the end of the array
		
		 $lc_widget_backup = array( 'lc_dashboard_admin_widget' => $normal_dashboard['lc_dashboard_admin_widget'] );
		 unset( $normal_dashboard['lc_dashboard_admin_widget'] );
	 
		 // Merge the two arrays together so our widget is at the beginning
	 
		 $sorted_dashboard = array_merge( $lc_widget_backup, $normal_dashboard );
	 
		 // Save the sorted array back into the original metaboxes 
	 
		 $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
	}

	function lc_dashboard_admin_widget() {
		
		$current_user_id = get_current_user_id();
		$current_user = get_userdata($current_user_id);

		echo '<img src="' . plugins_url( '../images/LCCC-Logo.png', dirname(__FILE__) ) . '" style="width:250px; margin: 20px; float:right;" alt="LCCC Logo">';
		echo '<h1>Welcome! ' . $current_user->first_name . '</h1>';
		echo '<p><strong>Need help? <br />Please contact either</strong>
		<ul style="list-style: disc; margin: 0 0 0 40px;">
		<li> Content: <strong>Lori Martin</strong> at <a href="mailto:lmartin@lorainccc.edu">lmartin@lorainccc.edu</a> or ext 7070.</li>
		<li> Techical: <strong>Joe Querin</strong> at <a href="mailto:jquerin@lorainccc.edu">jquerin@lorainccc.edu</a> or ext 7060.</li>		
		</ul>
		<br/>
		</p>';

		if( !is_super_admin( $current_user_id ) ){
			$users_last_modified_count = 0;

			$users_last_modified = get_posts(
			array(
			 'post_status'		=>	'publish',
			 'post_type'			=>	'page',
			 'posts_per_page'	=>	-1,
			 'orderby'				=>	'modified',
			 'order'					=>	'ASC',
			 'author'					=>  $current_user_id,
			)
		 );

		 $users_last_modified_count = count($users_last_modified);

if( $users_last_modified_count != 0 ) {
	?>
 		<h2>Content Page Age</h2>
		<p>The list below displays pages belonging to you that have not been updated for a long time.
				<ul style="list-style: disc; margin: 0 0 0 40px;">
					<li>Content Pages listed in bold red text is extremely old</li>
					<li>Content Pages listed in orange text is almost 6 months old</li>
					<li>Content Pages listed in plain text is 3 months old or newer.</li>
				</ul>
		</p>
<?php
		}

	} elseif( is_super_admin( $current_user_id ) ) {
	  $users_last_modified_count = 0;

		$users_last_modified = get_posts(
			array(
			 'post_status'		=>	'publish',
			 'post_type'			=>	'page',
			 'posts_per_page'	=>	-1,
			 'orderby'				=>	'modified',
			 'order'					=>	'ASC',
			)
		 );

		 $users_last_modified_count = count($users_last_modified);

if( $users_last_modified_count != 0 ) { ?>
		<h2>Content Page Age</h2>
		<p>The list below displays pages that have not been updated for a long time.
				<ul style="list-style: disc; margin: 0 0 0 40px;">
					<li>Content Pages listed in bold red text is extremely old</li>
					<li>Content Pages listed in orange text is almost 6 months old</li>
					<li>Content Pages listed in plain text is 3 months old or newer.</li>
				</ul>	
		</p>

<?php } 
	}
?>

 		<div class="widget-modified-row">
			<div style="width:20%;float:left;font-weight:bold; padding:0 3px;">Page Title</div>
			<div style="width:55%;float:left;font-weight:bold; padding:0 3px;">URL</div>
			<div style="width:20%;float:left;font-weight:bold; padding:0 3px;">Last Modified</div>
		</div>
    <span style="display:inline-block;">
	<?php
	foreach($users_last_modified as $users_last_modified) {
		$modified_date = date_create($users_last_modified->post_modified);
		$current_date = date_create(date());

		$interval = $modified_date->diff($current_date);
		$num_days = $interval->format('%a');

		$last_modified_user = get_userdata($users_last_modified->_edit_last);
		
		$user_name = $last_modified_user->user_firstname . ' ' . $last_modified_user->user_lastname;
		if($user_name === " "){
			$user_name = $last_modified_user->user_nicename;
		}

		if( ($num_days) > 180 ) {
			echo '<span class="widget-modified-row page-older">';
		} elseif( ($num_days) < 180 && ($num_days) > 90 ) {
			echo '<span class="widget-modified-row page-old">';
		} elseif( ($num_days) < 90 ) {
			echo '<span class="widget-modified-row">';
		}
	echo '<span style="width:20%;float:left; padding:0 3px;">' . $users_last_modified->post_title . '</span>';
		echo '<span style="width:55%;float:left; border-left:solid 1px #7a7a7a; border-right:solid 1px #7a7a7a; padding:0 3px;">' . get_permalink($users_last_modified->ID) . ' - <a href="' . admin_url() . 'post.php?post=' . $users_last_modified->ID . '&action=edit" target="_blank">Edit</a></span>';
		echo '<span style="width:20%;float:left; padding:0 3px;">' . date_format($modified_date, "m/d/Y") . '<br/>' . $user_name . '</span>';
		echo '</span>';
	}
	?>
    </span>
	<?php
}