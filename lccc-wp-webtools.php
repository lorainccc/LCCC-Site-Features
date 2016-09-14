<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.lorainccc.edu
 * @since             1.0.0
 * @package           Lccc_Wp_Webtools
 *
 * @wordpress-plugin
 * Plugin Name:       LCCC Site Features
 * Plugin URI:        http://www.lorainccc.edu
 * Description:       A collection of website features created by the LCCC Web Development Team.  This plugin combines multiple plugins together and allows for individual features to be turned on and off for each site in the multi-site network.
 * Version:           1.0.0
 * Author:            LCCC Web Dev Team
 * Author URI:        http://www.lorainccc.edu
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lccc-wp-webtools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lccc-wp-webtools-activator.php
 */
function activate_lccc_wp_webtools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lccc-wp-webtools-activator.php';
	Lccc_Wp_Webtools_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lccc-wp-webtools-deactivator.php
 */
function deactivate_lccc_wp_webtools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lccc-wp-webtools-deactivator.php';
	Lccc_Wp_Webtools_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lccc_wp_webtools' );
register_deactivation_hook( __FILE__, 'deactivate_lccc_wp_webtools' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lccc-wp-webtools.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lccc_wp_webtools() {

	$plugin = new Lccc_Wp_Webtools();
	$plugin->run();

}
run_lccc_wp_webtools();

function lorainccc_site_features_wp_admin_scripts() {
 wp_enqueue_style('lc_webtools_styles', plugin_dir_url( __FILE__ ) . 'css/lc_webtools_styles.css', 20);
}

add_action( 'admin_enqueue_scripts', 'lorainccc_site_features_wp_admin_scripts' );

require_once( plugin_dir_path( __FILE__ ).'php/plugin-options.php');
require_once( plugin_dir_path( __FILE__ ).'php/plugin-features-enable.php');
