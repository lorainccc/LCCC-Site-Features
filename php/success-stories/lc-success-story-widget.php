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
			$lc_story_title = $instance['lcstorytitle'];
  
  
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
   

    echo '<div class="row medium-collapse" data-equalizer style="border-bottom: 2px solid #ffc600;">';
				echo '  <div class="small-12 medium-3 columns" data-equalizer-watch>';
    echo '   <img src="' . $content[0]->better_featured_image->media_details->sizes->medium->source_url .'" style="width:100%; height:100%;border:none;" class="float-right" alt="' . $content[0]->title->rendered . '">';
				echo '  </div>';
				echo '  <div class="small-12 medium-9 columns" data-equalizer-watch style="box-shadow:inset 0 0 10px #e3e3e3;">';
				echo '    <div class="row" style="background: #0c3b78;">';
				echo '						<div class="small-12 columns">';
		  // $lc_story_title = widget title for feature
				echo '    	  <h2 style="color:#ffc600; font-weight:700; text-align:center;">' . $lc_story_title . '</h2>';
				echo '						</div>';
				echo '    </div>';
				echo '    <div class="row">';
				echo '      <div class="small-12 columns">';
	   echo '			      <h3 class="success-story">' . $content[0]->title->rendered . '</h3>';	
				echo $content[0]->excerpt->rendered;
	   echo '         <p><span class="wp-svg-arrow-right-3 arrow-right-3"></span> <a href="' . $content[0]->link . '">' . $content[0]->lc_success_story_url_label_field . '</a></p>';	
		  echo '      </div>';
		  echo '    </div>';
		  echo '  </div>';
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
					$lcstorytitle = esc_attr($instance['lcstorytitle']);
} else {
     $lcsite = '';
					$storyslug = '';
					$lc_story_title = '';
}
?>

  <label for="<?php echo $this->get_field_id('lcstorytitle');?>">Site URL: </label>
  <input type="text" name="<?php echo $this->get_field_name('lcstorytitle');?>" id="<?php echo $this->get_field_id('lcstorytitle');?>" value="<?php echo $lcstorytitle;?>" size="40" />

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
							$instance['lcstorytitle'] = strip_tags($new_instance['lcstorytitle']);
  
		return $instance;
	}
 
}
add_action( 'widgets_init', function(){
	register_widget( 'LCCC_Success_Story_Widget' );
});
?>