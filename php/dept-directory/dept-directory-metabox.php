<?php

/*
		*	Code adapted from https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress
		*	Created July 2016.
		*
		*/

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'lc_dept_directory_meta_boxes_setup' );
add_action( 'load-post-new.php', 'lc_dept_directory_meta_boxes_setup' );

/* Meta box setup function */
function lc_dept_directory_meta_boxes_setup() {
 /* Add meta boxes on the 'add_meta_boxes' hook. */
 add_action( 'add_meta_boxes', 'lc_add_dept_directory_meta_box' );

 /* Save post meta on the 'save_post' hook. */
 add_action( 'save_post', 'lc_dept_directory_save_info', 10, 2 );
}


/* Create one or meta boxes to be displayed on the post editor screen */
function lc_add_dept_directory_meta_box() {
 add_meta_box(
  'lc_dept_directory_metabox',                                    // Unique ID (ID of Div Tag ** Note: DO NOT NAME same as field(s) below **)
  esc_html__( 'Department Directory Entry', 'lorainccc' ),        // Title & Text Domain
  'lc_show_dept_directory_meta_box',                              // Callback function
  'faculty_staff_dir',                                            // Admin Page or Post Type
  'normal',                                                       // Context (Position)
  'default'                                                       // Priority
 );
}

/* Display the post meta box */
function lc_show_dept_directory_meta_box( $object, $box ) { ?>

 <?php wp_nonce_field( basename( __FILE__ ), 'lc_dept_directory_post_nonce' ); ?>
  <h2>Please enter your details.</h2>
  <p>
   <label for="lc_fac_staff_dir_firstname_field">
    <?php _e( "First Name: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_firstname_field" id="lc_fac_staff_dir_firstname_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_firstname_field', true ) ); ?>" size="30" disabled=true style="border:0;" />
  </p>

  <p>
   <label for="lc_fac_staff_dir_minitial_field">
    <?php _e( "Middle Initial: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_minitial_field" id="lc_fac_staff_dir_minitial_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_minitial_field', true ) ); ?>" size="5" />
  </p> 

  <p>
   <label for="lc_fac_staff_dir_lastname_field">
    <?php _e( "Last Name: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_lastname_field" id="lc_fac_staff_dir_lastname_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_lastname_field', true ) ); ?>" size="30" disabled=true style="border:0;" />
  </p>

  <p>
   <label for="lc_fac_staff_dir_suffix_field">
    <?php _e( "Suffix: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_suffix_field" id="lc_fac_staff_dir_suffix_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_suffix_field', true ) ); ?>" size="15" />
  </p> 

  <p>
   <label for="lc_fac_staff_dir_phone_field">
    <?php _e( "Phone Extension: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_phone_field" id="lc_fac_staff_dir_phone_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_phone_field', true ) ); ?>" size="30" />
   <br/><span>Please enter full number if it does not start with (440) 366</span>
  </p>

  <p>
   <label for="lc_fac_staff_dir_email_field">
    <?php _e( "Email: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_email_field" id="lc_fac_staff_dir_email_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_email_field', true ) ); ?>" size="45" />
  </p>

  <p>
   <label for="lc_fac_staff_dir_office_location_field">
    <?php _e( "Office Location: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_office_location_field" id="lc_fac_staff_dir_office_location_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_office_location_field', true ) ); ?>" size="30" />
  </p>

  <!-- <p>
   <label for="lc_fac_staff_dir_department_name_field">
    <?php _e( "Department: ", "lorainccc" ); ?>
   </label>
   <select name="lc_fac_staff_dir_department_name_field" id="lc_fac_staff_dir_department_name_field"> -->
   <?php
     /* $departments = array('select..','Academic and Learner Services','Academic Support Center','Administrative Services','Allied Health and Nursing Division','Arts and Humanities Division','Athletics','Auxiliary Services','Blackstone Launchpad','Bookstore','Bursars Office','Campus Security','Center for LifeLong Learning','Center for Teaching Excellence','Childrens Learning Center','College Tech Prep Consortium','COMPASS Testing Lab','Controllers Office','Digital Media Communications','Dining Services','Disability Services','Early College High School','eLearning','Engineering Business and Information Technologies Division','Enrollment Financial and Career Services','Entrepreneurship Innovation Institute','Faculty Senate Office','GLIDE','Human Resources Office','Information Systems and Services','InnovatEd','Institutional Effectiveness and Planning','International Initiatives','LCCC ABLE Consortium','LCCC Foundation Development Office','LCCC Lorain Learning Center','Learner Completion','Library and eLearning','Marketing and Outreach Initiatives','Midpoint Campus Center','Payroll Office','Physical Plant Operations','Presidents Office','Public Services Institute and Joint Center for Policy Research','Purchasing Facility Planning Office','REACHigher','Science and Mathematics Division','Small Business Development Center','SMART Commercialization Center for Microsystems','Social Sciences and Human Services Division','Spitzer Conference Center','Stocker Humanities and Fine Arts Center','Strategic and Institutional Development','Student Life','University Partnership','University Partnership Ridge Campus','USO Talent Development Network Resource Center','Weld-Ed','Wellington Center','Womens Link','Workforce Institute');

     foreach ( $departments as $department ) {
      $departmentslug = strtolower(str_replace(' ', '-', $department));

      switch ($departmentslug) {
       case "allied-health-and-nursing-division":
        $departmentslug = 'allied-health';
        break;

       case "arts-and-humanities-division":
        $departmentslug = 'arts-and-humanities';
        break;

       case "engineering-business-and-information-technologies-division":
        $departmentslug = 'ebit';
        break;

       case "purchasing-facility-planning-office":
        $departmentslug = 'purchasing';
        break;

       case "public-services-institute-and-joint-center-for-policy-research":
        $departmentslug = 'psi-jcpr';
        break;

       case "science-and-mathematics-division":
        $departmentslug = 'science-and-math';
        break;

       case "social-sciences-and-human-services-division":
        $departmentslug = 'social-sciences';
        break;

       case "spitzer-conference-center":
        $departmentslug = 'spitzer-center';
        break;

       case "stocker-humanities-and-fine-arts-center":
        $departmentslug = 'stocker-center';
        break;

       case "uso-talent-development-network-resource-center":
        $departmentslug = 'usotdn';
        break;
      }

      $selectedDepartment = esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_department_name_field', true ) );
      echo '<option value="' . $departmentslug .'" id="' . $departmentslug . '"', $selectedDepartment == $departmentslug ? 'selected="selected"' : '', '>', $department, '</option>';
     }
 */
    ?>
    <!-- </select>
  </p> -->

  <p>
   <label for="lc_fac_staff_dir_job_class_field">
    <?php _e( "Position Classification: ", "lorainccc" ); ?>
   </label>
   <select name="lc_fac_staff_dir_job_class_field" id="lc_fac_staff_dir_job_class_field">
   <?php
    $jobclasses = array('select..','Administrative Staff','Faculty, Full Time', 'Faculty, Adjunct', 'Professional and Technical Staff', 'Support Staff, Full Time', 'Support Staff, Part Time');
    $selectedJobclass = esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_job_class_field', true ) );

    foreach ( $jobclasses as $jobclass ) {
     echo '<option value="' . $jobclass . '" id="' . $jobclass . '"', $selectedJobclass == $jobclass ? 'selected="selected"' : '', '>', $jobclass, '</option>';
    }
   ?>
   </select>
  </p>
<!--
  <p>
   <label for="lc_fac_staff_dir_position_type_field">
    <?php _e( "Position Type / Teaching Discipline: ", "lorainccc" ); ?>
   </label>
   <select name="lc_fac_staff_dir_position_type_field" id="lc_fac_staff_dir_position_type_field">
    <?php
      $positiontype = array('select...','Administrative Associates','Administrative Assistants', 'Staff Associates', 'Staff Assistants', '--------------------------------------------------------------------------------------------', 'Accounting','Adjunct Faculty','Advisors','Alternative Energy/Electronics Engineering Technology','Alternative Energy/Manufactoring Engineering Technology','Art','Art/Graphic Design','Associate Degree Nursing','Automation Engineering Technology','Biology','Business Administration - Management Major','Chemistry','Childrens Learning Center','Clinical Laboratory Science','Communication','Computer Engineering/Computer Maintenance & Networking/Electronic Engineering','Computer Information Systems','Conselor','Construction Technology','Coordinator of Counseling and Advising Services','Counselor','Criminal Justice','Culinary Arts','Dental Hygiene','Diagnostic Medical Sonography','Early Childhood Education','Economics','Electronic Engineering Technology','Emergency Medical Services/Fire Science','Emeritus Faculty','Emeritus Professors','English','Foreign Languages','Health Physical Education and Recreation Program','History','History/Geography','Hospitality and Tourism Management','Human Services/Social Work','Humanities','International Intiatives/ESL','Journalism','Laboratory Assistants','Laboratory Instructional Assistant','Manufacturing Engineering Technology','Mathematics','Medical Assisting','Microelectronics and MEMS Technology','Music','National Center for Welding Education and Training (Weld-Ed)','Non-Credit Public Offerings Coordinator','Nord Advanced Technologies Center','Nurse Aid Training','Nursing Laboratory','Philosphy','Physical Therapist Assisting','Physics','Police Academy','Political Science/Public Administration/Urban Studies','Practical Nursing','Pyschology','Quality Assurance','Radiologic Technology','Religion','Respiratory Care','Sociology','Student Success Coach','Surgical Technology','Teacher Education','Theater','Transfer and Articulation Specialist','Welding Technology' );
      foreach ( $positiontype as $position ) {
       
      $selectedPositionType = esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_position_type_field', true ) );
       
      echo '<option value="' . $positiontype .'" id="' . $positiontype . '"', $selectedPositionType == $positiontype ? 'selected="selected"' : '', '>', $position, '</option>';
       
      }
    ?>
    </select>
   <br/><span>This will be used to sort positions on the directory display page.  Enter your specific title below.</span>
  </p>

  <p>
   <label for="lc_fac_staff_dir_position_title_field">
    <?php _e( "Position Title: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_position_title_field" id="lc_fac_staff_dir_position_title_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_position_title_field', true ) ); ?>" size="50" />
  </p>
    -->
  <p>
   <label for="lc_fac_staff_dir_advisor_schedule_field">
    <?php _e( "Advisor Schedule Link: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_advisor_schedule_field" id="lc_fac_staff_dir_advisor_schedule_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_advisor_schedule_field', true ) ); ?>" size="70" />
  </p>
<!--
  <hr/>
  <p><b>If you are located in two departments, please fill out your secondary department information below.</b></p>

  <p>
   <label for="lc_fac_staff_dir_second_department_name_field">
    <?php _e( "Department 2: ", "lorainccc" ); ?>
   </label>
   <select name="lc_fac_staff_dir_second_department_name_field" id="lc_fac_staff_dir_second_department_name_field">
   <?php
foreach ( $departments as $department ) {
      $departmentslug = strtolower(str_replace(' ', '-', $department));

      switch ($departmentslug) {
       case "allied-health-and-nursing-division":
        $departmentslug = 'allied-health';
        break;

       case "arts-and-humanities-division":
        $departmentslug = 'arts-and-humanities';
        break;

       case "engineering-business-and-information-technologies-division":
        $departmentslug = 'ebit';
        break;

       case "purchasing-facility-planning-office":
        $departmentslug = 'purchasing';
        break;

       case "public-services-institute-and-joint-center-for-policy-research":
        $departmentslug = 'psi-jcpr';
        break;

       case "science-and-mathematics-division":
        $departmentslug = 'science-and-math';
        break;

       case "social-sciences-and-human-services-division":
        $departmentslug = 'social-sciences';
        break;

       case "spitzer-conference-center":
        $departmentslug = 'spitzer-center';
        break;

       case "stocker-humanities-and-fine-arts-center":
        $departmentslug = 'stocker-center';
        break;

       case "uso-talent-development-network-resource-center":
        $departmentslug = 'usotdn';
        break;
      }

      $selectedSecondDepartment = esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_second_department_name_field', true ) );
      echo '<option value="' . $departmentslug .'" id="' . $departmentslug . '"', $selectedSecondDepartment == $departmentslug ? 'selected="selected"' : '', '>', $department, '</option>';
     }

    ?>
    </select>
  </p>

  <p>
   <label for="lc_fac_staff_dir_second_position_title_field">
    <?php _e( "Position Title 2: ", "lorainccc" ); ?>
   </label>
   <input type="text" name="lc_fac_staff_dir_second_position_title_field" id="lc_fac_staff_dir_second_position_title_field" value="<?php echo esc_attr( get_post_meta ( $object->ID, 'lc_fac_staff_dir_second_position_title_field', true ) ); ?>" size="50" />
  </p>
    -->
  <?php
}

/* Save the meta box's post metadata */
function lc_dept_directory_save_info( $post_id, $post ) {

 /* Verify the nonce before proceeding */
 if ( !isset( $_POST['lc_dept_directory_post_nonce'] ) || !wp_verify_nonce( $_POST['lc_dept_directory_post_nonce'], basename( __FILE__ ) ) )
  return $post_id;

 /* Get the post type object */
 $post_type = get_post_type_object ( $post->post_type );

 /* Check if the current user has permission to edit the post. */
 if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
  return $post_id;

 $lcpost_title = $_POST['post_title'];

 $name = explode(' ', $lcpost_title);
 $first_name = $name[0];
 $last_name = $name[1];

 /* First Name Field */
 /* Get the posted data and sanitize it for use as a date value. */
 //$new_meta_value = ( isset( $_POST['lc_fac_staff_dir_firstname_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_firstname_field'] ) : '' );
 $new_meta_value = ( isset( $first_name ) ? sanitize_text_field( $first_name ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_firstname_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Middle Initial Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_minitial_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_minitial_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_minitial_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
  
 /* Last Name Field */
 /* Get the posted data and sanitize it for use as a date value. */
 //$new_meta_value = ( isset( $_POST['lc_fac_staff_dir_lastname_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_lastname_field'] ) : '' );
 $new_meta_value = ( isset( $last_name ) ? sanitize_text_field( $last_name ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_lastname_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Suffix Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_suffix_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_suffix_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_suffix_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
 
 /* Department Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_department_name_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_department_name_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_department_name_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Phone Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_phone_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_phone_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_phone_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Email Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_email_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_email_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_email_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Office Location Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_office_location_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_office_location_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_office_location_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

 /* Position Classification Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_job_class_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_job_class_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_job_class_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
 
 /* Position Title Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_position_title_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_position_title_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_position_title_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
 
 /* Advisor Schedule Link Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST[' lc_fac_staff_dir_advisor_schedule_field'] ) ? sanitize_text_field($_POST[' lc_fac_staff_dir_advisor_schedule_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = ' lc_fac_staff_dir_advisor_schedule_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
 
 /* Secondary Department Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST['lc_fac_staff_dir_second_department_name_field'] ) ? sanitize_text_field($_POST['lc_fac_staff_dir_second_department_name_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = 'lc_fac_staff_dir_second_department_name_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
 
 /* Secondary Position Title Field */
 /* Get the posted data and sanitize it for use as a date value. */
 $new_meta_value = ( isset( $_POST[' lc_fac_staff_dir_second_position_title_field'] ) ? sanitize_text_field($_POST[' lc_fac_staff_dir_second_position_title_field'] ) : '' );

 /* Get the meta key. */
 $meta_key = ' lc_fac_staff_dir_second_position_title_field';

  /* Get the meta value of the custom field key. */
 $meta_value = get_post_meta ($post_id, $meta_key, true );

 update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );
 
 }

 function update_dept_directory_meta_values( $post_id, $meta_key, $new_meta_value, $meta_value ) {

  /* If a new meta value was added and there was no previous value, add it. */
 if ( $new_meta_value && '' == $meta_value )
   add_post_meta( $post_id, $meta_key, $new_meta_value, true );

 /* If the new meta value was added and there was no previous value, add it. */
 elseif ( $new_meta_value && $new_meta_value != $meta_value )
  update_post_meta( $post_id, $meta_key, $new_meta_value );

 /* If there is no new meta value but an old value exists, delete it. */
 elseif ( '' == $new_meta_value && $meta_value )
  delete_post_meta( $post_id, $meta_key, $meta_value );

}

function lc_deptdir_get_meta_field( $value ) {
  global $post;

  $field = get_post_meta( $post->ID, $value, true );
  if ( ! empty( $field ) ) {
    return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
  } else {
    return false;
  }
}

?>