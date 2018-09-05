<?php

/*
	* Creates ability to create drafts of currently published posts.
	* Also allows for forced approval process for specific post types.
	* 
	*
	*/

 // Creates a draft button in the upper left corner of the publish meta box, for both admins and editors. 
	require_once( plugin_dir_path( __FILE__ ).'draft-button.php' ); 
 
	// Determines which side of the approval process the user is on.
	require_once( plugin_dir_path( __FILE__ ).'content-approvals.php' );
 
	// Enables email notifications for admins
	require_once( plugin_dir_path( __FILE__ ).'notifications.php' );

?>