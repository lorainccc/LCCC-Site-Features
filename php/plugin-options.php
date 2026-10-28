<?php

/*
 * Based upon code from
 * https://developer.wordpress.org/plugins/settings/custom-settings-page/
 *
 */

function lc_add_wp_webtools_menu_page() {
 add_menu_page(
  __( 'LCCC Site Features', 'lorainccc' ),                              	// Page Title
  'Site Features',                                                    		// Menu Title
  'manage_options',                                                   		// Capabilities
  'lccc-wp-webtools',                                                 		// Menu Slug
  'lc_wp_webtools_options_page',                                      		// Function
  plugins_url( 'lccc-site-features/assets/images/lccc-block.png' ),     	// Icon URL
  2                                                                   		// Position (2 = Dashboard)
 );

 add_submenu_page(
  'lccc-wp-webtools',													// Parent Slug (Page to nest under)
  __( 'Current Site Page Templates', 'lorainccc' ),                      	// Page Title
  'Page Templates',                                                      	// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-page-templates',                                                   	// Menu Slug
  'lc_page_templates_list'                                               	// Function
 );

/*	add_submenu_page(
		'lccc-wp-webtools',													// Parent Slug (Page to nest under)
  __( 'Current Site List of Files in Upload Directory', 'lorainccc' ),   	// Page Title
  'Media Files',                                                         	// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-media-files',                                                   		// Menu Slug
  'lc_media_files_list'                                                  	// Function
 );*/

	add_submenu_page(
  'lccc-wp-webtools',													// Parent Slug (Page to nest under)
  __( 'Current List of PDF Files in Upload Directory', 'lorainccc' ),   	// Page Title
  'PDF Files',                                                         		// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-pdf-files',                                                   		// Menu Slug
  'lc_pdf_files_list'                                                  		// Function
 );

   add_submenu_page(
  'lccc-wp-webtools',														// Parent Slug (Page to nest under)
  __( 'Site Featured Image', 'lorainccc' ),   								// Page Title
  'Site Featured Image',                                                 	// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-site-featured-image',                                              	// Menu Slug
  'lc_site_featured_featured_field'                                      	// Function
 );

	add_submenu_page(
	'lccc-wp-webtools',														// Parent Slug (Page to nest under)
  __( 'Content Age', 'lorainccc' ),   										// Page Title
  'Site Content Age',                                                 		// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-site-content-age',                                              		// Menu Slug
  'lc_site_content_age_list'                                     			// Function
 );

 add_submenu_page(
	'lccc-wp-webtools',														// Parent Slug (Page to nest under)
  __( 'Draft Content Age', 'lorainccc' ),   								// Page Title
  'Draft Content Age',                                                 		// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-site-content-draft-age',                                              // Menu Slug
  'lc_site_content_draft_age_list'                                     		// Function
 );

/* Removing Support for LCCC Theme Options (code is no longer compatible, customizer replaced the theme options code)
 add_submenu_page(
	'lccc-wp-webtools',														// Parent Slug (Page to nest under)
	__( 'Theme Options', 'lorainccc' ),   									// Page Title
	'LCCC Theme Options',                                                 	// Menu Title
	'manage_options',                                                      	// Capabilities
	'lc-theme-settings-options',                                            // Menu Slug
	'lc_theme_options'                                     					// Function
 );
*/

 add_submenu_page(
	'lccc-wp-webtools',														// Parent Slug (Page to nest under)
	__( 'NoIndex Content', 'lorainccc' ),   								// Page Title
	'NoIndex Content',                                                 		// Menu Title
	'manage_options',                                                      	// Capabilities
	'lc-noindex-content',                                            		// Menu Slug
	'lc_noindex_content_list'                                     			// Function
 );

 add_submenu_page(
	'lccc-wp-webtools',														// Parent Slug (Page to nest under)
	__( 'RankMath OG Image Cache', 'lorainccc' ),   						// Page Title
	'OpenGraph Image Cache',                                                // Menu Title
	'manage_options',                                                      	// Capabilities
	'lc-op-image-cache',                                            		// Menu Slug
	'lc_op_image_cache_list'                                     			// Function
 );

 add_submenu_page(
	'lccc-wp-webtools',														// Parent Slug (Page to nest under)
	__( 'Pending Items', 'lorainccc' ),   									// Page Title
	'Pending Items',                                                		// Menu Title
	'manage_options',                                                      	// Capabilities
	'lc-site-pending-items',                                            	// Menu Slug
	'lc_site_pending_items_list'                                     		// Function
 );

}

//require_once( plugin_dir_path( __FILE__ ).'lc-theme-options.php');

add_action( 'admin_menu', 'lc_add_wp_webtools_menu_page' );
add_action( 'admin_init', 'lc_webtools_settings_init' );

 function lc_webtools_settings_init() {
  register_setting( 'lc_wp_webtools_options', 'lc_webtools_settings' );

  add_settings_field(
	'lc_enable_microsite_features',                                        	   // Field ID
	__('Enable Microsite Features:' , 'lorainccc'),                            // Title
	'lc_microsite_features_render',                                            // Callback
	'lc_wp_webtools_options',                                                  // Page
	'lc_webtools_settings_section'                                             // Section
   );

  add_settings_section(
   'lc_webtools_settings_section',											  // Section ID
   __( 'Choose Features to Enable', 'lorainccc' ),							  // Title
	 'lc_webtools_settings_section_callback',							      // Callback
   'lc_wp_webtools_options'													  // Page
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
  );

  add_settings_field(
   'lc_enable_shared_content_display_field',                                  // Field ID
   __('Enable LCCC Shared Content:' , 'lorainccc'),                           // Title
   'lc_shared_content_render',                                                // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );

  add_settings_field(
   'lc_enable_dept_contact_field',                                    		  // Field ID
   __('Enable LCCC Department Contact Box:' , 'lorainccc'),           		  // Title
   'lc_dept_contact_render',                                          		  // Callback
   'lc_wp_webtools_options',                                          		  // Page
   'lc_webtools_settings_section'                                     		  // Section
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

  add_settings_field(
	'lc_enable_podcast_post_type',                                             // Field ID
	__('Enable Podcast Repository:' , 'lorainccc'),                            // Title
	'lc_podcast_post_type_render',                                             // Callback
	'lc_wp_webtools_options',                                                  // Page
	'lc_webtools_settings_section'                                             // Section
   );

   add_settings_field(
	'lc_enable_content_tile_post_type',                                        // Field ID
	__('Enable Content Tiles:' , 'lorainccc'),                           	   // Title
	'lc_content_tiles_post_type_render',                                       // Callback
	'lc_wp_webtools_options',                                                  // Page
	'lc_webtools_settings_section'                                             // Section
   );

   add_settings_field(
	'lc_enable_smartsheet_embed_post_type',                                    // Field ID
	__('Enable SmartSheet Embed:' , 'lorainccc'),                              // Title
	'lc_smartsheet_embed_post_type_render',                                    // Callback
	'lc_wp_webtools_options',                                                  // Page
	'lc_webtools_settings_section'                                             // Section
   );

   add_settings_field(
	'lc_enable_handshake_feed_widget',                                    	   // Field ID
	__('Enable Handshake Feed Widget:' , 'lorainccc'),                         // Title
	'lc_handshake_widget_render',                                    		   // Callback
	'lc_wp_webtools_options',                                                  // Page
	'lc_webtools_settings_section'                                             // Section
   );

   add_settings_field(
	'lc_enable_ncr_creative_cpt',                                    	   	   // Field ID
	__('Enable NCR Creative Custom Post Type:' , 'lorainccc'),                 // Title
	'lc_ncr_creative_render',                                    		       // Callback
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

 function lc_microsite_features_render() {
	$options = get_option( 'lc_webtools_settings' );
	$lc_microsite = isset($options['lc_enable_microsite_features']) ? $options['lc_enable_microsite_features'] : '';
	?>
   <label class="switch">
	<input type="checkbox" name='lc_webtools_settings[lc_enable_microsite_features]' <?php checked( $lc_microsite, 1); ?> value='1' style="display:none;">
	<div class="slider round"></div>
   </label>
   <p class="description" id="tagline-description">Enables Microsite Features. Includes Content Grouping Template, Content Grouping Custom Post Type and Template Display Options</p>
]<?php
 }

function lc_badges_render() {
  $options = get_option( 'lc_webtools_settings' );
  $lc_badges = isset($options['lc_enable_badge_field']) ? $options['lc_enable_badge_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_badge_field]' <?php checked( $lc_badges, 1 ); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Provides badges for special announcements.</p>
<?php
 }

function lc_dept_contact_render() {
  $options = get_option( 'lc_webtools_settings' );
  $lc_dept_contact = isset($options['lc_enable_dept_contact_field']) ? $options['lc_enable_dept_contact_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_dept_contact_field]' <?php checked( $lc_dept_contact, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Provides Department Contact box on Department Home Page.</p>
<?php
 }

function lc_program_pathways_render() {
  $options = get_option( 'lc_webtools_settings' );
  $lc_program_pathways = isset($options['lc_enable_program_pathways_field']) ? $options['lc_enable_program_pathways_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_program_pathways_field]' <?php checked( $lc_program_pathways, 1); ?> value='1' style="display:none;">
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
  $successrepo = isset($options['lc_enable_success_story_field']) ? $options['lc_enable_success_story_field'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_success_story_field]' <?php checked( $successrepo, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Student Success Story Repository.  Creates Custom Post Type that allows a list of stories to be generated.</p>
<?php
 }

function lc_success_story_widget_render() {
  $options = get_option( 'lc_webtools_settings' );
  $successwidget = isset($options['lc_enable_success_story_widget']) ? $options['lc_enable_success_story_widget'] : '';
  ?>

 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_success_story_widget]' <?php checked( $successwidget, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Student Success Story Widget.  Allows selected success story to be displayed from other site.</p>
<?php
 }

function lc_social_media_fields_render() {
  $options = get_option( 'lc_webtools_settings' );
  $socialmedia = isset($options['lc_enable_social_media_fields']) ? $options['lc_enable_social_media_fields'] : '';
  ?>
 <label class="switch">
  <input type="checkbox" name='lc_webtools_settings[lc_enable_social_media_fields]' <?php checked( $socialmedia, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
 </label>
 <p class="description" id="tagline-description">Enables Social Media Fields on the General Settings page.  Allows the site to have social media account links available for use in the theme.</p>
		<?php
 }

function lc_podcast_post_type_render() {
	$options = get_option( 'lc_webtools_settings' );
	$podcast = isset($options['lc_enable_podcast_post_type']) ? $options['lc_enable_podcast_post_type'] : '';
	?>
   <label class="switch">
	<input type="checkbox" name='lc_webtools_settings[lc_enable_podcast_post_type]' <?php checked( $podcast, 1); ?> value='1' style="display:none;">
	<div class="slider round"></div>
   </label>
   <p class="description" id="tagline-description">Enables Podcast Custom Post Type.  Used to generate a list of Podcast episodes and unique URLs for each episode.</p>
<?php
 }

function lc_content_tiles_post_type_render() {
/* 	$options = get_option( 'lc_webtools_settings' );
	$contenttiles = isset($options['lc_enable_content_tile_post_type']) ? $options['lc_enable_content_tile_post_type'] : '';
	?>
   <label class="switch">
	<input type="checkbox" name='lc_webtools_settings[lc_enable_content_tile_post_type]' <?php checked( $contenttiles, 1); ?> value='1' style="display:none;">
	<div class="slider round"></div>
   </label>
   <p class="description" id="tagline-description">Enables Content Tiles Custom Post Type.</p>
<?php */
 }

 function lc_smartsheet_embed_post_type_render() {
	$options = get_option( 'lc_webtools_settings' );
	$smartsheet = isset($options['lc_enable_smartsheet_embed']) ? $options['lc_enable_smartsheet_embed'] : '';
	?>
   <label class="switch">
	<input type="checkbox" name='lc_webtools_settings[lc_enable_smartsheet_embed]' <?php checked( $smartsheet, 1); ?> value='1' style="display:none;">
	<div class="slider round"></div>
   </label>
   <p class="description" id="tagline-description">Enables SmartSheet Embed options.  Populates the iframe tag with the URL, height and width.</p>
<?php
 }

function lc_handshake_widget_render() {
	$options = get_option( 'lc_webtools_settings' );
	$handshakewidget = isset($options['lc_enable_handshake_feed_widget']) ? $options['lc_enable_handshake_feed_widget'] : '';
	?>
   <label class="switch">
	<input type="checkbox" name='lc_webtools_settings[lc_enable_handshake_feed_widget]' <?php checked( $handshakewidget, 1); ?> value='1' style="display:none;">
	<div class="slider round"></div>
   </label>
   <p class="description" id="tagline-description">Enables Handshake Feed Widget.</p>
 <?php
 }

function lc_ncr_creative_render() {
	$options = get_option( 'lc_webtools_settings' );
	$ncrcreativecpt = isset($options['lc_enable_ncr_creative_cpt']) ? $options['lc_enable_ncr_creative_cpt'] : '';
	?>
   <label class="switch">
	<input type="checkbox" name='lc_webtools_settings[lc_enable_ncr_creative_cpt]' <?php checked( $ncrcreativecpt, 1); ?> value='1' style="display:none;">
	<div class="slider round"></div>
   </label>
   <p class="description" id="tagline-description">Enables NCR Creative Post Type.</p>
 <?php
 }

// Render out Page Templates List

function lc_page_templates_list(){
	?>
	 <div style="display:block; width:100%; float:left; border-bottom: 1px solid #696969; margin: 0 0 20px 0;">
  <img style="float:right;" src="<?php echo str_replace('/php/', '', plugin_dir_url( __FILE__ ))?>/assets/images/lccc-logo.png" border="0">
  <h1 style="float:left; padding: 20px 0 0 0;">List of Current Site Templates</h1>
		<h4 style="float:left; margin:15px 0;">This list is determined by the theme.  It <em><strong>will only be consistent</strong></em> with other sites utilizing the same theme.</h4>
 </div>
<?php
		
		// Retrive list of current page templates (based upon theme).
		
	$templates = get_page_templates();
	foreach ( $templates as $template_name => $template_filename ) {
		echo "<p style='width:350px; float:left; margin: 10px 15px;'>$template_name ($template_filename)</p>";
	}
}

// Render out Media Files List
function lc_media_files_list(){

 echo '<h1>Media Files in this site</h1>';
	echo '<p>File sizes are shown in kilobytes (kb)</p>';
	echo '<p>Files shaded in red are orphaned (deleted from WordPress, but not the filesystem on the web server.)</p>';
	
 $upload_dir = wp_upload_dir();
	
	$media_dir = ( $upload_dir['basedir'] );
 
	$media_url = ( $upload_dir['baseurl'] );
		
	//echo  $media_dir;

	$years = scandir($media_dir);
	
	foreach($years as $year){
		$year_path = $media_dir . '/' . $year;
	 if ($year != '.' && $year != '..' && $year !='sites' && $year !='snapshots'){
			if ( is_dir($year_path) ){
				echo '<div style="width:100%; margin:10px 5px; clear:both;">';
				echo '<h3>' . $year . '</h3>';
				echo '</div>';
				
				$months = scandir($year_path)	;
				
				foreach($months as $month){
					if( $month != '.' && $month != '..' ){
						echo '<div style="width:375px; margin: 10px 5px; float:left; border-right: solid 1px #000;">';
						echo '<b>' . $month . '</b>';
						$month_path = $year_path . '/' . $month;
						
						$files = scandir($month_path);
						
						$file_counter = 0;
								echo '<ul class="lc-media-items">';
						//echo count($files);
						
						//for ($i = 0; $i <= count($files); $i++){
						foreach( $files as $file ){
							//echo '<p>count: ' . $file_counter . '</p>';
							if( $file != '.' && $file != '..' && $file != 'index.php' ){
								// Date Stamp
								// | ' . date ( "n-j-Y g:i A", filemtime($media_dir . '/' . $year . '/' . $month . '/' . $file ) ) . ' 
								
/*								if($file_counter % 2 == 0){
								
									$media_name = trim ( strtolower( str_replace( ' ', '-', $file ) ) );
									echo $media_name . ' | ' . lc_get_attachment_by_name($media_name);
								if ( lc_get_attachment_by_name($media_name) != true ){
								echo '<p class="deleted-items"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</p>';
								
									echo '<span class="deleted-items-message">Deleted</span>';
								}else{
									echo '<p style="padding:3px; margin: 2px;"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</p>';
								}
								}else{
									echo $media_name . ' | ' . lc_get_attachment_by_name($media_name);
									if ( lc_get_attachment_by_name($media_name) != true ){
								echo '<p class="deleted-items"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</p>';
										echo '<span class="deleted-items-message">Deleted</span>';
									}else{
								echo '<p style="background: #d3d3d3; padding:3px; margin: 2px;"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</p>';
									}
								}*/
								$media_name = '';
								$media_name = trim ( strtolower( str_replace( ' ', '-', $file ) ) );

								$media_found = '';
								$media_found = lc_get_attachment_by_name($media_name);

								if ( $media_found != true ){
									if(strpos($media_name, '-')){
									$media_part = explode("-", $media_name);
									$media_position = strrpos($media_name, '.');
									$media_ext = substr($media_name, $media_position, 4);
									//echo $media_part[0] . $media_ext;
									$media_alt_name = $media_part[0] . $media_ext;
									$media_name_found = lc_find_file($month_path, $media_alt_name);
									if ( $media_name_found != false ) {
										$media_alt_found = lc_get_attachment_by_name($media_alt_name);	
										}
									}									
								}
				
								if ( $media_name_found != false && $media_alt_found != false ){
									
									echo '<li style="padding:3px; margin: 2px;"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</li>';
									
								} else {
								if ( $media_found !== true ){
									
										echo '<li class="deleted-items"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</li>';								
									echo '<span class="deleted-items-message">Deleted</span>';
	
								}else {							
									
									echo '<li style="padding:3px; margin: 2px;"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</li>';
								
								}
								
							}							
								
								$file_counter++;
							}
						}
						echo '</ul>';
							echo '</div>';
					}
				}						
			}	
		}
	}
}

// Render out PDF Files List
function lc_pdf_files_list() {
	
 echo '<h1>PDF Files in this site</h1>';
	echo '<p>File sizes are shown in kilobytes (kb)</p>';
	
	
 $upload_dir = wp_upload_dir();
	
	$media_dir = ( $upload_dir['basedir'] );
 
	$media_url = ( $upload_dir['baseurl'] );
		
	//echo  $media_dir;

	$list_of_files_not_found = '';

	$years = scandir($media_dir);
	
	foreach($years as $year){

		$year_path = $media_dir . '/' . $year;
	 if ($year != '.' && $year != '..' && $year !='sites' && $year !='snapshots' && $year !='gravity_forms' && $year !='importwp' ){
			if ( is_dir($year_path) ){
				echo '<div style="width:100%; margin:10px 5px; clear:both;">';
				echo '<h3>' . $year . '</h3>';
				echo '</div>';
				
				$months = scandir($year_path)	;
				
				foreach($months as $month){
					if( $month != '.' && $month != '..' ){
						echo '<div style="width:375px; margin: 10px 5px; float:left; border-right: solid 1px #000;">';
						echo '<b>' . $month . '</b>';
						$month_path = $year_path . '/' . $month;
						
						$files = scandir($month_path);
						
						$file_counter = 0;
								echo '<ul class="lc-pdf-items">';
						//echo count($files);
						
						//for ($i = 0; $i <= count($files); $i++){
						foreach( $files as $file ){
							//echo '<p>count: ' . $file_counter . '</p>';
							if( $file != '.' && $file != '..' && $file != 'index.php' ){
								
								if( strpos($file, '.pdf') !== false){
									$file_found = '';
									$file_found = lc_get_attachment_by_name($file);

									if( $file_found === false ){
										
										echo '<li style="margin: 8px 0; border-bottom: 1px solid #000;" class="deleted-items"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb';
										echo '<br/><span class="deleted-items-message">Not Found in Database</span>';
										echo '</li>';
										
										$list_of_files_not_found = $list_of_files_not_found . "\r\n" . $media_url . '/' . $year . '/' . $month . '/' . $file;
										
									}else{
										echo '<li style="margin: 8px 0; padding: 4px 0; border-bottom: 1px dashed #000;"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file .  '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</li>';
										
									}
								}
							}
						}
						echo '</ul>';
							echo '</div>';
					}
				}
			}	
		}
	}
	if( $list_of_files_not_found !== '' ) {
		$files = explode( "\r\n", trim($list_of_files_not_found ));
		echo '<div style="display: block;width: 100%; clear:both;">&nbsp;</div>';
		echo '<div style="display: block;width: 100%; clear:both;">';
		echo '<h2>Files not Found</h2>';
		if( is_array($files) ){
			for( $i = 0; $i < count( $files ); $i++ ) {
				echo '<div><b>' . $files[$i] . '</b></div>';
			}
		}else{
			echo '<div><b>' . $files . '</b></div>';
		}
		echo '</div>';
	} 
}


    function lc_get_attachment_by_name( $post_name ) {
		//echo '<b>' . $post_name . '</b>';
		$post_name = strtolower($post_name);
		$post_name = str_replace( '.pdf', '', $post_name );

        $args = array(
            'posts_per_page' => 1,
            'post_type'      => 'attachment',
			'post_status'	 => 'inherit',
            'name'      => $post_name,
        );

        $get_attachment = new WP_Query( $args );
		
		if ( $get_attachment->have_posts()){

			$found_post = strval( $get_attachment->posts[0]->post_name );

			$post_looking_for = strval( $post_name );

			if ( $found_post == $post_looking_for ){
					return true;
			} else {
				return false;
			}
	
		}else{
			return false;
		}

	}				

function lc_find_file($folder_path, $file_name){
	
		$files = scandir($folder_path);
	
		$found = false;
	
	
		while($found){
			foreach($files as $file){
				if($file = $file_name){
					$found = true;
				}
			}
		}
	
	return true;
}

//Site Featured Image Field

function lc_site_featured_featured_field(){
	$screen = get_current_screen();
	if ($screen->id === 'site-features_page_lc-site-featured-image') {
	
	?>

<h1>Site Featured Image</h1>
<p>If the template supports the custom field, a featured image will appear at the top of the page below the navigation bar.</p>
<p>Use the upload image button at the bottom to select an image from the Media Gallery or upload a new image to the Gallery.  After selecting, click the save button to save your selection.</p>

<?php
		
	// Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
		update_option( 'lc_site_featured_image_id', absint( $_POST['image_attachment_id'] ) );
	endif;


	
	
		wp_enqueue_media();

	?><form method='post'>
		<div class='image-preview-wrapper'>
			<img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'lc_site_featured_image_id' ) ); ?>' height='100'>
		</div>
		<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
		<!--<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php //echo get_option( 'lc_site_featured_image_id' ); ?>'>	-->
	 <input type='text'	name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'lc_site_featured_image_id');?>'>
	<input type="submit" name="submit_image_selector" value="Save" class="button-primary">
	</form><?php


}	

add_action( 'admin_footer', 'media_selector_print_scripts' );

function media_selector_print_scripts() {

	$my_saved_attachment_post_id = get_option( 'lc_site_featured_image_id', 0 );

	?><script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			jQuery('#upload_image_button').on('click', function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

					// Finally, open the modal
					file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});

	</script><?php

} 

	}


	//Site Content Age

function lc_site_content_age_list(){
	
	echo '<h1>Oldest Content to Newest</h1>';
	
		$last_modified_pages = get_posts(
			array(
				'post_status' 			=> 'publish',
				'post_type'  			=> 'page',
				'posts_per_page' 		=> -1,
				'orderby'				=> 'modified',
				'order'					=>	'ASC',
			)
		);

		$last_modified_posts = get_posts(
			array(
				'post_status' 			=> 'publish',
				'post_type'  			=> 'post',
				'posts_per_page' 		=> -1,
				'orderby'				=> 'modified',
				'order'					=>	'ASC',
			)
		);

		$last_modified_success_stories = get_posts(
			array(
				'post_status' 			=> 'publish',
				'post_type'  			=> 'lc_success_story',
				'posts_per_page' 		=> -1,
				'orderby'				=> 'modified',
				'order'					=>	'ASC',
			)
		);

		$last_modified_podcasts = get_posts(
			array(
				'post_status' 			=> 'publish',
				'post_type'  			=> 'lccc_podcasts',
				'posts_per_page' 		=> -1,
				'orderby'				=> 'modified',
				'order'					=>	'ASC',
			)
		);

	
	$last_modified_pages_count = count($last_modified_pages);
	$last_modified_posts_count = count($last_modified_posts);
	$last_modified_success_stories_count = count($last_modified_success_stories);
	$last_modified_podcasts_count = count($last_modified_podcasts);

	//Display Page Information

	if ($last_modified_pages_count != 0){
		echo '<h2>Pages</h2>';
	?>

		<div class="modified-row">
			<div style="width:20%;float:left;font-weight:bold;">Page Title</div>
			<div style="width:60%;float:left;font-weight:bold;">URL</div>
			<div style="width:20%;float:left;font-weight:bold;">Last Modified</div>	
		</div>

<?php
    foreach($last_modified_pages as $last_modified_page) {
					echo '<div class="modified-row">';
					echo '<div style="width:20%;float:left;">' . $last_modified_page->post_title . '</div>';
					echo '<div style="width:60%;float:left;">' . get_permalink($last_modified_page->ID) . ' - <a href="' . admin_url() . 'post.php?post=' . $last_modified_page->ID . '&action=edit" target="_blank">Edit</a> | <a href="' . get_permalink($last_modified_page->ID) . '" target="_blank">View</a></div>';
					$modified_date = date_create($last_modified_page->post_modified);
					echo '<div style="width:20%;float:left;">' . date_format($modified_date, "m/d/Y") . '</div>';
					echo '</div>';
    }
	
	}

	//Display Post Information

	if ($last_modified_posts_count != 0){
		echo '<h2>Posts</h2>';
	?>

		<div class="modified-row">
			<div style="width:20%;float:left;font-weight:bold;">Post Title</div>
			<div style="width:60%;float:left;font-weight:bold;">URL</div>
			<div style="width:20%;float:left;font-weight:bold;">Last Modified</div>	
		</div>

<?php
    foreach($last_modified_posts as $last_modified_post) {
					echo '<div class="modified-row">';
					echo '<div style="width:20%;float:left;">' . $last_modified_post->post_title . '</div>';
					echo '<div style="width:60%;float:left;">' . get_permalink($last_modified_post->ID) . ' - <a href="' . admin_url() . 'post.php?post=' . $last_modified_post->ID . '&action=edit" target="_blank">Edit</a> | <a href="' . get_permalink($last_modified_post->ID) . '" target="_blank">View</a></div>';
					$modified_date = date_create($last_modified_post->post_modified);
					echo '<div style="width:20%;float:left;">' . date_format($modified_date, "m/d/Y") . '</div>';
					echo '</div>';
    }
	
	}

		//Display Success Story Information

		if ($last_modified_success_stories_count != 0){
			echo '<h2>Success Stories</h2>';
		?>
	
			<div class="modified-row">
				<div style="width:20%;float:left;font-weight:bold;">Success Story Title</div>
				<div style="width:60%;float:left;font-weight:bold;">URL</div>
				<div style="width:20%;float:left;font-weight:bold;">Last Modified</div>	
			</div>
	
	<?php
		foreach($last_modified_success_stories as $last_modified_success_story) {
						echo '<div class="modified-row">';
						echo '<div style="width:20%;float:left;">' . $last_modified_success_story->post_title . '</div>';
						echo '<div style="width:60%;float:left;">' . get_permalink($last_modified_success_story->ID) . ' - <a href="' . admin_url() . 'post.php?post=' . $last_modified_success_story->ID . '&action=edit" target="_blank">Edit</a> | <a href="' . get_permalink($last_modified_success_story->ID) . '" target="_blank">View</a></div>';
						$modified_date = date_create($last_modified_success_story->post_modified);
						echo '<div style="width:20%;float:left;">' . date_format($modified_date, "m/d/Y") . '</div>';
						echo '</div>';
		}
		
		}

		//Display LCCC Podcasts Information

		if ($last_modified_podcasts_count != 0){
			echo '<h2>Success Stories</h2>';
		?>
	
			<div class="modified-row">
				<div style="width:20%;float:left;font-weight:bold;">Podcast Title</div>
				<div style="width:60%;float:left;font-weight:bold;">URL</div>
				<div style="width:20%;float:left;font-weight:bold;">Last Modified</div>	
			</div>
	
	<?php
		foreach($last_modified_podcasts as $last_modified_podcast) {
						echo '<div class="modified-row">';
						echo '<div style="width:20%;float:left;">' . $last_modified_podcast->post_title . '</div>';
						echo '<div style="width:60%;float:left;">' . get_permalink($last_modified_podcast->ID) . ' - <a href="' . admin_url() . 'post.php?post=' . $last_modified_podcast->ID . '&action=edit" target="_blank">Edit</a> | <a href="' . get_permalink($last_modified_podcast->ID) . '" target="_blank">View</a></div>';
						$modified_date = date_create($last_modified_podcast->post_modified);
						echo '<div style="width:20%;float:left;">' . date_format($modified_date, "m/d/Y") . '</div>';
						echo '</div>';
		}
		
		}

}


	//Draft Content Age

	function lc_site_content_draft_age_list(){
	
		echo '<h1>Oldest Content to Newest</h1>';
		
			$last_modified_draft_pages = get_posts(
				array(
					'post_status' 			=> 'draft',
					'post_type'  			=> 'page',
					'posts_per_page' 		=> -1,
					'orderby'				=> 'modified',
					'order'					=>	'ASC',
				)
			);
	
			$last_modified_draft_posts = get_posts(
				array(
					'post_status' 			=> 'draft',
					'post_type'  			=> 'post',
					'posts_per_page' 		=> -1,
					'orderby'				=> 'modified',
					'order'					=>	'ASC',
				)
			);
	
	
	
		
		$last_modified_draft_pages_count = count($last_modified_draft_pages);
		$last_modified_draft_posts_count = count($last_modified_draft_posts);
	
		//Display Page Information
	
		if ($last_modified_draft_pages_count != 0){
			echo '<h2>Draft Pages</h2>';
		?>
	
			<div class="modified-row">
				<div style="width:20%;float:left;font-weight:bold;">Page Title</div>
				<div style="width:60%;float:left;font-weight:bold;">URL</div>
				<div style="width:20%;float:left;font-weight:bold;">Last Modified</div>	
			</div>
	
	<?php
		foreach($last_modified_draft_pages as $last_modified_draft_page) {
						echo '<div class="modified-row">';
						echo '<div style="width:20%;float:left;">' . $last_modified_draft_page->post_title . '</div>';
						echo '<div style="width:60%;float:left;">' . get_permalink($last_modified_draft_page->ID) . ' - <a href="' . admin_url() . 'post.php?post=' . $last_modified_draft_page->ID . '&action=edit" target="_blank">Edit</a> | <a href="' . get_permalink($last_modified_draft_page->ID) . '" target="_blank">View</a></div>';
						$modified_date = date_create($last_modified_draft_page->post_modified);
						echo '<div style="width:20%;float:left;">' . date_format($modified_date, "m/d/Y") . '</div>';
						echo '</div>';
		}
		
		}
	
		//Display Post Information
	
		if ($last_modified_draft_posts_count != 0){
			echo '<h2>Draft Posts</h2>';
		?>
	
			<div class="modified-row">
				<div style="width:20%;float:left;font-weight:bold;">Post Title</div>
				<div style="width:60%;float:left;font-weight:bold;">URL</div>
				<div style="width:20%;float:left;font-weight:bold;">Last Modified</div>	
			</div>
	
	<?php
		foreach($last_modified_draft_posts as $last_modified_draft_post) {
						echo '<div class="modified-row">';
						echo '<div style="width:20%;float:left;">' . $last_modified_draft_post->post_title . '</div>';
						echo '<div style="width:60%;float:left;">' . get_permalink($last_modified_draft_post->ID) . ' - <a href="' . admin_url() . 'post.php?post=' . $last_modified_draft_post->ID . '&action=edit" target="_blank">Edit</a> | <a href="' . get_permalink($last_modified_draft_post->ID) . '" target="_blank">View</a></div>';
						$modified_date = date_create($last_modified_draft_post->post_modified);
						echo '<div style="width:20%;float:left;">' . date_format($modified_date, "m/d/Y") . '</div>';
						echo '</div>';
		}
		
		}
	
	
	}

	//NoIndex Content

	function lc_noindex_content_list(){
		echo '<h1>Content set to NoIndex</h1>';

		$noindex_content_list = get_posts(
			array(
				'post_status' 			=> 'publish',
				'post_type'  			=> 'page',
				'posts_per_page' 		=> -1,
				'orderby'				=> 'modified',
				'order'					=>	'ASC',
			)
		   );
		   
/*  		   echo "<pre>";
		   var_dump( $noindex_content_list );
		   echo "</pre>";
 */ 
		   $noindex_content_count = count($noindex_content_list);
		   //echo $noindex_content_count . "<br>";
		?>
		<div class="modified-row">
		   <div style="width:15%;float:left;font-weight:bold;text-align:center;">Post Title</div>
		   <div style="width:50%;float:left;font-weight:bold;text-align:center;">URL</div>
		   <div style="width:15%;float:left;font-weight:bold;text-align:center;">Last Modified</div>
		   <div style="width:10%;float:left;font-weight:bold;text-align:center;">Rank Math</div>
		   <div style="width:10%;float:left;font-weight:bold;text-align:center;">Relevanssi</div>
		 </div>
	   
<?php
		 if ($noindex_content_count != 0){
			$count = 0;

			//echo $noindex_content_count;

		  foreach($noindex_content_list as $noindex_content) {

			
			
			$noindex = get_post_meta( $noindex_content->ID, 'rank_math_robots', true );
			$lc_relvanssi_hide = get_post_meta($noindex_content->ID, '_relevanssi_hide_post', true);
			
			if( $noindex != '' || $lc_relvanssi_hide = 'on') {
				echo '<div class="modified-row">';
				
				echo '<div style="width:15%;float:left;">' . $noindex_content->post_title . '</div>';
				echo '<div style="width:50%;float:left;"><a href="' . get_permalink($noindex_content->ID) . '" target="_blank">' . get_permalink($noindex_content->ID) . '</a></div>';
				
				echo '<div style="width:15%;float:left;">' . date_format(date_create($noindex_content->post_modified), "m/d/Y") . '</div>';
				
				if($noindex != ''){
					echo '<div style="width:10%;float:left;text-align:center;">No Index</div>';
				}else{
					echo '<div style="width:10%;float:left;text-align:center;"> ---- </div>';
				}

				if($lc_relvanssi_hide = 'on'){
					echo '<div style="width:10%;float:left;text-align:center;">No Index</div>';
				}else{
					echo '<div style="width:10%;float:left;text-align:center;"> ---- </div>';
				}				
				echo '</div>';	
				$count++;
			}
		  }
		 }
		 $domain = 'https://' . $_SERVER['SERVER_NAME'];
		 echo '<div class="modified-row">';
		 echo '  <div style="width:100%;float:left;">';
	     echo '    <b><a href="' . $domain . '/wp-admin/network/admin.php?page=lc-network-noindex-content">Return to Network View</a></b>';
		 echo '  </div>';
		 echo '</div>';
	}

//lc_op_image_cache_list

function lc_op_image_cache_list(){
	echo '<h1>Pages OpenGraph Image Cache</h1>';

	$og_image_cache_list = get_posts(
		array(
			'post_status' 			=> 'publish',
			'post_type'  			=> array( 'page', 'lccc_events' ),
			'posts_per_page' 		=> -1,
			'orderby'				=> 'modified',
			'order'					=>	'ASC',
		)
	   );
	   
/* 		   echo "<pre>";
	   var_dump( $noindex_content_list );
	   echo "</pre>";
*/
	   $og_image_cache_list_count = count($og_image_cache_list);
	   //echo $noindex_content_count . "<br>";s
	?>
	<div class="modified-row">
	<div style="width:20%;float:left;font-weight:bold;">Post ID</div>
	   <div style="width:20%;float:left;font-weight:bold;">Post Title</div>
	   <div style="width:20%;float:left;font-weight:bold;">Image Cache</div>
	 </div>
   
<?php
	if( isset($_GET['lc_delete_og_cache'])){
		$lc_og_image_cache = $_GET['lc_delete_og_cache'];
	}

	 if ($og_image_cache_list_count != 0){
		$count = 0;
	  foreach($og_image_cache_list as $og_image_cache) {

		$og_imagecache = get_post_meta( $og_image_cache->ID, 'rank_math_og_content_image', true );

			// if( in_array("noindex", $noindex) ){
			// 	echo '<div class="modified-row">';
				
			// 	echo '<div style="width:20%;float:left;">' . $noindex_content->post_title . '</div>';
			// 	echo '<div style="width:50%;float:left;"><a href="' . get_permalink($noindex_content->ID) . '" target="_blank">' . get_permalink($noindex_content->ID) . '</a></div>';
				
			// 	echo '<div style="width:20%;float:left;">' . date_format(date_create($noindex_content->post_modified), "m/d/Y") . '</div>';
			// 	echo '</div>';	
			// }
			
			echo '<div class="modified-row">';
			echo '<div style="width:20%;float:left;">' . $og_image_cache->ID . '</div>'; 
			echo '<div style="width:20%;float:left;">' . $og_image_cache->post_title . '</div>';
			if (!empty( $og_imagecache ) ){
				echo '<div style="width:50%;float:left;">' . $og_imagecache . ' - <a href="' . add_query_arg( 'lc_delete_og_cache', $og_image_cache->ID ). '">Delete Image Cache</a></div>';
			}else{
				echo '<div style="width:50%;float:left;">&nbsp;</div>';
			}
			
			echo '</div>';	
			$count++;
	  }
	 }

	 if( !empty( $lc_og_image_cache ) ){
		delete_post_meta( $lc_og_image_cache, 'rank_math_og_content_image' );

		echo '<p><a href="' . admin_url('admin.php?page=lc-op-image-cache') . '">Return to Edit Event</a></p>';
	 } 

	 $domain = 'https://' . $_SERVER['SERVER_NAME'];
	 echo '<div class="modified-row">';
	 echo '  <div style="width:100%;float:left;">';
	 echo '    <b><a href="' . $domain . '/wp-admin/network/admin.php?page=lc-op-image-cache">Return to Network View</a></b>';
	 echo '  </div>';
	 echo '</div>';
}

//lc_op_image_cache_list

function lc_site_pending_items_list(){
	echo '<h1>Pending Items</h1>';

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
		$lc_current_published_id = get_post_meta($pending_item->ID, '_lc_publishedId', true);
		echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_item->ID . '&action=edit" target="_blank">' . $pending_item->post_title . '</a>';
		echo '<br/>Currently Published Post ID: ' . $lc_current_published_id . ' | <a href="' . get_permalink($lc_current_published_id) . '" target="_blank">View Current Page</a>';
		echo '<br/>This Post ID: ' . $pending_item->ID . '</li>';
		if( !is_plugin_active('classic-editor/classic-editor.php') ){
			echo '<span style="display:block; margin: 15px 0;"><a href="admin.php?page=lc_content_revisions&lc_publish_post=true&lcpostID=' . $pending_item->ID . '" class="lc-post-publish-btn">Publish</a></span>';
		}
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
		$lc_current_published_id = get_post_meta($pending_event->ID, '_lc_publishedId', true);

     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_event->ID . '&action=edit" target="_blank">' . $pending_event->post_title . '</a>';
	 if( $lc_current_published_id != false ){
	  echo '<br/>Currently Published Post ID: ' . $lc_current_published_id . ' | <a href="' . get_permalink($lc_current_published_id) . '" target="_blank">View Current Event</a>';
	 }
	 echo '<br/>This Post ID: ' . $pending_event->ID . '</li>';

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

$lc_site_url = get_site_url();

$lc_site_url = str_replace( 'https://www.lorainccc.edu', '', $lc_site_url );

 if($lc_site_url == '/security'){ // Begin check for security site.
				
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
     echo '<li><a href="' . admin_url() . 'post.php?post=' . $pending_log->ID . '&action=edit" target="_blank">' . $pending_log->post_title . '</a>';
    }
    echo '</ul>';
   }
	} // End Check for Security Site

}