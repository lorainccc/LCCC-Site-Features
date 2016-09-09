	<p>
<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'wp_widget_plugin'); ?></label>

<select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>"class="widefat">
		<?php
  // Get categories as array
  $categories = get_categories( $args );
  foreach ( $categories as $category ) :
  		echo '<option value="' . $category->name . '" id="' . $category->term_id . '"', $widgetcategory == $category->name ? ' selected="selected"' : '', '>', $category->name, '</option>';
  endforeach;
?>
</select>		
		
</p>