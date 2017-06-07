<?php

 // LCCC User Role Capabilities Network Wide

 add_action( 'admin_menu', 'lc_user_role_capabilities_network_page' );

 function lc_user_role_capabilities_network_page(){
  add_submenu_page(
   'users.php',                     // Parent Slug (File name of the standard WordPress admin Page)
   'LCCC Editor Role Info',         // Page Title
   'LCCC Role Check',               // Menu Title
   'manage_network_options',        // Capability
   'lc_role_check',                 // Menu Slug
   'lc_display_user_role_caps'      // Callback Function
  );
 }

 function lc_display_user_role_caps(){

  echo '<h1>LCCC Editor Role Capabilities</h1>';

  $role_caps = get_role( 'lccc_editor' );

  var_dump($role_caps);


  echo '<h1>LCCC Advanced Editor Role Capabilities</h1>';

  $role_caps = get_role( 'lccc_adv_editor' );

  var_dump($role_caps);


  echo '<h1>LCCC Super Admin Role Capabilities</h1>';

  $role_caps = get_role( 'administrator' );

  var_dump($role_caps);


  echo '<h1>WP Editor Role Capabilities</h1>';

  $role_caps = get_role( 'editor' );

  var_dump( $role_caps );  
 }
?>