<?php

//Display and Editing User Profile Field

add_action( 'show_user_profile', 'lc_show_post_notice_profile_fields' );
add_action( 'edit_user_profile', 'lc_show_post_notice_profile_fields' );

function lc_show_post_notice_profile_fields( $user ) { ?>

	<h3>Pending Post Notifications</h3>

	<table class="form-table">
		<tr>
			<th><label for="twitter">Receive Post Notifications?</label></th>
			<td>
					<input type="checkbox" name="postnotice" value="yes" <?php echo esc_attr( get_user_meta( $user->ID, 'postnotice', true ) === 'yes' ) ? 'checked' : ''; ?> /> Yes
			</td>
		</tr>
	</table>

<?php
																																																						
		}

//Saving User Profile Field Data

add_action( 'personal_options_update', 'lc_save_post_notice_profile_fields' );
add_action( 'edit_user_profile_update', 'lc_save_post_notice_profile_fields' );

function lc_save_post_notice_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'postnotice', $_POST['postnotice'] );

}

?>