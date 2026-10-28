<?php
/*
 * Check the plugin settings to see which features to enable
 *
 *
 */

 $webtools = get_option( 'lc_webtools_settings' );

 // Check for Badge Feature

  $badge = isset($webtools['lc_enable_badge_field']) ? $webtools['lc_enable_badge_field'] : '';
  
 if ($badge == 1) {
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-metabox.php');
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-widget.php');
  require_once( plugin_dir_path( __FILE__ ).'badges/badge-post-type.php');
 }

/*
 // Check for Department Contact Feature
 if ($webtools['lc_enable_dept_contact_field'] == 1) {
  require_once( plugin_dir_path( __FILE__ ).'dept-contact/dept-contact-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-contact/dept-contact-metabox.php' );
 }
*/

 // Check for Program Path Feature

  $programpath = isset($webtools['lc_enable_program_pathways_field']) ? $webtools['lc_enable_program_pathways_field'] : '';

 if ($programpath == 1) {
  require_once( plugin_dir_path( __FILE__ ).'program-paths/programpath-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'program-paths/programpath-metabox.php' );
 }

 // Check for Program Path Chart Feature

 $programpathchart = isset($webtools['lc_enable_program_pathway_chart_field']) ? $webtools['lc_enable_program_pathway_chart_field'] : '';

 //if ($programpathchart == 1) {
  //require_once( plugin_dir_path( __FILE__ ).'program-path-charts/program-chart-cpt.php' );
  //require_once( plugin_dir_path( __FILE__ ).'program-path-charts/program-chart-metabox.php' );
  //require_once( plugin_dir_path( __FILE__ ).'program-path-charts/program-chart-widget.php' );
 //}


 // Check for Department Directory Feature

  $department_directories = isset($webtools['lc_enable_department_directories_field']) ? $webtools['lc_enable_department_directories_field'] : '';

  if ($department_directories == 1) {
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/dept-directory-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/dept-directory-metabox.php' );
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/lc-dept-directory-restapi-fields.php' );
 }
 

  $department_dir_display = isset($webtools['lc_enable_department_directories_display_field']) ? $webtools['lc_enable_department_directories_display_field'] : '';

 // Check for Department Directory Display Feature
 if ($department_dir_display == 1) {
  require_once( plugin_dir_path( __FILE__ ).'dept-directory/lc-dept-directory-display-options.php' );
 }


 // Check for Shared Content Feature

  $sharedcontent = isset($webtools['lc_enable_shared_content_display_field']) ? $webtools['lc_enable_shared_content_display_field'] : '';

 if ($sharedcontent == 1) {
  require_once( plugin_dir_path( __FILE__ ).'shared-content/lc-shared-content-metabox.php' );
  require_once( plugin_dir_path( __FILE__ ).'shared-content/lc-rest-api-fetch.php' );
 }

 // Check for Success Story Feature

  $successstories = isset($webtools['lc_enable_success_story_field']) ? $webtools['lc_enable_success_story_field'] : '';

 if ($successstories == 1) {
  require_once( plugin_dir_path( __FILE__ ).'success-stories/lc-success-story-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'success-stories/lc-success-story-metabox.php' );
  require_once( plugin_dir_path( __FILE__ ).'success-stories/lc-success-restapi-fields.php' );
 }

 // Check for Success Story Widget Feature

 $successwidget = isset($webtools['lc_enable_success_story_widget']) ? $webtools['lc_enable_success_story_widget'] : '';

 if ($successwidget == 1) {
  require_once( plugin_dir_path( __FILE__ ).'success-stories/lc-success-story-widget.php' );
 }

 // Check for Social Media Fields Feature

 $socialmedia = isset($webtools['lc_enable_social_media_fields']) ? $webtools['lc_enable_social_media_fields'] : '';
 
 if ($socialmedia == 1) {
  require_once( plugin_dir_path( __FILE__ ).'social-media/lc-social-media-links.php' );
 }

 // Check for Podcast Custom Post Type Feature

 $podcast = isset($webtools['lc_enable_podcast_post_type']) ? $webtools['lc_enable_podcast_post_type'] : '';

 if ($podcast == 1) {
 require_once( plugin_dir_path( __FILE__ ).'podcasting/lc-podcasting.php' );
}

/* $content_tiles = isset($webtools['lc_enable_content_tile_post_type']) ? $webtools['lc_enable_content_tile_post_type'] : '';
// Check for Podcast Custom Post Type Feature
if ($content_tiles == 1) {
  require_once( plugin_dir_path( __FILE__ ).'content-tiles/lc-tile-content-cpt.php' );
  require_once( plugin_dir_path( __FILE__ ).'content-tiles/lc-tile-content-widget.php' );
} */

// Check for Microsite Features

$microsite = isset($webtools['lc_enable_microsite_features']) ? $webtools['lc_enable_microsite_features'] : '';

if ($microsite == 1) {
require_once( plugin_dir_path( __FILE__ ).'microsite-features/lc-microsite-enable.php' );
}

// Check for SmartSheet Embed Features

$smartsheet = isset($webtools['lc_enable_smartsheet_embed']) ? $webtools['lc_enable_smartsheet_embed'] : '';
if ($smartsheet == 1) {
  require_once( plugin_dir_path( __FILE__ ).'smartsheet-embed/lc-embed-metabox.php' );
}

// Check for Handshake Feed Widget Features

$handshakewidget = isset($webtools['lc_enable_handshake_feed_widget']) ? $webtools['lc_enable_handshake_feed_widget'] : '';
if ($handshakewidget == 1) {
  require_once( plugin_dir_path( __FILE__ ).'handshake/lc_handshake_feed_widget.php' );
}

// Check for NCR Creative CPT

$ncrcreativecpt = isset($webtools['lc_enable_ncr_creative_cpt']) ? $webtools['lc_enable_ncr_creative_cpt'] : '';
if ($ncrcreativecpt == 1) {
  require_once( plugin_dir_path( __FILE__ ).'ncr-creative-cpt/lc-creative-cpt.php' );
}

 // Default features that are always loaded when the webtools plugin is activated.
 require_once( plugin_dir_path( __FILE__ ).'default-features/lc-default-features.php' );
 require_once( plugin_dir_path( __FILE__ ).'custom-search/lc-search-widget.php' );