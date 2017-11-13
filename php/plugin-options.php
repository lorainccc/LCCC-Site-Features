<?php

/*
 * Based upon code from
 * https://developer.wordpress.org/plugins/settings/custom-settings-page/
 *
 */

function lc_add_wp_webtools_menu_page() {
 add_menu_page(
  __( 'LCCC Site Features', 'lorainccc' ),                              // Page Title
  'Site Features',                                                    // Menu Title
  'manage_options',                                                   // Capabilities
  'lccc-wp-webtools',                                                 // Menu Slug
  'lc_wp_webtools_options_page',                                      // Function
  plugins_url( 'lccc-site-features/assets/images/lccc-block.png' ),     // Icon URL
  2                                                                   // Position (2 = Dashboard)
 );
}

add_action( 'admin_menu', 'lc_add_wp_webtools_menu_page' );
add_action( 'admin_init', 'lc_webtools_settings_init' );

 function lc_webtools_settings_init() {
  register_setting( 'lc_wp_webtools_options', 'lc_webtools_settings' );

  add_settings_section(
   'lc_webtools_settings_section',
   __( 'Choose Features to Enable', 'lorainccc' ),
   'lc_webtools_settings_section_callback',
   'lc_wp_webtools_options'
  );

  add_settings_field(
   'lc_enable_gateway_menu_field',                                            // Field ID
   __('Enable LCCC Gateway Menus:' , 'lorainccc'),                            // Title
   'lc_gateway_menu_render',                                                  // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );

  add_settings_field(
   'lc_enable_badge_field',                                                   // Field ID
   __('Enable LCCC Badges:' , 'lorainccc'),                                   // Title
   'lc_badges_render',                                                        // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );

/*  add_settings_field(
   'lc_enable_dept_contact_field',                                            // Field ID
   __('Enable LCCC Department Contact Box:' , 'lorainccc'),                   // Title
   'lc_dept_contact_render',                                                  // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );*/

  add_settings_field(
   'lc_enable_program_pathways_field',                                        // Field ID
   __('Enable LCCC Program Pathways Menus:' , 'lorainccc'),                   // Title
   'lc_program_pathways_render',                                              // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );
/* 
  add_settings_field(
   'lc_enable_program_pathway_chart_field',                                   // Field ID
   __('Enable LCCC Program Pathways Charts:' , 'lorainccc'),                  // Title
   'lc_program_pathway_chart_render',                                         // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );
  
  add_settings_field(
   'lc_enable_department_directories_field',                                  // Field ID
   __('Enable LCCC Department Directories:' , 'lorainccc'),                   // Title
   'lc_department_directory_display_render',                                  // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );

  add_settings_field(
   'lc_enable_department_directories_display_field',                          // Field ID
   __('Enable LCCC Department Directories Display Options:' , 'lorainccc'),   // Title
   'lc_department_directory_display_options_render',                          // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );*/

  add_settings_field(
   'lc_enable_shared_content_display_field',                                  // Field ID
   __('Enable LCCC Shared Content:' , 'lorainccc'),                           // Title
   'lc_shared_content_render',                                                // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );
  
  add_settings_field(
   'lc_enable_success_story_field',                                           // Field ID
   __('Enable LCCC Student Success Story Repository:' , 'lorainccc'),         // Title
   'lc_success_story_render',                                                // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );
  
  add_settings_field(
   'lc_enable_success_story_widget',                                          // Field ID
   __('Enable LCCC Student Success Story Widget:' , 'lorainccc'),             // Title
   'lc_success_story_widget_render',                                          // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );
  
  add_settings_field(
   'lc_enable_social_media_fields',                                           // Field ID
   __('Enable Social Media Fields:' , 'lorainccc'),                           // Title
   'lc_social_media_fields_render',                                           // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );
  
 }


 function lc_wp_webtools_options_page() {
  ?>
 <div style="display:block; width:100%; float:left;">
  <img style="float:right;" src="<?php echo str_replace('/php/', '', plugin_dir_url( __FILE__ ))?>/assets/images/lccc-logo.png" border="0">
  <h1 style="float:left; padding: 20px 0 0 0;">LCCC Site Features Menu</h1>
 </div>
 <form method="post" action="options.php">
  <?php
   settings_fields( 'lc_wp_webtools_options' );
   do_settings_sections( 'lc_wp_webtools_options' );
   submit_button();
  ?>
  </form>
 <?php
 }

 function lc_webtools_settings_section_callback() {
  //echo __( 'LCCC Webtools Options', 'lorainccc' );
 }


 function lc_gateway_menu_render() {
  $options = get_option( 'lc_webtools_settings' );
  $gateway = isset($options['lc_enable_gateway_menu_field']) ? $options['lc_enable_gateway_menu_field'] : '';
?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_gateway_menu_field]' <?php checked( $gateway, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Provides a thumbnail and list of links for a site section.</p>
  <?php
 }

function lc_badges_render() {
  $options = get_option( 'lc_webtools_settings' );
  $badge = isset($options['lc_enable_badge_field']) ? $options['lc_enable_badge_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_badge_field]' <?php checked( $badge, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Provides badges for special announcements.</p>
  <?php
 }

function lc_dept_contact_render() {
  $options = get_option( 'lc_webtools_settings' );
  $dept = isset($options['lc_enable_dept_contact_field']) ? $options['lc_enable_dept_contact_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_dept_contact_field]' <?php checked( $dept, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Provides Department Contact box on Department Home Page.</p>
  <?php
 }

function lc_program_pathways_render() {
  $options = get_option( 'lc_webtools_settings' );
  $program = isset($options['lc_enable_program_pathways_field']) ? $options['lc_enable_program_pathways_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_program_pathways_field]' <?php  checked( $program, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Provides Program Pathways Menu on Program Template.</p>
  <?php
 }

function lc_program_pathway_chart_render() {
  $options = get_option( 'lc_webtools_settings' );
  $program = isset($options['lc_enable_program_pathway_chart_field']) ? $options['lc_enable_program_pathway_chart_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_program_pathway_chart_field]' <?php  checked( $program, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Provides Program Pathways Charts on Program Specific Page.</p>
  <?php
 }

function lc_department_directory_display_render() {
  $options = get_option( 'lc_webtools_settings' );
  $dirdisplay = isset($options['lc_enable_department_directories_field']) ? $options['lc_enable_department_directories_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_department_directories_field]' <?php checked( $dirdisplay, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Main Department Directory (only needs to be enabled in MyLCCC).</p>
  <?php
 }

function lc_department_directory_display_options_render() {
  $options = get_option( 'lc_webtools_settings' );
  $dirdisplayopt = isset($options['lc_enable_department_directories_display_field']) ? $options['lc_enable_department_directories_display_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_department_directories_display_field]' <?php checked( $dirdisplayopt, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Display options in General Setting section (used to display feed from main department directory).</p>
  <?php
 }

function lc_shared_content_render() {
  $options = get_option( 'lc_webtools_settings' );
  $shared = isset($options['lc_enable_shared_content_display_field']) ? $options['lc_enable_shared_content_display_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_shared_content_display_field]' <?php checked( $shared, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Shared Content field for Pages.  Allows a piece of content to be inserted at the bottom of each page the field is filled out for.</p>
  <?php
 }

function lc_success_story_render() {
  $options = get_option( 'lc_webtools_settings' );
  $shared = isset($options['lc_enable_success_story_field']) ? $options['lc_enable_success_story_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_success_story_field]' <?php checked( $shared, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Student Success Story Repository.  Creates Custom Post Type that allows a list of stories to be generated.</p>
  <?php
 }

function lc_success_story_widget_render() {
  $options = get_option( 'lc_webtools_settings' );
  $shared = isset($options['lc_enable_success_story_widget']) ? $options['lc_enable_success_story_widget'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_success_story_widget]' <?php checked( $shared, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Student Success Story Widget.  Allows selected success story to be displayed from other site.</p>
  <?php
 }

function lc_social_media_fields_render() {
  $options = get_option( 'lc_webtools_settings' );
  $shared = isset($options['lc_enable_social_media_fields']) ? $options['lc_enable_social_media_fields'] : '';
  ?>
 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_social_media_fields]' <?php checked( $shared, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Social Media Fields on the General Settings page.  Allows the site to have social media account links available for use in the theme.</p>
  <?php
 }
 
?>