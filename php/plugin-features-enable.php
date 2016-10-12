<?php

/*
 * Check the plugin settings to see which features to enable
 *
 *
 */

 $webtools = get_option( 'lc_webtools_settings' );

 // Check for Gateway Menu Feature
 if ($webtools['lc_enable_gateway_menu_field'] == 1) {
  require_once( plugin_dir_path( __FILE__ ).'gateway/widget-gateway-cpt.php');
  require_once( plugin_dir_path( __FILE__ ).'gateway/widget-gateway-menu.php');
 }


 // Check for Badge Feature
 if ($webtools['lc_enable_badge_field'] == 1) {
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-metabox.php');
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-widget.php');
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-post-type.php');
 }

 // Check for Department Contact Feature
 if ($webtools['lc_enable_dept_contact_field'] == 1) {
  require_once( plugin_dir_path( __FILE__ ).'dept-contact/dept-contact-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-contact/dept-contact-metabox.php' );
 }

 // Check for Program Path Feature
 if ($webtools['lc_enable_program_pathways_field'] == 1) {
  require_once( plugin_dir_path( __FILE__ ).'program-paths/programpath-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'program-paths/programpath-metabox.php' );
 }

 // Default features that are always loaded when the webtools plugin is activated.
 require_once( plugin_dir_path( __FILE__ ).'default-features/lccc-site-options.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/breadcrumb-trail.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/lccc-edit-role.php' );

?>