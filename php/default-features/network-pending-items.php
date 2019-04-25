<?php

// LCCC Pending Items Network Wide

 add_action( 'network_admin_menu', 'lc_add_pending_items_network_page' );

 function lc_add_pending_items_network_page(){
  add_menu_page(
  "LCCC Pending Items",                                               // Page Title
  "Pending Items",                                                    // Menu Title
  'manage_network_options',                                           // Capabilities
  'lccc-pending-items',                                               // Menu Slug
  'lc_pending_items_page',                                            // Function
  plugins_url( 'lccc-site-features/assets/images/lccc-block.png' ),   // Icon URL
  2                                                                   // Position (2 = Dashboard)
 );
	 add_submenu_page(
		'lccc-pending-items',																																															// Parent Slug (Page to nest under)
  __( 'Draft Items', 'lorainccc' ),   																																// Page Title
  'Draft Items',                                                 					// Menu Title
  'manage_network_options',                                           // Capabilities
  'lc-network-draft-items',                                           // Menu Slug
  'lc_network_draft_items_list'                                     		// Function
 );
	 add_submenu_page(
		'lccc-pending-items',																																															// Parent Slug (Page to nest under)
  __( 'Content Age', 'lorainccc' ),   																																// Page Title
  'Page Content Age',                                                 // Menu Title
  'manage_network_options',                                           // Capabilities
  'lc-network-content-age',                                           // Menu Slug
  'lc_network_content_age_list'                                     		// Function
 );
/*		add_submenu_page(
		'lccc-pending-items',																																															// Parent Slug (Page to nest under)
  __( 'PDF List', 'lorainccc' ),   																																			// Page Title
  'PDF File List',                                                 			// Menu Title
  'manage_network_options',                                           // Capabilities
  'lc-network-pdf-file-list',                                         // Menu Slug
  'lc_network_pdf_file_list'                                     					// Function
 );*/
 }

function lc_pending_items_page() {

 echo '<h1>List of pending items on the LCCC Website</h1>';

 // Get a list of all sites in the network
 $sites = get_sites();

  // Iterate through each site and find all pages.
  foreach ( $sites as $site ){

    switch_to_blog( $site->blog_id );
    echo '<div style="width: 520px; float:left; margin:10px; padding: 0 3px 0 3px; border-bottom: 1px solid #a0a0a0;">';
    // Print site name
    echo '<h2>' . $site->blogname . '</h2>';
   ;

    // Get Pending Pages
    $pending_items = get_pages(
     array(
      'post_status' => 'pending',
     )
    );

   $pending_items_count = count($pending_items);

   if ($pending_items_count != 0){
    echo '<p style="font-weight:600;">Pending Pages:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($pending_items as $pending_item) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_item->ID . '&action=edit" target="_blank">' . $pending_item->post_title . '</a></li>';
    }
    echo '</ul>';
   }

   // Get Pending Badges
   $pending_badges = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'badges',
    )
   );

   $pending_badges_count = count($pending_badges);

   if ($pending_badges_count != 0){
    echo '<p style="font-weight:600;">Pending Badges:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($pending_badges as $pending_badge) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_badge->ID . '&action=edit" target="_blank">' . $pending_badge->post_title . '</a></li>';
    }
    echo '</ul>';
   }

   // Get Pending Announcements
   $pending_announcements = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'lccc_announcement',
    )
   );

   $pending_announcements_count = count($pending_announcements);

   if ($pending_announcements_count != 0){
    echo '<p style="font-weight:600;">Pending Announcements:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($pending_announcements as $pending_announcement) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_announcement->ID . '&action=edit" target="_blank">' . $pending_announcement->post_title . '</a></li>';
    }
    echo '</ul>';
   }
   
   // Get Pending Events
   $pending_events = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'lccc_events',
    )
   );

   $pending_events_count = count($pending_events);

   if ($pending_events_count != 0){
    echo '<p style="font-weight:600;">Pending Events:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($pending_events as $pending_event) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_event->ID . '&action=edit" target="_blank">' . $pending_event->post_title . '</a></li>';
    }
    echo '</ul>';
   }

   // Get Pending Revisions
   $pending_revisions = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'revision',
    )
   );

   $pending_revisions_count = count($pending_revisions);

   if ($pending_revisions_count != 0){
    echo '<p style="font-weight:600;">Pending Revisions:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($pending_revisions as $pending_revision) {
     echo '<li><a href="' . admin_url() . 'admin.php?page=rvy-revisions&action=view&revision=' . $pending_revision->ID . '" target="_blank">' . $pending_revision->post_title . '</a></li>';
    }
    echo '</ul>';
   }
	
 if($site->path == '/security/'){ // Begin check for security site.
				
			// Get Crime Log
   $pending_crimelog = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'crime_log',
    )
   );

   $pending_crimelog_count = count($pending_crimelog);
		
				
   if ($pending_crimelog_count != 0){
    echo '<p style="font-weight:600;">Pending Crime Logs:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($pending_crimelog as $pending_log) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_log->ID . '&action=edit" target="_blank">' . $pending_log->post_title . '</a></li>';
    }
    echo '</ul>';
   }
	} // End Check for Security Site

   if($site->path == '/athletics/'){  // Begin check for Athletics Site
    
   // Get Pending Rosters
   $pending_players = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'lccc_player',
    )
   );

   $pending_players_count = count($pending_players);

   if ($pending_players_count != 0){
    echo '<p style="font-weight:600;">Pending Players:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($pending_players as $pending_player) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_player->ID . '&action=edit" target="_blank">' . $pending_player->post_title . '</a></li>';
    }
    echo '</ul>';
   }
    
    // Get Pending Sponsors
   $pending_sponsors = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'sponsor',
    )
   );

   $pending_sponsors_count = count($pending_sponsors);

   if ($pending_sponsors_count != 0){
    echo '<p style="font-weight:600;">Pending Sponsors:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($pending_sponsors as $pending_sponsor) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_sponsor->ID . '&action=edit" target="_blank">' . $pending_sponsor->post_title . '</a></li>';
    }
    echo '</ul>';
   }
 } // End Check for Athletics Site
   
   // Switch back to root
   restore_current_blog();
   echo '</div>';
  }
}

function lc_network_draft_items_list() {

 echo '<h1>List of draft items on the LCCC Website</h1>';

 // Get a list of all sites in the network
 $sites = get_sites();

  // Iterate through each site and find all pages.
  foreach ( $sites as $site ){

    switch_to_blog( $site->blog_id );
    echo '<div style="width: 520px; float:left; margin:10px; padding: 0 3px 0 3px; border-bottom: 1px solid #a0a0a0;">';
    // Print site name
    echo '<h2>' . $site->blogname . '</h2>';
   ;

    // Get Draft Pages
    $draft_items = get_pages(
     array(
      'post_status' => 'draft',
     )
    );

   $draft_items_count = count($draft_items);

   if ($draft_items_count != 0){
    echo '<p style="font-weight:600;">Draft Pages:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($draft_items as $draft_item) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $draft_item->ID . '&action=edit" target="_blank">' . $draft_item->post_title . '</a></li>';
    }
    echo '</ul>';
   }

   // Get Draft Badges
   $draft_badges = get_posts(
    array(
     'post_status' => 'draft',
     'post_type'   => 'badges',
    )
   );

   $draft_badges_count = count($draft_badges);

   if ($draft_badges_count != 0){
    echo '<p style="font-weight:600;">Draft Badges:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($draft_badges as $draft_badge) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $draft_badge->ID . '&action=edit" target="_blank">' . $draft_badge->post_title . '</a></li>';
    }
    echo '</ul>';
   }

   // Get Draft Announcements
   $draft_announcements = get_posts(
    array(
     'post_status' => 'draft',
     'post_type'   => 'lccc_announcement',
    )
   );

   $draft_announcements_count = count($draft_announcements);

   if ($draft_announcements_count != 0){
    echo '<p style="font-weight:600;">Draft Announcements:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($draft_announcements as $draft_announcement) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $draft_announcement->ID . '&action=edit" target="_blank">' . $draft_announcement->post_title . '</a></li>';
    }
    echo '</ul>';
   }
   
   // Get Draft Events
   $draft_events = get_posts(
    array(
     'post_status' => 'draft',
     'post_type'   => 'lccc_events',
    )
   );

   $draft_events_count = count($draft_events);

   if ($draft_events_count != 0){
    echo '<p style="font-weight:600;">Draft Events:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($draft_events as $draft_event) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $draft_event->ID . '&action=edit" target="_blank">' . $draft_event->post_title . '</a></li>';
    }
    echo '</ul>';
   }

   // Get Draft Revisions
   $draft_revisions = get_posts(
    array(
     'post_status' => 'draft',
     'post_type'   => 'revision',
    )
   );

   $draft_revisions_count = count($draft_revisions);

   if ($draft_revisions_count != 0){
    echo '<p style="font-weight:600;">Draft Revisions:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($draft_revisions as $draft_revision) {
     echo '<li><a href="' . admin_url() . 'admin.php?page=rvy-revisions&action=view&revision=' . $draft_revision->ID . '" target="_blank">' . $draft_revision->post_title . '</a></li>';
    }
    echo '</ul>';
   }
	
 if($site->path == '/security/'){ // Begin check for security site.
				
			// Get Crime Log
   $draft_crimelog = get_posts(
    array(
     'post_status' => 'draft',
     'post_type'   => 'crime_log',
    )
   );

   $draft_crimelog_count = count($draft_crimelog);
		
				
   if ($draft_crimelog_count != 0){
    echo '<p style="font-weight:600;">Draft Crime Logs:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($draft_crimelog as $draft_log) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $draft_log->ID . '&action=edit" target="_blank">' . $draft_log->post_title . '</a></li>';
    }
    echo '</ul>';
   }
	} // End Check for Security Site

   if($site->path == '/athletics/'){  // Begin check for Athletics Site
    
   // Get Draft Rosters
   $draft_players = get_posts(
    array(
     'post_status' => 'draft',
     'post_type'   => 'lccc_player',
    )
   );

   $draft_players_count = count($draft_players);

   if ($draft_players_count != 0){
    echo '<p style="font-weight:600;">Draft Players:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($draft_players as $draft_player) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $draft_player->ID . '&action=edit" target="_blank">' . $draft_player->post_title . '</a></li>';
    }
    echo '</ul>';
   }
    
    // Get Draft Sponsors
   $draft_sponsors = get_posts(
    array(
     'post_status' => 'draft',
     'post_type'   => 'sponsor',
    )
   );

   $draft_sponsors_count = count($draft_sponsors);

   if ($draft_sponsors_count != 0){
    echo '<p style="font-weight:600;">Draft Sponsors:</p>';
    echo '<ul style="list-style:disc;margin: 0 0 0 30px;">';
    foreach($draft_sponsors as $draft_sponsor) {
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $draft_sponsor->ID . '&action=edit" target="_blank">' . $draft_sponsor->post_title . '</a></li>';
    }
    echo '</ul>';
   }
 } // End Check for Athletics Site
   
   // Switch back to root
   restore_current_blog();
   echo '</div>';
  }
}


	//Site Content Age

function lc_network_content_age_list(){

	$count = 0;
	
	 // Get a list of all sites in the network
 $sites = get_sites([ 'orderby' => 'path', 'order' => 'ASC', ]);

  // Iterate through each site and find all pages.
  foreach ( $sites as $site ){

    switch_to_blog( $site->blog_id );
	   echo '<div style="width: 960px; margin:10px 20px 0 0; padding: 0 3px 0 3px;">';
    // Print site name
    echo '<h2>' . $site->blogname . '</h2>';
   
			
	$last_modified = get_posts(
    array(
     'post_status' 			=> 'publish',
     'post_type'  			 => 'page',
					'posts_per_page' => -1,
					'orderby'								=> 'modified',
					'order'										=>	'ASC',
    )
   );
	
	$last_modified_count = count($last_modified);
	?>

		<div class="modified-row">
			<div style="width:20%;float:left;font-weight:bold;">Page Title</div>
			<div style="width:50%;float:left;font-weight:bold;">URL</div>
			<div style="width:20%;float:left;font-weight:bold;">Last Modified</div>
			<div style="width:10%;float:left;font-weight:bold;">Content Age</div>
</div>

<?php
   if ($last_modified_count != 0){
    foreach($last_modified as $last_modified) {
					$modified_date = date_create($last_modified->post_modified);
					$age = compare_dates($last_modified->post_modified);
					if($age >= 2){
					echo '<div class="modified-row page-older">';
					} elseif($age >= 1) {
					echo '<div class="modified-row page-old">';
					} else {
					echo '<div class="modified-row">';
					}
					
					echo '<div style="width:20%;float:left;">' . $last_modified->post_title . '</div>';
					echo '<div style="width:50%;float:left;"><a href="' . get_permalink($last_modified->ID) . '" target="_blank">' . get_permalink($last_modified->ID) . '</a></div>';
					
					echo '<div style="width:20%;float:left;">' . date_format($modified_date, "m/d/Y") . '</div>';
					if($age != 0){
					echo '<div style="width:10%;float:left;">' . $age . '</div>';
					}
					echo '</div>';
					$count++;
    }
   }
	
	   // Switch back to root
   restore_current_blog();
   echo '</div>';
		}
			echo '<div style="margin: 40px 0 0 0;"><h3>Current number of published pages: ' . number_format($count, 0 , '', ',') . '</h3></div>';

}

function compare_dates($date1){
	  $date_parts1 = explode("-", $date1);
   $date_parts2 = date("Y");
   return $date_parts2 - $date_parts1[0];
}

?>