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
/*
  $dept = isset($webtools['lc_enable_dept_contact_field']) ? $webtools['lc_enable_dept_contact_field'] : '';

 // Check for Department Contact Feature
 if ($dept == 1) {
  require_once( plugin_dir_path( __FILE__ ).'dept-contact/dept-contact-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-contact/dept-contact-metabox.php' );
 }
*/
  $programpath = isset($webtools['lc_enable_program_pathways_field']) ? $webtools['lc_enable_program_pathways_field'] : '';

 // Check for Program Path Feature
 if ($programpath == 1) {
  require_once( plugin_dir_path( __FILE__ ).'program-paths/programpath-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'program-paths/programpath-metabox.php' );
 }
/*
 $programpathchart = isset($webtools['lc_enable_program_pathway_chart_field']) ? $webtools['lc_enable_program_pathway_chart_field'] : '';

 // Check for Program Path Feature
 if ($programpathchart == 1) {
  require_once( plugin_dir_path( __FILE__ ).'program-path-charts/program-chart-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'program-path-charts/program-chart-metabox.php' );
  require_once( plugin_dir_path( __FILE__ ).'program-path-charts/program-chart-widget.php' );
 }

/*  $department_directories = isset($webtools['lc_enable_department_directories_field']) ? $webtools['lc_enable_department_directories_field'] : '';

 // Check for Department Directory Feature
 if ($department_directories == 1) {
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/dept-directory-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/dept-directory-metabox.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/lc-dept-directory-restapi-fields.php' );
 }

  $department_dir_display = isset($webtools['lc_enable_department_directories_display_field']) ? $webtools['lc_enable_department_directories_display_field'] : '';

 // Check for Department Directory Display Feature
 if ($department_dir_display == 1) {
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/programpath-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/programpath-metabox.php' );
 }*/

  $sharedcontent = isset($webtools['lc_enable_shared_content_display_field']) ? $webtools['lc_enable_shared_content_display_field'] : '';

 // Check for Shared Content Feature
 if ($sharedcontent == 1) {
  require_once( plugin_dir_path( __FILE__ ).'shared-content/lc-shared-content-metabox.php' );
  require_once( plugin_dir_path( __FILE__ ).'shared-content/lc-rest-api-fetch.php' );
 }

  $successstories = isset($webtools['lc_enable_success_story_field']) ? $webtools['lc_enable_success_story_field'] : '';

 // Check for Success Story Feature
 if ($successstories == 1) {
  require_once( plugin_dir_path( __FILE__ ).'success-stories/lc-success-story-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'success-stories/lc-success-story-metabox.php' );
  require_once( plugin_dir_path( __FILE__ ).'success-stories/lc-success-restapi-fields.php' );
 }

 $successwidget = isset($webtools['lc_enable_success_story_widget']) ? $webtools['lc_enable_success_story_widget'] : '';
  // Check for Success Story Widget Feature
 if ($successstories == 1) {
  require_once( plugin_dir_path( __FILE__ ).'success-stories/lc-success-story-widget.php' );
 }

 $socialmedia = isset($webtools['lc_enable_social_media_fields']) ? $webtools['lc_enable_social_media_fields'] : '';
  // Check for Success Story Widget Feature
 if ($socialmedia == 1) {
  require_once( plugin_dir_path( __FILE__ ).'social-media/lc-social-media-links.php' );
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
// require_once( plugin_dir_path( __FILE__ ).'default-features/content-approvals/draft-button.php' ); 
// require_once( plugin_dir_path( __FILE__ ).'default-features/content-approvals/content-approvals.php' );
?>