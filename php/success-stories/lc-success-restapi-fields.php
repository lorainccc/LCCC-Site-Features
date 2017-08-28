<?php

// Add various fields to the JSON output
function lc_success_story_api_register_fields() {
	// Add Start Date
	register_api_field( 'lc_success_story',
		'lc_success_story_url_label_field',
		array(
			'get_callback'		=> 'lccc_get_success_story_label_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
} 

function lccc_get_success_story_label_field( $object, $field_name, $request ) {
	return event_meta_box_get_meta('lc_success_story_url_label_field');
}

add_action( 'rest_api_init', 'lc_success_story_api_register_fields');

?>