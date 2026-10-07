<?php

/** Widget Code */
class LCCC_Handshake_Feed_Widget extends WP_Widget {

	/**
	 * Sets up the widget's name and attributes
		*/
	public function __construct() {

		$widget_ops = array(
			'classname' 		=> 'LCCC_Handshake_Feed_Widget',
			'description'       => 'LCCC feed widget for displaying events from Handshake.',
		);
		parent::__construct( 'LCCC_Handshake_Feed_Widget', 'LCCC Handshake Feed Widget', $widget_ops );
	}

	/**
		* Outputs the content of the widget
		*
		* @param array $args
		* @param array $instance
		*
		*/

    public function widget( $args, $instance ) {

        $lc_feed_url = $instance['lc_feed_url'];

        $lc_curl = curl_init();

        curl_setopt($lc_curl, CURLOPT_URL, $lc_feed_url);
        curl_setopt($lc_curl, CURLOPT_HEADER, 0);
        curl_setopt($lc_curl, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($lc_curl, CURLOPT_FOLLOWLOCATION, 1);

        $lc_output = curl_exec($lc_curl);

        curl_close($lc_curl);

        $lc_output = simplexml_load_string($lc_output);

        $itemcount = count($lc_output->channel->item);

        if($itemcount > 0){

            //outputs the content of the widget
            extract( $args );
            // these are the widget options
            $lc_number_of_posts = $instance['lc_number_of_posts'];
            $lc_number_of_posts = $lc_number_of_posts - 1;

            if($itemcount < $lc_number_of_posts){
                $lc_number_of_posts = $itemcount-1;
            }

            $lc_feed_name = $instance['lc_feed_name'];

            echo $before_widget;
            echo '<div id="' . strtolower( str_replace( ' ', '-', $lc_feed_name ) ) . '" class="lc-handshake-feed">';
            
            for( $i=0; $i<=$lc_number_of_posts; $i++)
                {
                    $lc_title = $lc_output->channel->item[$i]->title;
                    $lc_descr = $lc_output->channel->item[$i]->description;
                    $lc_link = $lc_output->channel->item[$i]->link;

                    $lc_descr = str_replace("When:", "<b>When:</b>", $lc_descr);

                    echo '<div class="lc-handshake-feed-item">';
                    echo '  <h2><a href="' . $lc_link . '" title="Click to view ' . $lc_title  . ' on Handshake" target="_blank">' . $lc_title . '</a></h2>';
                    echo '  <p>' . $lc_descr . '</p>';
                    echo '</div>';
                }   
            echo '</div>';
        }
    }

	/**
		*	Outputs the options form on admin
		*
		* @param array $instance The widget options
		*/

	public function form($instance) {
		// outputs the options form on admin

		// Check values
		if( $instance ){
            $lc_feed_url = esc_attr($instance['lc_feed_url']);
            $lc_number_of_posts = esc_attr($instance['lc_number_of_posts']);
            $lc_feed_name = esc_attr($instance['lc_feed_name']);
        } else {
            $lc_number_of_posts = '';
        }
    //Start HTML for Admin Panel
    ?> 

        <p>
            <label for="<?php echo $this->get_field_id('lc_feed_url'); ?>"><?php _e('Feed URL', 'lc_handshake_feed'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('lc_feed_url'); ?>" id="<?php echo esc_attr( $this->get_field_id('lc_feed_url') ); ?>" class="widefat" value="<?php echo esc_attr( $lc_feed_url ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('lc_feed_name'); ?>"><?php _e('Feed Name', 'lc_handshake_feed'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('lc_feed_name'); ?>" id="<?php echo esc_attr( $this->get_field_id('lc_feed_name' ) ); ?>" class="widefat" value="<?php echo esc_attr( $lc_feed_name ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('lc_number_of_posts'); ?>"><?php _e('Number of posts', 'lc_handshake_feed'); ?></label>
            <select name="<?php echo $this->get_field_name('lc_number_of_posts'); ?>" id="<?php echo $this->get_field_id('lc_number_of_posts'); ?>">
                <?php
                    $options = array('select..', 5, 10, 15);
                foreach ($options as $option) {
                    echo '<option value="' . $option . '" id="' . $option . '"', $lc_number_of_posts == $option ? 'selected="selected"' : '', '>', $option, '</option>';
                }
                ?>
            </select>
        </p>

    <?php
    //End HTML for Admin Panel
    }

    /**
    * Processing widget options on save
    *
    * @param array $new_instance 'The new options'.
    * @param array $old_instance 'The previous (old) options'.
    */

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = $old_instance;
		// fields
        $instance['lc_feed_url'] = ( ! empty( $new_instance['lc_feed_url'] ) ) ? sanitize_text_field( $new_instance['lc_feed_url'] ) : '';
		$instance['lc_number_of_posts'] = ( ! empty( $new_instance['lc_number_of_posts'] ) ) ? sanitize_text_field( $new_instance['lc_number_of_posts'] ) : '';
		$instance['lc_feed_name']= ( ! empty( $new_instance['lc_feed_name'] ) ) ? sanitize_text_field( $new_instance['lc_feed_name'] ) : '';
        return $instance;
	}
}

function lc_register_handshake_widget(){
    register_widget( 'LCCC_Handshake_Feed_Widget' );
}

add_action( 'widgets_init', 'lc_register_handshake_widget' );