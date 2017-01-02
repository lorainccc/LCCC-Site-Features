<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.lorainccc.edu
 * @since      1.0.0
 *
 * @package    Lccc_Wp_Webtools
 * @subpackage Lccc_Wp_Webtools/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Lccc_Wp_Webtools
 * @subpackage Lccc_Wp_Webtools/includes
 * @author     LCCC Web Dev Team <notice@lorainccc.edu>
 */
class Lccc_Wp_Webtools_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

  $role = get_role( 'lccc_editor' );
  $role->remove_cap( 'gravityforms_edit_forms' );
  $role->remove_cap( 'gravityforms_create_form' );
  $role->remove_cap( 'gravityforms_view_entries' );
  $role->remove_cap( 'gravityforms_edit_entries' );
  $role->remove_cap( 'gravityforms_delete_entries' );
  $role->remove_cap( 'gravityforms_export_entries' );
  $role->remove_cap( 'gravityforms_view_entry_notes' );
  $role->remove_cap( 'gravityforms_edit_entry_notes' );
  $role->remove_cap( 'gravityforms_view_addons' );
  $role->remove_cap( 'gravityforms_preview_forms' );

	}

}
