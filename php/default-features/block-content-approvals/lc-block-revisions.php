<?php 

/*
*   Page used to hold the functions for creating the draft and replacing the production "live" page with the draft content.
*
*/

function lc_build_menu(){

if (isset($_SERVER['REQUEST_URI']) && (false !== strpos( urldecode(esc_url_raw($_SERVER['REQUEST_URI'])), 'admin.php?page=lc_content_revisions' )) ) {
  add_submenu_page( 
  'none',                                // Parent Slug (hidden page use 'null' or 'options.php' either allows the page title to show)
  esc_html__('LCCC Revisions', 'lorainccc'),    // Page Title 
  esc_html__('LCCC Revisions', 'lorainccc'),    // Menu Title
  'read',                                       // Capabilities
  'lc_content_revisions',                       // Menu Slug
  'lc_content_revisions_options_page'           // Callback function
  );
}

}

// link to option page -> wp-admin/options.php?page=lc_content_revisions

add_action('admin_menu', 'lc_build_menu');

function lc_content_revisions_options_page(){

  /* $lc_postID = 36;

  $lc_post = get_post( $lc_postID );

  echo '<pre>';
    var_dump( $lc_post );
  echo '</pre>';

  echo $lc_post->post_content; */

}

if (isset($_SERVER['REQUEST_URI']) && (false !== strpos( urldecode(esc_url_raw($_SERVER['REQUEST_URI'])), 'admin.php?page=lc_content_revisions' )) ) {
  if ( !empty($_GET['lc_draft_post']) && !empty($_GET['lcpostID'] ) ) {

    require_once( dirname(__FILE__).'/lc-block-admin-init-revision.php');	
    add_action( 'wp_loaded', 'lc_create_draft_post' );

  }
}

if (isset($_SERVER['REQUEST_URI']) && (false !== strpos( urldecode(esc_url_raw($_SERVER['REQUEST_URI'])), 'admin.php?page=lc_content_revisions' )) ) {
  if ( !empty($_GET['lc_publish_post']) && !empty($_GET['lcpostID'] ) ) {

    require_once( dirname(__FILE__).'/lc-block-admin-publish-revision.php');	
    add_action( 'wp_loaded', 'lc_publish_post' );

  }
}

function lc_content_revisions_admin_functions(){
  if(current_user_can('administrator')){

      require_once( dirname(__FILE__).'/lc-block-admin-publish-metabox.php');	

  }
}

add_action( 'plugins_loaded', 'lc_content_revisions_admin_functions' );