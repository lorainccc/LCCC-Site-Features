<?php
/*
 * This LCCC Site Feature was based upon code from 10up's Simple Podcasting Plugin.
 * It was customized to work with a Custom Post Type verses using the Posts Post Type in WordPress.
*/

define( 'LC_PODCAST_PLUGIN_URL', str_replace( '/php/podcasting', '', plugin_dir_url( __FILE__ ) ) );

require_once( plugin_dir_path( __FILE__ ).'includes/lc-podcasts-helpers.php' );
require_once( plugin_dir_path( __FILE__ ).'includes/lc-podcasts-cpt.php' );
require_once( plugin_dir_path( __FILE__ ).'includes/lc-podcasts-metabox.php' );
require_once( plugin_dir_path( __FILE__ ).'includes/lc-podcasts-taxonomy.php' );

function lc_podcasting_admin_enqueues( $hook_suffix ){

	$screens = array(
		'edit-tags.php',
		'term.php',
	);

	if ( ! in_array( $hook_suffix, $screens, true ) ) {
		return;
	}

	// if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
	// 	$css_file = 'css/lc_podcasting-edit-term.css';
	// 	$js_file  = 'js/lc_podcasting-edit-term.js';
	// } else {
		$css_file = 'css/lc_podcasting-edit-term.min.css';
		$js_file  = 'js/lc_podcasting-edit-term.min.js';
	//}

    wp_enqueue_script('lc_podcasting_edit_term_script', LC_PODCAST_PLUGIN_URL . $js_file, array( 'jquery' ) );
	wp_enqueue_style('lc_podcasting_edit_term_styles', LC_PODCAST_PLUGIN_URL . $css_file, 40);

}

add_action( 'admin_enqueue_scripts', 'lc_podcasting_admin_enqueues' );

/**
 * Enqueue helper script for the post edit and new post screens.
 *
 * @param  string $hook_suffix The current admin page.
 */
function lc_edit_post_enqueues( $hook_suffix ) {
	$screens = array(
		'post.php',
		'post-new.php',
	);

	if ( ! in_array( $hook_suffix, $screens, true ) ) {
		return;
	}

	// if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
	//	$js_file = 'js/lc_podcasting-edit-post.js';
	// } else {
	 	$js_file = 'js/lc_podcasting-edit-post.min.js';
	// }

	wp_enqueue_script( 'lc_podcasting_edit_post_screen', LC_PODCAST_PLUGIN_URL . $js_file, array( 'jquery' ), '20200204', true );
}

add_action( 'admin_enqueue_scripts', 'lc_edit_post_enqueues' );


/**
 * Load the file containing iTunes specific feed hooks.
 * 
 */

function lc_custom_feed() {
	if ( is_admin() ) {
		return;
	}

	// Is this a feed for a term in the podcasting taxonomy?
	if ( is_feed() && is_tax( 'lcpodcasts' ) ) {
		remove_action( 'rss2_head', 'rss2_blavatar' );
		remove_action( 'rss2_head', 'rss2_site_icon' );
		remove_filter( 'the_excerpt_rss', 'add_bug_to_feed', 100 );
		remove_action( 'rss2_head', 'rsscloud_add_rss_cloud_element' );
		add_filter(
			'wp_feed_cache_transient_lifetime',
			function () {
				return HOUR_IN_SECONDS;
			}
        );
		require_once( plugin_dir_path( __FILE__ ) . 'includes/lc-podcasts-feed.php' );
	}
}
add_action( 'wp', 'lc_custom_feed' );