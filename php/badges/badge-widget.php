<?php
/**
 * WordPress Badge Widget
 * @package   Badge_Widget
 * @author    LCCC Web Developement Team
 * @license   GPL-2.0+
 * @link      http://www.lorainccc.edu
 * @copyright 2016 Lorain County Community College
 */
 
 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}
// TODO: change 'Badge_Widget' to the name of your plugin
class Badge_Widget extends WP_Widget {
    /**
     * @TODO - Rename "badge-widget" to the name your your widget
     *
     * Unique identifier for your widget.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * widget file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $widget_slug = 'badge-widget';
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {
		// load plugin text domain
		add_action( 'init', array( $this, 'lorainccc_badge' ) );
		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		// TODO: update description
		parent::__construct(
			$this->get_widget_slug(),
			__( 'LCCC Badge Widget', $this->get_widget_slug() ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'This widget is for displaying the LCCC badges.', $this->get_widget_slug() )
			)
		);
			// Refreshing the widget's cached output with each new post
		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	} // end constructor
    /**
     * Return the widget slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_widget_slug() {
        return $this->widget_slug;
    }
	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/
	/**
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {
		
		$numberofposts = $instance['numberofposts'];
		$mediumdisplay= round($numberofposts/2, 0, PHP_ROUND_HALF_DOWN);
		$widgetcategory = $instance['category'];
			$badge_orientation = $instance['badge-orientation'];	
	
		if(	$badge_orientation == 'horizontal'){?>
			<div class="row small-up-1 medium-up-<?php echo $mediumdisplay ?> large-up-<?php echo $numberofposts ?>">
  <?php
				$badgeargs=array(
					'post_type' => 'badges',
					'post_status' => 'publish',
  			'posts_per_page' => $numberofposts,
					);	
					$newbadges = new WP_Query($badgeargs);
					if ( $newbadges->have_posts() ) :
							while ( $newbadges->have_posts() ) : $newbadges->the_post();
					$bgcolor = badge_metabox_get_meta('badge_metabox_color_scheme_select');
					$icon = badge_metabox_get_meta('badge_metabox_icon_selector');
					$redirectlink= badge_metabox_get_meta('badge_metabox_redirect_link');
				?>
						<a href="<?php echo $redirectlink; ?>">
								<div class="column lccc-badge  <?php echo $bgcolor; ?>">
								  		<div class="small-3 columns medium-3 large-3 columns icon-container">
												<div class="small-3 columns medium-3 large-3 columns icon <?php echo $icon; ?>">
									
									 		</div>
									 </div>
										<div class="small-9 columns medium-9 large-9 columns icon">
															<?php echo 'hello'; ?>
									 </div>
								</div>
							</a>
							<?php
							endwhile;
					endif;																																					
				?>

</div>
		<?php }
		if(	$badge_orientation == 'vertical'){?>
			<div class="row small-up-1 medium-up-1 large-up-1">
  			  <?php
				$badgeargs=array(
					'post_type' => 'badges',
					'post_status' => 'publish',
  			'posts_per_page' => $numberofposts,
					);	
					$newbadges = new WP_Query($badgeargs);
					if ( $newbadges->have_posts() ) :
							while ( $newbadges->have_posts() ) : $newbadges->the_post();
				$bgcolor = badge_metabox_get_meta('badge_metabox_color_scheme_select');
			$icon = badge_metabox_get_meta('badge_metabox_icon_selector');
				$redirectlink= badge_metabox_get_meta('badge_metabox_redirect_link');
				?>
				<a href="<?php echo $redirectlink; ?>">
								<div class="column lccc-badge <?php echo $bgcolor; ?>">
										<div class="small-3 columns medium-3 large-3 columns icon-container">
												<div class="small-3 columns medium-3 large-3 columns icon <?php echo $icon; ?>">
									
									 		</div>
									 </div>
										<div class="small-9 columns medium-9 large-9 columns badge-text">
															<?php the_title('<h3>','</h3>'); ?>
															<?php the_content('<p>','</p>'); ?>
									 </div>
								</div>
					</a>
							<?php
							endwhile;
					endif;																																					
				?>
			</div>
	<?php	}

	} // end widget
	
	
	public function flush_widget_cache() 
	{
    	wp_cache_delete( $this->get_widget_slug(), 'widget' );
	}
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
   // Fields
     		$instance['numberofposts'] = strip_tags($new_instance['numberofposts']);
							$instance['badge-orientation'] = strip_tags($new_instance['badge-orientation']);
		 				$instance['category'] = strip_tags($new_instance['category']);
		return $instance;
	} // end widget
	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {
	// outputs the options form on admin
		
// Check values
if( $instance) {
					$numberofposts = esc_attr($instance['numberofposts']);
					$badgeorientation = esc_attr($instance['badge-orientation']);
					$widgetcategory = esc_attr($instance['category']);
} else {
					$numberofposts = '';
					$badgeorientation = '';
					$widgetcategory = '';
}
?>

<p>
<label for="<?php echo $this->get_field_id('numberofposts'); ?>"><?php _e('Number of posts', 'wp_widget_plugin'); ?></label>
<select name="<?php echo $this->get_field_name('numberofposts'); ?>" id="<?php echo $this->get_field_id('numberofposts'); ?>">
<?php
$options = array('select..',1,2,3,4,5);
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $numberofposts == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('badge-orientation'); ?>"><?php _e('Badge Orientation', 'wp_widget_plugin'); ?></label>
<select name="<?php echo $this->get_field_name('badge-orientation'); ?>" id="<?php echo $this->get_field_id('badge-orientation'); ?>">
<?php
$oreintationoptions = array('select..','horizontal','vertical');
foreach ($oreintationoptions as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $badgeorientation == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select>
</p>

<?php
	
	} // end form
	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/
	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function lorainccc_badge() {
		// TODO be sure to change 'badge-widget' to the name of *your* plugin
		load_plugin_textdomain( $this->get_widget_slug(), false, plugin_dir_path( __FILE__ ) . 'lang/' );
	} // end lorainccc_badge
	/**
	 * Fired when the plugin is activated.
	 *
	 * @param  boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public function activate( $network_wide ) {
		// TODO define activation functionality here
	} // end activate
	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {
		// TODO define deactivation functionality here
	} // end deactivate
	
} // end class
add_action( 'widgets_init', create_function( '', 'register_widget("Badge_Widget");' ) );
?>