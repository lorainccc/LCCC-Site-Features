<?php

// LCCC Pending Items Network Wide

 add_action( 'network_admin_menu', 'lc_add_pending_items_network_page' );

 function lc_add_pending_items_network_page(){
  add_menu_page(
  "LCCC Pending Items",                                               // Page Title
  "Pending Items",                                                    // Menu Title
  'manage_options',                                                   // Capabilities
  'lccc-pending-items',                                               // Menu Slug
  'lc_pending_items_page',                                            // Function
  plugins_url( 'lccc-site-features/assets/images/lccc-block.png' ),  // Icon URL
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

    // Print site name
    echo '<h2>' . $site->blogname . '</h2>';

    $page_status = '';

    echo '<ul style="list-style: disc; margin: 0 0 0 25px;">';

    $pending_items = get_pages(
     array(
      'post_status' => 'pending',
     )
    );

   $pending_items_count = count($pending_items);

   if ($pending_items_count != 0){
    echo '<p>Pending Pages:</p>';
    foreach($pending_items as $pending_item) {
     echo '<a href="' . admin_url() . 'post.php?post=' . $pending_item->ID . '&action=edit" target="_blank">' . $pending_item->post_title . '</a><br />';
    }
    $page_status = true;
   }

   $pending_badges = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'badges',
    )
   );

   $pending_badges_count = count($pending_badges);

   if ($pending_badges_count != 0){
    echo '<p>Pending Badges:</p>';
    foreach($pending_badges as $pending_badge) {
     echo '<a href="' . admin_url() . 'post.php?post=' . $pending_badge->ID . '&action=edit" target="_blank">' . $pending_badge->post_title . '</a><br />';
    }
    $page_status = true;
   }

   $pending_announcements = get_posts(
    array(
     'post_status' => 'pending',
     'post_type'   => 'lccc_announcement',
    )
   );

   $pending_announcements_count = count($pending_announcements);

   if ($pending_announcements_count != 0){
    echo '<p>Pending Badges:</p>';
    foreach($pending_announcements as $pending_announcement) {
     echo '<a href="' . admin_url() . 'post.php?post=' . $pending_announcement->ID . '&action=edit" target="_blank">' . $pending_announcement->post_title . '</a><br />';
    }
    $page_status = true;
   }

   // If no pending items are found
   if($page_status == false){
     echo '<li>No Pending Items Found</li>';
    }
     echo '</ul>';

   // Switch back to root
   restore_current_blog();
  }

}
?>