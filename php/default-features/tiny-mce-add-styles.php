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

    $url .= '//' . $_SERVER['SERVER_NAME'] . '/wp-content/plugins/lccc-site-features/css/editor-style.css';

    // Change URL for CSS to theme
    //$url .= '//' . $_SERVER['SERVER_NAME'] . '/wp-content/themes/lorainccc/css/editor-style.css';

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

$siteUrl = get_blog_details()->path;

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
        array(
         'title' => 'Blue Button 250px',
         'selector' => 'a',
         'classes' => 'blue-button-250'
        ),
        array(
         'title' => 'Blue Button 300px',
         'selector' => 'a',
         'classes' => 'blue-button-300'
        ),
    );

    $lc_theme_options = get_option( 'lc_theme_settings' );
    
    if($lc_theme_options['lc_enable_teal_buttons_field'] == '1'){
        $style_format = array(
            array(
                'title' => 'Teal Button',
                'selector' => 'a',
                'classes' => 'blue-button teal-button'
               ),
            array(
                'title' => 'Teal Button 250px',
                'selector' => 'a',
                'classes' => 'blue-button-250 teal-button'
               ),
            array(
                'title' => 'Teal Button 300px',
                'selector' => 'a',
                'classes' => 'blue-button-300 teal-button'
            ),
        );
        $style_formats = array_merge( $style_formats, $style_format);
    }

    if($lc_theme_options['lc_enable_drkred_buttons_field'] == '1'){
        $style_format = array(
            array(
                'title' => 'Dark Red Button',
                'selector' => 'a',
                'classes' => 'blue-button dark-red-button'
               ),
            array(
                'title' => 'Dark Red Button 250px',
                'selector' => 'a',
                'classes' => 'blue-button-250 dark-red-button'
               ),
            array(
                'title' => 'Dark Red Button 300px',
                'selector' => 'a',
                'classes' => 'blue-button-300 dark-red-button'
            ),
        );
        $style_formats = array_merge( $style_formats, $style_format);
    }



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