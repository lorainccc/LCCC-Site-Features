<?php

function lccc_new_admin_menu(){
 $user = new WP_User(get_current_user_id());

	if (!empty( $user->roles) && is_array($user->roles)) {
		foreach ($user->roles as $role)
		$role = $role;
	}
 
 if($role == "editor") {
  global $submenu;
  
  // Remove themes
  unset($submenu['themes.php'][5]);
		unset($submenu['themes.php'][6]);		
		unset($submenu['themes.php'][15]);		
		unset($submenu['themes.php'][20]);  
  
  // Remove Widgets
  remove_submenu_page( 'themes.php', 'widgets.php' );
  
  // Remove Custom Header
  unset($submenu['themes.php'][15]);
  
  // Remove Background Editor
  unset($submenu['themes.php'][20]);
  
 }
}

add_action('admin_init', 'lccc_new_admin_menu');

function lccc_adminbar_link(){
 	$user = new WP_User(get_current_user_id());

	if (!empty( $user->roles) && is_array($user->roles)) {
		foreach ($user->roles as $role)
		$role = $role;
	}

	if($role == "editor") {
  global $wp_admin_bar;

	 $wp_admin_bar->remove_menu('themes');
  $wp_admin_bar->remove_menu('customize');
  $wp_admin_bar->remove_menu('widgets');
  
 }
}

add_action( 'wp_before_admin_bar_render', 'lccc_adminbar_link', 999 );

?>