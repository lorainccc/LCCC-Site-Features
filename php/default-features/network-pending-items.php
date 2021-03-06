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

   if($site->path == '/athletics/'){
    
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
    
   }
   
   // Switch back to root
   restore_current_blog();
   echo '</div>';
  }
}
?>