<?php

/*
 *   Custom shortcode to display a post from Post post type
 *   Utilizes the Featured Image, Post Title, Post Content
 * 
 */



// Add Shortcode
function lc_content_callout( $atts ) {

	// Attributes
	extract(shortcode_atts(array(
        'post_slug' => 'hello-world',
     ), $atts));

    $lc_calloutargs=array(
        'name'          => $post_slug,
        'post_type'     => 'post',
        );	
    
    $lc_calloutcontent = new WP_Query($lc_calloutargs); 
    
    if ($lc_calloutcontent->have_posts()) :
        while ($lc_calloutcontent->have_posts()) : $lc_calloutcontent->the_post();

        $lc_postid = get_the_ID();
        $lc_thumbnail = get_the_post_thumbnail( $lc_postid, 'medium' );
        $lc_title = get_the_title();
        $lc_content = get_the_content();

    $lc_return_string = '<div class="small-12 medium-12 large-12 columns lc-callout">';
 
    if($lc_thumbnail != ''){
        $lc_return_string .= '<div class="small-12 medium-3 large-3 columns">' . $lc_thumbnail . '</div>';
        $lc_return_string .= '<div class="small-12 medium-9 large-9 columns"><h2>' . $lc_title .'</h2>';
    }else{
        $lc_return_string .= '<div class="small-12 medium-12 large-12 columns"><h2>' . $lc_title .'</h2>';
    }

    $lc_return_string .= '<p>' . $lc_content . '</p></div>';
    $lc_return_string .= '</div>';

        endwhile;
    endif;

    wp_reset_query();
    
    return $lc_return_string;
}
function lc_register_shortcodes(){
    add_shortcode( 'lc_callout', 'lc_content_callout' );
}

add_action( 'init', 'lc_register_shortcodes');