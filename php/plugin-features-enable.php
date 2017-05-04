<?php

/*
 * Check the plugin settings to see which features to enable
 *
 *
 */

 $webtools = get_option( 'lc_webtools_settings' );

 // Check for Gateway Menu Feature

  // check if field is set to true or false.  Removes undefined index warning.
  $gateway = isset($webtools['lc_enable_gateway_menu_field']) ? $webtools['lc_enable_gateway_menu_field'] : '';

 if ($gateway == 1) {
  require_once( plugin_dir_path( __FILE__ ).'gateway/widget-gateway-cpt.php');
  require_once( plugin_dir_path( __FILE__ ).'gateway/widget-gateway-menu.php');
 }

  $badge = isset($webtools['lc_enable_badge_field']) ? $webtools['lc_enable_badge_field'] : '';
  
 // Check for Badge Feature
 if ($badge == 1) {
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-metabox.php');
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-widget.php');
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-post-type.php');
 }

  $dept = isset($webtools['lc_enable_dept_contact_field']) ? $webtools['lc_enable_dept_contact_field'] : '';

 // Check for Department Contact Feature
 if ($dept == 1) {
  require_once( plugin_dir_path( __FILE__ ).'dept-contact/dept-contact-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-contact/dept-contact-metabox.php' );
 }

  $programpath = isset($webtools['lc_enable_program_pathways_field']) ? $webtools['lc_enable_program_pathways_field'] : '';

 // Check for Program Path Feature
 if ($programpath == 1) {
  require_once( plugin_dir_path( __FILE__ ).'program-paths/programpath-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'program-paths/programpath-metabox.php' );
 }

 // Check for Department Directory Feature
// if ($webtools['lc_enable_department_directories_field'] == 1) {
//  require_once( plugin_dir_path( __FILE__ ).'dept-directory/dept-directory-cpt.php' );
//  require_once( plugin_dir_path( __FILE__ ).'dept-directory/dept-directory-metabox.php' );
// }

 // Check for Department Directory Display Feature
// if ($webtools['lc_enable_department_directories_display_field'] == 1) {
//  require_once( plugin_dir_path( __FILE__ ).'dept-directory/programpath-cpt.php' );
//  require_once( plugin_dir_path( __FILE__ ).'dept-directory/programpath-metabox.php' );
// }

  $sharedcontent = isset($webtools['lc_enable_shared_content_display_field']) ? $webtools['lc_enable_shared_content_display_field'] : '';

 // Check for Shared Content Feature
 if ($sharedcontent == 1) {
  require_once( plugin_dir_path( __FILE__ ).'shared-content/lc-shared-content-metabox.php' );
  require_once( plugin_dir_path( __FILE__ ).'shared-content/lc-rest-api-fetch.php' );
 }

 // Default features that are always loaded when the webtools plugin is activated.
 require_once( plugin_dir_path( __FILE__ ).'default-features/lccc-site-options.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/breadcrumb-trail.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/lccc-edit-role.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/tiny-mce-add-styles.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/lccc-error.php' );
 //require_once( plugin_dir_path( __FILE__ ).'default-features/forms-detector.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/network-forms-detector.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/lccc-capabilities.php' );
 require_once( plugin_dir_path( __FILE__ ).'default-features/network-pending-items.php' );
// Content Approval Custom Workflow
 require_once( plugin_dir_path( __FILE__ ).'default-features/content-approvals/content-approvals.php' );
?>