<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.lorainccc.edu
 * @since      1.0.0
 *
 * @package    Lccc_Wp_Webtools
 * @subpackage Lccc_Wp_Webtools/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Lccc_Wp_Webtools
 * @subpackage Lccc_Wp_Webtools/includes
 * @author     LCCC Web Dev Team <notice@lorainccc.edu>
 */
class Lccc_Wp_Webtools_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'lccc-wp-webtools',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
