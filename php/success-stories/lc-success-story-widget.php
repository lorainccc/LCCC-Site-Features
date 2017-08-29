<?php

/** Widget Code */

class LCCC_Success_Story_Widget extends WP_Widget {

 /**
  * Sets up the widgets name etc
  */
 	public function __construct() {
		$widget_ops = array(
			'classname' 		=> 'LCCC_Success_Story_Widget',
			'description' =>	'Displays a selected Success Story from a list of Success Stories.',
		);
		parent::__construct( 'LCCC_Success_Story_Widget', 'LCCC Success Story Display Widget', $widget_ops );
	}

 
 /**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
  extract( $args );
   // these are the widget options
   $lcsite = $instance['lcsite'];
			$storyurl = $instance['storyslug'];
  
  
   $success_story = new EndPoint( trailingslashit( 'http://' . $_SERVER['SERVER_NAME'] . $lcsite ) . 'wp-json/wp/v2/lc_success_story?slug=' . $storyurl);

    $multi = new MultiBlog( 1 );

   //Add endpoints to instance
   if ( $success_story != '' ){
    $multi->add_endpoint ( $success_story );
   };
  
   $content = $multi->get_posts();
   if(empty ($content)){
    echo 'No Posts Found!';
   }
   
    echo '<div class="row">';
    echo ' <div class="small-12 columns">';
    echo '<h2>' . $content[0]->title->rendered . '</h2>';
    echo ' </div>';
    echo ' <div class="small-12 medium-3 columns">';
    echo '   <img src="' . $content[0]->better_featured_image->media_details->sizes->thumbnail->source_url .'" class="float-center" alt="' . $content[0]->title->rendered . '" border="0">';
    echo ' </div>';
    echo ' <div class="small-12 medium-9 columns">';
    echo $content[0]->excerpt->rendered;
    echo '  <p><a href="' . $content[0]->link . '">' . $content[0]->lc_success_story_url_label_field . '</a></p>';
    echo ' </div>';
    echo '</div>';
 
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
     $lcsite = esc_attr($instance['lcsite']);
					$storyslug = esc_attr($instance['storyslug']);
} else {
     $lcsite = '';
					$storyslug = '';
}
?>
  <label for="<?php echo $this->get_field_id('lcsite');?>">Site URL: </label>
  <input type="text" name="<?php echo $this->get_field_name('lcsite');?>" id="<?php echo $this->get_field_id('lcsite');?>" value="<?php echo $lcsite;?>" size="40" />
  
  <label for="<?php echo $this->get_field_id('storyslug');?>">Story Slug: </label>
  <input type="text" name="<?php echo $this->get_field_name('storyslug');?>" id="<?php echo $this->get_field_id('storyslug');?>" value="<?php echo $storyslug;?>" size="40" />

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
		       $instance = $old_instance;
      // Fields
     		$instance['lcsite'] = strip_tags($new_instance['lcsite']);
       $instance['storyslug'] = strip_tags($new_instance['storyslug']);
  
		return $instance;
	}
 
}
add_action( 'widgets_init', function(){
	register_widget( 'LCCC_Success_Story_Widget' );
});
?>