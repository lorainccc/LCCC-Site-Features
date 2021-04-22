<?php

/*
 * 
 *
 */

 /** Widget Code */

class LCCC_Content_Tile_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
        public function __construct() {
           $widget_ops = array(
               'classname' 		=> 'LCCC_Content_Tile_Widget',
               'description' =>	'LCCC Custom Content Widget.  Displays content in various output layouts.',
           );
           parent::__construct( 'LCCC_Content_Tile_Widget', 'LCCC Content Tile Widget', $widget_ops );
       }
   
    /**
        * Outputs the content of the widget
        *
        * @param array $args
        * @param array $instance
        */
       public function widget( $args, $instance ) {
        extract( $args );

        echo $after_widget;
       }

    	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin

        // Check values
        if( $instance) {
            $layout = esc_attr($instance['layout']);
            $numberofposts = esc_attr($instance['numberofposts']);
            $widgetcategory = esc_attr($instance['category']);
            $selectedfeedtype = esc_attr($instance['selectedfeedtype']);
        } else {
            $layout = '';
            $numberofposts = '';
            $widgetcategory = '';
            $selectedfeedtype = '';
        }

    } 

    /**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
            $instance = $old_instance;
        // Fields
            $instance['layout'] = strip_tags($new_instance['layout']);
            $instance['numberofposts'] = strip_tags($new_instance['numberofposts']);
            $instance['selectedfeedtype'] = strip_tags($new_instance['selectedfeedtype']);
            $instance['category'] = $new_instance['category'];
             
		return $instance;
	}
}
add_action( 'widgets_init', function(){
	register_widget( 'LCCC_Announcement_Feed_Widget' );
});