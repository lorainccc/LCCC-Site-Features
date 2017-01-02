<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.lorainccc.edu
 * @since      1.0.0
 *
 * @package    Lccc_Wp_Webtools
 * @subpackage Lccc_Wp_Webtools/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lccc_Wp_Webtools
 * @subpackage Lccc_Wp_Webtools/includes
 * @author     LCCC Web Dev Team <notice@lorainccc.edu>
 */
class Lccc_Wp_Webtools_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

  $role = get_role( 'lccc_editor' );
  $role->add_cap( 'gravityforms_edit_forms' );
  $role->add_cap( 'gravityforms_create_form' );
  $role->add_cap( 'gravityforms_view_entries' );
  $role->add_cap( 'gravityforms_edit_entries' );
  $role->add_cap( 'gravityforms_delete_entries' );
  $role->add_cap( 'gravityforms_export_entries' );
  $role->add_cap( 'gravityforms_view_entry_notes' );
  $role->add_cap( 'gravityforms_edit_entry_notes' );
  $role->add_cap( 'gravityforms_view_addons' );
  $role->add_cap( 'gravityforms_preview_forms' );

	}

}
