<?php
/*
 * Adds editor-styles.css to the Tiny MCE Editor
 *
 * Adds "Styles" drop-down to Tiny MCE Editor
 * Styles drop-down includes custom styles for the content
 */



/**
 * Apply styles to the visual editor
 */
add_filter('mce_css', 'lc_mce_editor_style');
function lc_mce_editor_style($url) {

    if ( !empty($url) )
        $url .= ',';

    // Retrieves the plugin directory URL and adds editor stylesheet
    // Change the path here if using different directories
    $url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/css/editor-styles.css';

    return $url;
}

/**
 * Add "Styles" drop-down
 */
add_filter('mce_buttons_2', 'lc_mce_add_editor_buttons');

function lc_mce_add_editor_buttons($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}



/**
 * Add "Styles" drop-down content or classes
 */
add_filter('tiny_mce_before_init', 'lc_mce_add_styles_editor_settings');

function lc_mce_add_styles_editor_settings( $settings ) {

    $style_formats = array(
        array(
         'title' => 'Clipboard Bullets',
         'selector' => 'ul',
         'classes' => 'bullet-clipboard'
        ),
    );

 $settings['style_formats'] = json_encode( $style_formats );

 return $settings;
}


/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 * Enqueue the custom stylesheet in the front-end
 */
add_action('wp_enqueue_scripts', 'lc_mce_editor_styles_enqueue');
function lc_mce_editor_styles_enqueue() {
  $StyleUrl = plugin_dir_url(__FILE__).'css/editor-styles.css';
  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}

?>