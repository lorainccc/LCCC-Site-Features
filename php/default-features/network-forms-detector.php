<?php

 // LCCC Forms Detector Network Wide

 add_action( 'network_admin_menu', 'lc_add_forms_detector_network_page' );

 function lc_add_forms_detector_network_page(){
  add_submenu_page(
   'sites.php',                     // Parent Slug (File name of the standard WordPress admin Page)
   'LCCC Network Forms List',       // Page Title
   'LCCC Forms List',               // Menu Title
   'manage_network_options',        // Capability
   'lc_network_forms_list',         // Menu Slug
   'lc_display_network_forms'       // Callback Function
  );
 }

 function lc_display_network_forms(){

  echo '<h1>List of forms on the LCCC Website</h1>';
  
  $countForms = 0;
  
  $sites = get_sites();
  //$page_links = '';
  //$form_links = '';

   foreach ( $sites as $site ){
    switch_to_blog( $site->blog_id );
    
    $form_content = false;
    
    echo '<h2>' . $site->blogname . '</h2>';
        
    $page_ids = get_all_page_ids();
     echo '<ul style="list-style: disc; margin: 0 0 0 25px;">';
    
    foreach( $page_ids as $page ){
     $form = get_post_meta( $page, '_FirmstepRRCUrl', true );

     if ($form != ''){
       echo '<li><a href="'. admin_url() .'post.php?post=' . $page . '&action=edit" target="_blank">'  . get_the_title( $page ) . '</a> - <a href="' . get_permalink( $page ) . '" target="_blank">View Page</a> - <a href="http://lorainccc.firmstep.com/default.aspx' . $form . '" target="_blank">View Form at Firmstep</a></li>';
      $countForms++;
      $form_content = true;
      //$page_links .= get_permalink( $page ) . "<br />";
      //$form_links .= "http://lorainccc.firmstep.com/default.aspx" . $form . "<br/>";
     } 
    }
    if($form_content == false){
     echo '<li>No Forms Found</li>';
    }
     echo '</ul>';

    restore_current_blog();
   }

   echo 'Current Number of Forms: ' . $countForms;
  
  //echo '<h2>Page Links</h2>';
  //echo $page_links;
  //echo '<h2>Form Links</h2>';
  //echo $form_links;

 }


?>