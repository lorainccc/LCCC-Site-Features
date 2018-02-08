<?php
add_action( 'widgets_init', function(){
    register_widget( 'LCCC_four_O_four_Widget' );
});

class LCCC_four_O_four_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'lccc_four_o_four_widget',
            'description' => 'This is a widget designed to use the WordPress Rest API to pull content from a page 404 content located in the root website',
        );

        parent::__construct( 'four_o_four_widget', 'LCCC 404 Widget', $widget_ops );
    }


    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        // outputs the content of the widget
        echo $args['before_widget'];
											//Grab posts (endpoints)
  									//$domain = 'http://' . $_SERVER['SERVER_NAME'];
											//$contentendpoint = new Endpoint( $domain . '/wp-json/wp/v2/pages/531' );
											//$pages = $contentendpoint->get_posts();
										 //foreach ( $pages as $page ){
															//echo $page->content->rendered;
														echo '<p>The page you have requested has moved or is no longer available on our website. Please use the site search below or visit our <a href="/about/a-z-index">A-Z Index</a> for a list of our most popular pages.</p>';
														echo '<a class="button" href="/about/a-z-index/">A-Z Index</a>';
											//}
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin

        ?>
          
        <?php
    }


    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved


        return $updated_instance;
    }
}
