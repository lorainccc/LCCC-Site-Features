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
	 add_submenu_page(
		'lccc-wp-webtools',																																																		  // Parent Slug (Page to nest under)
  __( 'Current Site Page Templates', 'lorainccc' ),                      // Page Title
  'Page Templates',                                                      // Menu Title
  'manage_options',                                                      // Capabilities
  'lc-page-templates',                                                   // Menu Slug
  'lc_page_templates_list'                                               // Function
 );
	add_submenu_page(
		'lccc-wp-webtools',																																																		  // Parent Slug (Page to nest under)
  __( 'Current Site List of Files in Upload Directory', 'lorainccc' ),   // Page Title
  'Media Files',                                                         // Menu Title
  'manage_options',                                                      // Capabilities
  'lc-media-files',                                                   			// Menu Slug
  'lc_media_files_list'                                                  // Function
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
 
  add_settings_field(
   'lc_enable_program_pathway_chart_field',                                   // Field ID
   __('Enable LCCC Program Pathways Charts:' , 'lorainccc'),                  // Title
   'lc_program_pathway_chart_render',                                         // Callback
   'lc_wp_webtools_options',                                                  // Page
   'lc_webtools_settings_section'                                             // Section
  );
 /* 
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

 $upload_dir = wp_upload_dir();
	
	$media_dir = ( $upload_dir['basedir'] );
 
	$media_url = ( $upload_dir['baseurl'] );
		
	//echo  $media_dir;

	$years = scandir($media_dir);
	
	foreach($years as $year){
		$year_path = $media_dir . '/' . $year;
	 if ($year != '.' && $year != '..' ){
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
						
						foreach($files as $file){
							if( $file != '.' && $file != '..' ){
								// Date Stamp
								// | ' . date ( "n-j-Y g:i A", filemtime($media_dir . '/' . $year . '/' . $month . '/' . $file ) ) . ' 
								
								if($file_counter % 2 == 0){
									
								echo '<p style="padding:3px; margin: 2px;"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</p>';
								
								}else{
									
								echo '<p style="background: #d3d3d3; padding:3px; margin: 2px;"><a href="' . $media_url . '/' . $year . '/' . $month . '/' . $file . '" target="_blank">' . $file . '</a> | ' . number_format( filesize( $media_dir . '/' . $year . '/' . $month . '/' . $file )/1024, 2 ) . ' kb</p>';
									
								}
								$file_counter++;
							}
						}
							echo '</div>';
					}
				}
						
			}	
		}
	}

}

if( ! ( function_exists( 'lc_get_attachment_by_name' ) ) ) {
    function lc_get_attachment_by_name( $post_name ) {
        $args = array(
            'posts_per_page' => 1,
            'post_type'      => 'attachment',
												'post_status'				=> 'inherit',
            'post_name'      => trim ( $post_name ),
        );
        $get_attachment = new WP_Query( $args );

        if ( $get_attachment->posts[0] )
            return $get_attachment->posts[0];
        else
          return false;
    }
}

?>