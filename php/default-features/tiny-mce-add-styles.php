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

    //$url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/css/editor-styles.css';

    // Change URL for CSS to theme
    $url .= '//' . $_SERVER['SERVER_NAME'] . '/wp-content/themes/lorainccc-subsite/css/editor-styles.css';

    return $url;
}

add_filter('mce_css', 'lc_mce_icon_style');
function lc_mce_icon_style($url) {

    if ( !empty($url) )
        $url .= ',';

    // Retrieves the plugin directory URL and adds editor stylesheet
    // Change the path here if using different directories

    //$url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/css/editor-styles.css';

    // Change URL for CSS to theme
    $url .= '//' . $_SERVER['SERVER_NAME'] . '/wp-content/themes/lorainccc-subsite/genericons/genericons.css';

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
        array(
         'title' => 'Arrow Bullets',
         'selector' => 'ul',
         'classes' => 'bullet-arrow'
        ),
        array(
            'title' => 'Blue Button',
            'selector' => 'a',
            'classes' => 'blue-button'
           ),
    );

 $settings['style_formats'] = json_encode( $style_formats );

 return $settings;
}




/*
 * Check and see if the Genericons Library is enqueued.
 * The library should be since Jetpack should be enabled.
 * Mostly used in dev where Jetpack isn't usually enabled.
 *
 */
add_action('admin_enqueue_scripts', 'lc_check_for_icons');
 function lc_check_for_icons(){
  
  $handle = 'genericons';
  $list = 'enqueued';
  if ( wp_style_is( $handle, $list ) ){
   return;
  } else {
   wp_register_style( 'genericons', '//' . $_SERVER['SERVER_NAME'] . '/wp-content/themes/lorainccc-subsite/css/genericons/genericons.css' );
   wp_enqueue_style( 'genericons' );
  }
   
 }


?>