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
		'lccc-wp-webtools',																										// Parent Slug (Page to nest under)
  __( 'Current Site Page Templates', 'lorainccc' ),                      	// Page Title
  'Page Templates',                                                      	// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-page-templates',                                                   	// Menu Slug
  'lc_page_templates_list'                                               	// Function
 );
/*	add_submenu_page(
		'lccc-wp-webtools',																									 	// Parent Slug (Page to nest under)
  __( 'Current Site List of Files in Upload Directory', 'lorainccc' ),   	// Page Title
  'Media Files',                                                         	// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-media-files',                                                   		// Menu Slug
  'lc_media_files_list'                                                  	// Function
 );*/
	add_submenu_page(
		'lccc-wp-webtools',																										// Parent Slug (Page to nest under)
  __( 'Current List of PDF Files in Upload Directory', 'lorainccc' ),   	// Page Title
  'PDF Files',                                                         		// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-pdf-files',                                                   			// Menu Slug
  'lc_pdf_files_list'                                                  		// Function
 );
	add_submenu_page(
	'lccc-wp-webtools',																											// Parent Slug (Page to nest under)
  __( 'Site Featured Image', 'lorainccc' ),   														// Page Title
  'Site Featured Image',                                                 	// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-site-featured-image',                                              	// Menu Slug
  'lc_site_featured_featured_field'                                      	// Function
 );
	add_submenu_page(
	'lccc-wp-webtools',																											// Parent Slug (Page to nest under)
  __( 'Content Age', 'lorainccc' ),   																		// Page Title
  'Site Content Age',                                                 		// Menu Title
  'manage_options',                                                      	// Capabilities
  'lc-site-content-age',                                              		// Menu Slug
  'lc_site_content_age_list'                                     					// Function
 );
 add_submenu_page(
	'lccc-wp-webtools',																											// Parent Slug (Page to nest under)
	__( 'Theme Options', 'lorainccc' ),   																	// Page Title
	'LCCC Theme Options',                                                 	// Menu Title
	'manage_options',                                                      	// Capabilities
	'lc-theme-settings-options',                                            // Menu Slug
	'lc_theme_options'                                     									// Function
);
}

require_once( plugin_dir_path( __FILE__ ).'lc-theme-options.php');

add_action( 'admin_menu', 'lc_add_wp_webtools_menu_page' );
add_action( 'admin_init', 'lc_webtools_settings_init' );

 function lc_webtools_settings_init() {
  register_setting( 'lc_wp_webtools_options', 'lc_webtools_settings' );

  add_settings_section(
   'lc_webtools_settings_section',																						// Section ID
   __( 'Choose Features to Enable', 'lorainccc' ),														// Title
	 'lc_webtools_settings_section_callback',																		// Callback
   'lc_wp_webtools_options'																										// Page
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
 
  add_settings_field(
   'lc_enable_program_pathway_chart_field',                                   // Field ID
   __('Enable LCCC Program Pathways Charts:' , 'lorainccc'),                  // Title
   'lc_program_pathway_chart_render',                                         // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );
  
/*  add_settings_field(
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

  add_settings_field(
	'lc_enable_podcast_post_type',                                             // Field ID
	__('Enable Podcast Repository:' , 'lorainccc'),                           // Title
	'lc_podcast_post_type_render',                                             // Callback
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

 function lc_podcast_post_type_render() {
	$options = get_option( 'lc_webtools_settings' );
	$shared = isset($options['lc_enable_podcast_post_type']) ? $options['lc_enable_podcast_post_type'] : '';
	?>
   <label class="switch">
	<input type="checkbox" name='lc_webtools_settings[lc_enable_podcast_post_type]' <?php checked( $shared, 1); ?> value='1' style="display:none;">
	<div class="slider round"></div>
   </label>
   <p class="description" id="tagline-description">Enables Podcast Custom Post Type.  Used to generate a list of Podcast episodes and unique URLs for each episode.</p>
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

	$years = scandir($media_dir);
	
	foreach($years as $year){

		$year_path = $media_dir . '/' . $year;
	 if ($year != '.' && $year != '..' && $year !='sites' && $year !='snapshots' && $year !='gravity_forms' ){
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
//									$file_found = lc_get_attachment_by_name($file);
//									
//									if($file_found !== true ){
										
//										echo '<li style="margin: 8px 0; border-bottom: 1px solid #000;" class="deleted-items"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb';
//										echo '<br/><span class="deleted-items-message">Not Found in Database</span>';
//										echo '</li>';
//									
//									}else{

										echo '<li style="margin: 8px 0; padding: 4px 0; border-bottom: 1px dashed #000;"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" style="word-break:break-all;" target="_blank">' . $file .  '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</li>';
//									}
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

}


    function lc_get_attachment_by_name( $post_name ) {
					//echo '<b>' . $post_name . '</b>';
					$post_name = strtolower($post_name);
        $args = array(
            'posts_per_page' => 1,
            'post_type'      => 'attachment',
												'post_status'				=> 'inherit',
            'post_name'      => $post_name,
        );
        $get_attachment = new WP_Query( $args );
					
/*							if ($post_name == '2017-holiday-greeting-slider-1024x341.jpg' ){
							 echo '<pre>';
								var_dump($get_attachment);
								echo '</pre>';
							}*/
					
							$found_post = strval( $get_attachment->posts[0]->post_name );
							$post_looking_for = strval( $post_name );
					
							//echo $post_name . '<br/>';
					
							//echo strlen($post_looking_for);
					
							$post_looking_for = substr($post_looking_for, 0, strlen($post_looking_for)-4);
							
						
							
					
							//echo strcmp($found_post, $post_looking_for);
							$found = strpos($post_looking_for, $found_post );

							//echo '<p>' . $found . '</p>';
					
							if ( $found_post == $post_looking_for ){
									return true;
							} else {
								return false;
							}
					
/*        if ( $get_attachment->posts[0] ) {
										return true;									
									}else{
         	return false;
							}*/
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
	
	$last_modified = get_posts(
    array(
     'post_status' 			=> 'publish',
     'post_type'  			 => 'page',
					'posts_per_page' => -1,
					'orderby'								=> 'modified',
					'order'										=>	'ASC',
    )
   );
	
	$last_modified_count = count($last_modified);
	?>

		<div class="modified-row">
			<div style="width:20%;float:left;font-weight:bold;">Page Title</div>
			<div style="width:60%;float:left;font-weight:bold;">URL</div>
			<div style="width:20%;float:left;font-weight:bold;">Last Modified</div>	
</div>

<?php
   if ($last_modified_count != 0){
    foreach($last_modified as $last_modified) {
					echo '<div class="modified-row">';
					echo '<div style="width:20%;float:left;">' . $last_modified->post_title . '</div>';
					echo '<div style="width:60%;float:left;">' . get_permalink($last_modified->ID) . ' - <a href="' . admin_url() . 'post.php?post=' . $last_modified->ID . '&action=edit" target="_blank">Edit</a></div>';
					$modified_date = date_create($last_modified->post_modified);
					echo '<div style="width:20%;float:left;">' . date_format($modified_date, "m/d/Y") . '</div>';
					echo '</div>';
    }
   }
	
	
}

?>