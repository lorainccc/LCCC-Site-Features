<?php

/** Widget Code */
/**
  * CPT Name:                   lc_program_chart
  * Custom Taxonomy Name:       program_chart
  */

class LCCC_Program_Path_Chart_Widget extends WP_Widget {

 /**
  * Sets up the widgets name etc
  */
 	public function __construct() {
		$widget_ops = array(
			'classname' 		=> 'LCCC_Program_Path_Chart_Widget',
			'description' =>	'Displays a set of Program Paths from a particular Category.',
		);
		parent::__construct( 'LCCC_Program_Path_Chart_Widget', 'LCCC Program Path Chart Widget', $widget_ops );
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
   $lcprogram_category = $instance['lcprogram_category'];
	
  $category_title = get_term_by('slug', $lcprogram_category, 'program_chart');
  
    
  // Query posts in Program Chart CPT for each Type of Chart Item
  
  $args = array(
   'post_type'       => 'lc_program_chart',
   'post_status'     => 'publish',
   'tax_query'       => array(
       array(
          'taxonomy' => 'program_chart',
          'field'    => 'slug',
          'terms'    => $category_title->slug,
       )
   ),
  );
  
  $paths = new WP_Query( $args );

  echo '<div class="row">';
  echo ' <div class="small-12 columns">';
  echo '  <p class="chart-title">' . $category_title->name . '</p>';
  echo ' </div>';
  echo '</div>';
  
  echo '<div class="row chart-header">';
  echo ' <div class="medium-4 show-for-medium columns chart-header-item">Short Term Certificate</div>';
  echo ' <div class="medium-4 show-for-medium columns chart-header-item">One Year Certificate</div>';
  echo ' <div class="medium-4 show-for-medium columns chart-header-item">Associate Degree</div>';
  echo '</div>';
  
		//echo $paths->post_count;
		
  // Check for Short Term posts
  if ($paths->have_posts()){

			$bol_short_term = false;
			$bol_one_year = false;
			$bol_associate = false;

			while ($paths->have_posts()) {
				$paths->the_post();
				echo '<div class="medium-4 show-for-medium columns"><p class="chart-item"><a href="' . get_post_meta( get_the_ID(), lc_prog_chart_short_term_link_field, true) . '">' . get_post_meta( get_the_ID(), lc_prog_chart_short_term_link_label_field, true ) . '</a></p></div>';
				echo '<div class="medium-4 show-for-medium columns"><p class="chart-item"><a href="' . get_post_meta( get_the_ID(), lc_prog_chart_one_year_link_field, true) . '">' . get_post_meta( get_the_ID(), lc_prog_chart_one_year_link_label_field, true ) . '</a></p></div>';
				echo '<div class="medium-4 show-for-medium columns"><p class="chart-item"><a href="' . get_post_meta( get_the_ID(), lc_prog_chart_assoc_degree_link_field, true) . '">' . get_post_meta( get_the_ID(), lc_prog_chart_assoc_degree_link_label_field, true ) . '</a></p></div>';
			}
			
				
					// begin small formatting
				while ($paths->have_posts()) {
				$paths->the_post();
				
							if($bol_short_term == false){
								echo '<div class="row show-for-small-only chart-header" style="margin: 10px 0;">';
								echo ' <div class="small-12 show-for-small-only columns chart-header-item">Short Term Certificate</div>';
								echo '</div>';
								$bol_short_term = true;
							}

							if(get_post_meta( get_the_ID(), lc_prog_chart_short_term_link_label_field, true) != ''){
									echo '<div class="row">';
									echo '		<div class="small-12 show-for-small-only columns">';
									echo '				<p class="chart-item"><a href="' . get_post_meta( get_the_ID(), lc_prog_chart_short_term_link_field, true) . '">' . get_post_meta( get_the_ID(), lc_prog_chart_short_term_link_label_field, true) . '</a></p>';
									echo '		</div>';
									echo '</div>';
								} else {
									echo '<div class="row">';
									echo '	<div class="small-12 show-for-small-only columns">&nbsp;</div>';
									echo '</div>';
								}

				}
			
				while ($paths->have_posts()) {
				$paths->the_post();

						if($bol_one_year == false){
									echo '<div class="row show-for-small-only chart-header" style="margin: 10px 0;">';				
									echo ' <div class="small-12 show-for-small-only columns chart-header-item">One Year Certificate</div>';
									echo '</div>';
								$bol_one_year = true;
							}
					
							if(get_post_meta( get_the_ID(), lc_prog_chart_one_year_link_label_field, true) != ''){
								echo '<div class="row">';
								echo '		<div class="small-12 show-for-small-only columns">';
								echo '				<p class="chart-item"><a href="' . get_post_meta( get_the_ID(), lc_prog_chart_one_year_link_field, true) . '">' . get_post_meta( get_the_ID(), lc_prog_chart_one_year_link_label_field, true) . '</a></p>';
								echo '		</div>';
								echo '</div>';
							} else {
								echo '<div class="row">';
								echo '		<div class="small-12 show-for-small-only columns">&nbsp;</div>';
								echo '</div>';
							}
				}
			
				while ($paths->have_posts()) {
				$paths->the_post();
			
						if($bol_associate == false){				
								echo '<div class="row show-for-small-only chart-header" style="margin: 10px 0;">';
								echo ' <div class="small-12 show-for-small-only columns chart-header-item">Associate Degree</div>';
								echo '</div>';
								$bol_associate = true;
							}

							if(get_post_meta( get_the_ID(), lc_prog_chart_assoc_degree_link_label_field, true) != ''){
								echo '<div class="row">';
								echo '		<div class="small-12 show-for-small-only columns">';
								echo '				<p class="chart-item"><a href="' . get_post_meta( get_the_ID(), lc_prog_chart_assoc_degree_link_field, true) . '">' . get_post_meta( get_the_ID(), lc_prog_chart_assoc_degree_link_label_field, true) . '</a></p>';
								echo '		</div>';
								echo '</div>';
							} else {
								echo '<div class="row">';
								echo '  <div class="medium-4 show-for-medium columns">&nbsp;</div>';
								echo '</div>';
							}
										
					}

   }
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
     $lcprogram_category = esc_attr($instance['lcprogram_category']);
} else {
     $lcprogram_category = '';
}
  
   $taxonomy = 'program_chart';
  
  $programchart_cats = get_terms($taxonomy);

?>

<p>
 <label for="<?php echo $this->get_field_id('lcprogram_category'); ?>"><?php _e('Program Chart:', 'lorainccc'); ?></label>
 <select name="<?php echo $this->get_field_name('lcprogram_category'); ?>" id="<?php echo $this->get_field_id('lcprogram_category'); ?>">
 <?php
    
 foreach ($programchart_cats as $chart) {
 echo '<option value="' . $chart->slug . '" id="' . $chart->slug . '"', $lcprogram_category == $chart->name ? ' selected="selected"' : '', '>', $chart->name, '</option>';
 }
 ?>
 </select>
</p> 

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
     		$instance['lcprogram_category'] = strip_tags($new_instance['lcprogram_category']);
  
		return $instance;
	}
 
}
add_action( 'widgets_init', function(){
	register_widget( 'LCCC_Program_Path_Chart_Widget' );
});
 ?>