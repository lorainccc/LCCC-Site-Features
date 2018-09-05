<?php

 /*
  * Base file for LCCC Content Approval Process
  *
  */

 // Check user roles and

 class lc_check_user {

  public function __construct(){
   add_action( 'plugins_loaded', array( $this, 'lc_check_user_can' ) );
  }

  public function lc_check_user_can(){
   
   if(current_user_can('administrator') != true ){
     if(current_user_can_for_blog( get_current_blog_id(), 'lccc_edit') == true || current_user_can_for_blog( get_current_blog_id(), 'lccc_adv_edit') == true ){
							require_once( plugin_dir_path( __FILE__ ).'ca-workflow-functions.php' );
							require_once( plugin_dir_path( __FILE__ ).'ca-publish-functions.php' );
						 require_once( plugin_dir_path( __FILE__ ).'notifications.php');
     } 
    }
			if(current_user_can('administrator')){
				require_once( plugin_dir_path( __FILE__ ).'admin-workflow.php' );
				require_once( plugin_dir_path( __FILE__ ).'ca-admin-publish-functions.php' );
			}
  }
 }




$lc_check_user_plugin = new lc_check_user();

?>