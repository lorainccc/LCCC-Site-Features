<?php

/*
 *   Custom shortcode to display a post from the Content Group Custom Post Type
 *   Utilizes the Featured Image, Post Title, Post Content
 * 
 */



// Add Shortcode for displaying all posts

function lc_content_group( $atts ) {
	/* 
    * -- Attributes --
    * If no post_count attribute is passed, display 3 posts.
    * If no orderby attribute is passed, order by title.
    * If no order attribute is passed, display in Ascending (asc) order.
    */
	extract(shortcode_atts(array(
        'post_count'    => '3',
        'orderby'       => 'title',
        'order'         => 'asc',
     ), $atts));

    $lc_contentgroupargs=array(
        'post_count'    => $post_count,
        'post_type'     => 'content_group',
        'post_status'   => 'publish',
        'orderby'       => $orderby,
        'order'         => $order,
        );	
    
    $lc_contentgroup = new WP_Query($lc_contentgroupargs); 
    
    if ($lc_contentgroup->have_posts()) :
        while ($lc_contentgroup->have_posts()) : $lc_contentgroup->the_post();
        ?>
    
        <section class="row gateway-links">
            <div class="small-12 medium-3 large-3 columns">
                <?php the_post_thumbnail(); ?>		
            </div>
            <div class="small-12 medium-9 large-9 columns gtwymenu-content">
                <?php the_title('<h2>','</h2>' );?>
                <?php the_content('<p>','</p>'); ?>
            </div>
        </section>
<?php
        endwhile;
    endif;

    wp_reset_query();
    
    return $lc_return_string;
}

// Add Shortcode for displaying single post from the Content Group Custom Post Type

function lc_single_content_group( $atts ) {

	/* 
    * -- Attributes --
    * If no post_count attribute is passed, display 3 posts.
    * If no orderby attribute is passed, order by title.
    * If no order attribute is passed, display in Ascending (asc) order.
    */
	extract(shortcode_atts(array(
        'post_slug'    => 'hello-world',
     ), $atts));

    $lc_singlecontentargs=array(
        'name'          => $post_slug,
        'post_count'    => 1,
        'post_type'     => 'content_group',
        );	

    $lc_singlecontent = new WP_Query($lc_singlecontentargs); 

    if ($lc_singlecontent->have_posts()) :
        while ($lc_singlecontent->have_posts()) : $lc_singlecontent->the_post();
        ?>
    
        <section class="row single-content-group">
            <div class="small-12 medium-3 large-3 columns">
                <?php the_post_thumbnail(); ?>		
            </div>
            <div class="small-12 medium-9 large-9 columns gtwymenu-content">
                <?php the_title('<h2>','</h2>' );?>
                <?php the_content('<p>','</p>'); ?>
            </div>
        </section>
<?php
        endwhile;
    endif;

    wp_reset_query();
    
    return $lc_return_string;
}

function lc_cntgroup_register_shortcodes(){
    add_shortcode( 'lc_contentgroup', 'lc_content_group' );
    add_shortcode( 'lc_singlecontent', 'lc_single_content_group' );
}

add_action( 'init', 'lc_cntgroup_register_shortcodes');
