<?php

 /*
  *
  *  Adds custom fields to the general settings tab.
  *  The fields are used to provide links to social media accounts.
  *
  */

 $lc_social_media_links = new new_lc_social_media_links();

class new_lc_social_media_links {
 
 function new_lc_social_media_links() {
  add_filter( 'admin_init', array( &$this , 'lc_register_social_media_fields' ) ); 
 }
 
 /**
  *
  * Each field needs to be registered using register_setting and then added via add_settings_field
  *
  */
 
 function lc_register_social_media_fields() {
  
  register_setting( 'general', 'lc_facebook_link', 'esc_attr' );
  register_setting( 'general', 'lc_twitter_link', 'esc_attr' );
  register_setting( 'general', 'lc_instagram_link', 'esc_attr' );
  register_setting( 'general', 'lc_blog_link', 'esc_attr' );
  
  add_settings_section( 'lc_social_media', 'Social Media Links', '__return_false', 'general' );
  
  add_settings_field( 'lc_facebook_link', '<label for="lc_facebook_link">'. __('Facebook Link:', 'lc_social_media').'</label>', array(&$this, 'lc_facebook_html'), 'general', 'lc_social_media' );
  
  add_settings_field( 'lc_twitter_link', '<label for="lc_twitter_link">'. __('Twitter Link:', 'lc_social_media').'</label>', array(&$this, 'lc_twitter_html'), 'general', 'lc_social_media' );
  
  add_settings_field( 'lc_instagram_link', '<label for="lc_instagram_link">'. __('Instagram Link:', 'lc_social_media').'</label>', array(&$this, 'lc_instagram_html'), 'general', 'lc_social_media' );
  
  add_settings_field( 'lc_blog_link', '<label for="lc_blog_link">'. __('Blog Link:', 'lc_social_media').'</label>', array(&$this, 'lc_blog_html'), 'general', 'lc_social_media' );
  
 }
 
 function lc_facebook_html() {
  $fb_value = get_option('lc_facebook_link', '');
  echo '<input type="text" id="lc_facebook_link" name="lc_facebook_link" value="' . $fb_value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the URL path to the Facebook page you wish to link to.</p>';
 }
 
 function lc_twitter_html() {
  $tw_value = get_option('lc_twitter_link', '');
  echo '<input type="text" id="lc_twitter_link" name="lc_twitter_link" value="' . $tw_value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the URL path to the Twitter account you wish to link to.</p>';
 }

 function lc_instagram_html() {
  $ig_value = get_option('lc_instagram_link', '');
  echo '<input type="text" id="lc_instagram_link" name="lc_instagram_link" value="' . $ig_value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the URL path to the Instagram account you wish to link to.</p>';
 }
 
 function lc_blog_html() {
  $blog_value = get_option('lc_blog_link', '');
  echo '<input type="text" id="lc_blog_link" name="lc_blog_link" value="' . $blog_value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the URL path to the blog you wish to link to.</p>';
 }
 
}

?>