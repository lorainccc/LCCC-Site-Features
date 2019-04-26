<?php

// Add various fields to the JSON output
function lc_dept_directory_register_fields() {
	// Add First Name Field
	register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_firstname_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_firstname_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Middle Initial Field
		register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_minitial_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_minitial_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Last Name Field
	register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_lastname_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_lastname_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Suffix Field
	register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_suffix_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_suffix_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Phone Field
	register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_phone_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_phone_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Email Field
	register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_email_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_email_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Office Location Field
	register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_office_location_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_office_location_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Job Class Field
	register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_job_class_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_job_class_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Advisor Schedule Field
		register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_advisor_schedule_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_advisor_schedule_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Advisor Schedule Field
		register_api_field( 'faculty_staff_dir',
		'lc_fac_staff_dir_position_field',
		array(
			'get_callback'		=> 'lc_get_fac_staff_dir_position_field',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
}

function lc_get_fac_staff_dir_firstname_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_firstname_field');
}

function lc_get_fac_staff_dir_minitial_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_minitial_field');
}

function lc_get_fac_staff_dir_lastname_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_lastname_field');
}

function lc_get_fac_staff_dir_suffix_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_suffix_field');
}

function lc_get_fac_staff_dir_phone_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_phone_field');
}

function lc_get_fac_staff_dir_email_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_email_field');
}

function lc_get_fac_staff_dir_office_location_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_office_location_field');
}

function lc_get_fac_staff_dir_job_class_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_job_class_field');
}

function lc_get_fac_staff_dir_advisor_schedule_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_advisor_schedule_field');
}

function lc_get_fac_staff_dir_position_field( $object, $field_name, $request ) {
	return lc_deptdir_get_meta_field('lc_fac_staff_dir_position_field');
}

add_action( 'rest_api_init', 'lc_dept_directory_register_fields');

?>