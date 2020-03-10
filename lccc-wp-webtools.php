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

function lorainccc_site_features_styles() {
 wp_enqueue_style('lc_site_features_styles', plugin_dir_url( __FILE__ ) . 'css/lc_site_features_styles.css', 20);

 //Enables Campus Status to show on subsite pages.
 wp_enqueue_script('angular-resources', '//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-resource.js', array('jquery', 'angular-core'), '20170216', false);
 wp_enqueue_script('firebase-core', '//www.gstatic.com/firebasejs/3.6.9/firebase.js', array('jquery', 'angular-core'), '20170216', false);
 wp_enqueue_script('angularfire', '//cdn.firebase.com/libs/angularfire/2.3.0/angularfire.min.js', array('jquery', 'angular-core', 'firebase-core'), '20170216', false);
 wp_enqueue_script('firebase-init', plugin_dir_url( __FILE__ ) . 'js/firebase-init.js', array( 'firebase-core', 'angularfire' ), '20170216', false );
}

add_action( 'wp_enqueue_scripts', 'lorainccc_site_features_styles' );

function lorainccc_site_features_wp_admin_scripts() {
 wp_enqueue_style('lc_admin_features_styles', plugin_dir_url( __FILE__ ) . 'css/lc_admin_styles.css', 20);

 // Check and see if the user is and admin or editor.  Load the following js and css if user is lccc_editor.
 if( current_user_can('administrator') == false ){
  if( current_user_can('editor') == false ){
   wp_enqueue_script('lc_capabilities_script', plugin_dir_url( __FILE__ ) . 'js/capabilities.js', array( 'jquery' ) );
   wp_enqueue_style('lc_capabilities_styles', plugin_dir_url( __FILE__ ) . 'css/capabilities.css', 40);
  }
 };

}

add_action( 'admin_enqueue_scripts', 'lorainccc_site_features_wp_admin_scripts' );

require_once( plugin_dir_path( __FILE__ ).'php/plugin-options.php');
require_once( plugin_dir_path( __FILE__ ).'php/plugin-features-enable.php');

/* function lc_delete_post_type(){
    unregister_post_type( 'lccc_podcasts' );
}
add_action('init','lc_delete_post_type'); */