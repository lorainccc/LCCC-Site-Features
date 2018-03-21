<?php

// Add various fields to the JSON output
function lc_dept_directory_register_fields() {
	// Add Start Date
	register_api_field( 'lccc_events',
		'event_start_date',
		array(
			'get_callback'		=> 'gofurther_get_event_start_date',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
}

function gofurther_get_event_start_date( $object, $field_name, $request ) {
	return event_meta_box_get_meta('event_start_date');
}

add_action( 'rest_api_init', 'lc_dept_directory_register_fields');

?>