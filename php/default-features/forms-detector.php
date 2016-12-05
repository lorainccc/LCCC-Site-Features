<?php

// LCCC Forms Detector Widget

add_action( 'wp_dashboard_setup', 'lc_admin_dashboard_widgets' );

function lc_admin_dashboard_widgets() {

 global $wp_meta_boxes;

 wp_add_dashboard_widget( 'lc_form_detector_admin_widget', 'LCCC Forms', 'lc_form_detector_render_admin_widget' );  // Widget ID, Widget Name(appears in header), Callback Function (used to render widget)

 // Globalize the metaboxes array, this holds all the widgets for wp-admin

 global $wp_meta_boxes;

 // Get the regular dashboard widgets array
 // (which has our new widget already but at the end)

 $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

 // Backup and delete our new dashboard widget from the end of the array

 $lc_widget_backup = array( 'lc_form_detector_admin_widget' => $normal_dashboard['lc_form_detector_admin_widget'] );
 unset( $normal_dashboard['lc_form_detector_admin_widget'] );

 // Merge the two arrays together so our widget is at the beginning

 $sorted_dashboard = array_merge( $lc_widget_backup, $normal_dashboard );

 // Save the sorted array back into the original metaboxes

 $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;

}

function lc_form_detector_render_admin_widget() {
 echo '<h1>List of forms on this site</h1>';
 echo '<p>Below is a list of all pages, in this site, with a link to the form at Firmstep.  The page name is also linked to the page editor.</p>';
 $page_ids = get_all_page_ids();
  echo '<ul style="list-style: disc; margin: 0 0 0 25px;">';
 foreach( $page_ids as $page ){
  $form = get_post_meta( $page, '_FirmstepRRCUrl', true );

  if ($form != ''){
    echo '<li><a href="post.php?post=' . $page . '&action=edit" target="_blank">'  . get_the_title( $page ) . '</a> - <a href="' . get_permalink( $page ) . '" target="_blank">View Page</a> - <a href="http://lorainccc.firmstep.com/default.aspx' . $form . '" target="_blank">View Form at Firmstep</a></li>';
   }

 }
  echo '</ul>';
 
 $query_img_args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'posts_per_page' => -1,
    );
    $query_img = new WP_Query( $query_img_args );
    echo '<p>Total Media Items: ' . $query_img->post_count . '</p>';
 
}

?>