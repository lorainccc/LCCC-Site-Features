<?php

 /*
  *
  *  Adds a custom field to the general settings tab.
  *  The field contains the desired path to the subsite.
  *
  *  Example: "student-resources/academic-resources"
  *
  *  No leading or trailing "/" or else it will throw off the explode.
  *
  */

 $lccc_base_site_path = new new_lccc_base_path_setting();

class new_lccc_base_path_setting {
 function new_lccc_base_path_setting() {
  add_filter( 'admin_init', array( &$this , 'lccc_register_fields' ) );
 }

 /**
  *
  * Each field needs to be registered using register_setting and then added via add_settings_field
  *
  */
 function lccc_register_fields() {
  register_setting( 'general', 'lccc_base_path', 'esc_attr' );

  add_settings_section( 'lccc-settings', 'LCCC Settings', '__return_false', 'general' );
  add_settings_field( 'lccc_base_url_path', '<label for="lccc_base_path">'.__('Base URL Path:' , 'lccc_base_path').'</label>', array(&$this, 'lccc_fields_html') , 'general', 'lccc-settings' );

  register_setting( 'general', 'lc_blog_archive_title', 'esc_attr' );
  add_settings_field( 'lc_blog_archive_title', '<label for="lc_blog_archive_title">' . __('Blog Archive Page Title:', 'lc_blog_archive_title').'</label>', array(&$this, 'lc_blog_archive_title_field_html'), 'general', 'lccc-settings');
  
  register_setting( 'general', 'lccc_footer_phone', 'esc_attr' );
  register_setting( 'general', 'lccc_footer_email', 'esc_attr' );

  add_settings_section( 'lccc-footer-settings', 'Footer Information', '__return_false', 'general' );

  add_settings_field( 'lccc_footer_phone', '<label for="lccc_footer_phone">'.__('Phone Number:' , 'lccc_footer_phone').'</label>', array(&$this, 'lccc_footer_phone_field_html') , 'general', 'lccc-footer-settings' );
  add_settings_field( 'lccc_footer_email', '<label for="lccc_footer_email">'.__('Email Address:' , 'lccc_footer_email').'</label>', array(&$this, 'lccc_footer_email_field_html') , 'general', 'lccc-footer-settings' );

  register_setting( 'general', 'lccc_dept_directory_display', 'esc_attr' );
  register_setting( 'general', 'lccc_dept_directory_department', 'esc_attr' );

  add_settings_section( 'lccc-dept-directory-display-settings', 'Faculty/Staff Directory Settings', '__return_false', 'general' );
  
  add_settings_field( 'lccc_fac_staff_directory_display', '<label for="lccc_fac_staff_directory_display">'.__('Directory Display Type:' , 'lccc_fac_staff_directory_display').'</label>', array(&$this, 'lccc_fac_staff_directory_display_field_html') , 'general', 'lccc-dept-directory-display-settings' );
  add_settings_field( 'lccc_fac_staff_directory_department', '<label for="lccc_fac_staff_directory_department">'.__('Department Name:' , 'lccc_fac_staff_directory_department').'</label>', array(&$this, 'lccc_fac_staff_directory_department_field_html') , 'general', 'lccc-dept-directory-display-settings' );


 }

 function lccc_fields_html() {
  $value = get_option( 'lccc_base_path', '' );
  echo '<input type="text" id="lccc_base_path" name="lccc_base_path" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the URL path <strong>(without starting or trailing /)</strong> to represent where this site exists in the website.</p>';
  echo '<p class="description" id="basepath-description"><strong>Example: student-resources/academic-resources/academic-divisions</strong></p>';
 }
 
 function lc_blog_archive_title_field_html() {
  $value = get_option( 'lc_blog_archive_title', '' );
  echo '<input type="text" id="lc_blog_archive_title" name="lc_blog_archive_title" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the title for the blog archive page.  This is the page that will display the list of blog posts. <i><b>Note:</b> The blog feature may not be enabled on all sites.</i></p>';
 }

 function lccc_footer_phone_field_html() {
  $value = get_option( 'lccc_footer_phone', '' );
  echo '<input type="text" id="lccc_footer_phone" name="lccc_footer_phone" value="' . $value . '" size="75" />';
 }

 function lccc_footer_email_field_html() {
  $value = get_option( 'lccc_footer_email', '' );
  echo '<input type="text" id="lccc_footer_email" name="lccc_footer_email" value="' . $value . '" size="75" />';
 }

 function lccc_fac_staff_directory_display_field_html() {
   $value = get_option( 'lccc_dept_directory_display', '' );
    switch ($value) {
    case 'Photo':
    echo '<input type="radio" name="lccc_dept_directory_display" id="lccc_dept_directory_display_0" value="Photo" checked>';
    echo '<label for="lccc_dept_directory_display_0">Photo Grid</label> &nbsp; | &nbsp;';
    echo '<input type="radio" name="lccc_dept_directory_display" id="lccc_dept_directory_display_1" value="List">';
    echo '<label for="lccc_dept_directory_display_1">List</label>';
    break;

    case 'List':
    echo '<input type="radio" name="lccc_dept_directory_display" id="lccc_dept_directory_display_0" value="Photo">';
    echo '<label for="lccc_dept_directory_display_0">Photo Grid</label> &nbsp; | &nbsp;';
    echo '<input type="radio" name="lccc_dept_directory_display" id="lccc_dept_directory_display_1" value="List" checked>';
    echo '<label for="lccc_dept_directory_display_1">List</label>';
    break;

    default:
    echo '<input type="radio" name="lccc_dept_directory_display" id="lccc_dept_directory_display_0" value="Photo">';
    echo '<label for="lccc_dept_directory_display_0">Photo Grid</label> &nbsp; | &nbsp;';
    echo '<input type="radio" name="lccc_dept_directory_display" id="lccc_dept_directory_display_1" value="List">';
    echo '<label for="lccc_dept_directory_display_1">List</label>';
   }

}

function lccc_fac_staff_directory_department_field_html(){
  $value = get_option( 'lccc_dept_directory_department', '' );

  $domain = 'https://' . $_SERVER['HTTP_HOST'];
  $request = wp_remote_get( $domain . '/mylccc/wp-json/wp/v2/lcdeptdir_deptartments?per_page=100');

  if( is_wp_error( $request ) ){
    return false;
  }

  $body = wp_remote_retrieve_body( $request );

  $data = json_decode( $body );

  if(! empty( $data ) ) {
    echo '<select name="lccc_dept_directory_department" id="lccc_dept_directory_department">';
    echo ' <option value="null" id="0">Please select a Department</option>';
    foreach( $data as $terms ){
      $bol_selected = '';
      if($terms->id == $value){
        $bol_selected = 'selected';
      }
    echo " <option value='" . $terms->id . "' id='" . $terms->slug . "' " . $bol_selected .  " >" . $terms->name . "</option>";
    }
    echo '</select>';
  }
}
}


?>