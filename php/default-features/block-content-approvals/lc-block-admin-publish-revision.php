<?php

function lc_publish_post( $postID = 0 ){
	
    if ( !$postID ) {
        $lc_publish_post = $_GET['lc_publish_post'];
        $lc_postID = $_GET['lcpostID'];
        $lc_returnURL = $_GET['lcreturn'];
    }

    // Retrieve Post Object
    $lc_post = get_post( $lc_postID );
    
    // Retrieve Post Type - Used to send user back to list of posts later
    $lc_current_post_type = $lc_post->post_type;

    //
    $current_post_id = $lc_postID;
    
    $_lc_publishedId = get_post_meta($current_post_id, '_lc_publishedId', true);
    
        if($_lc_publishedId != false){
                
                $lc_updatePost = array(
                    'ID' => $_lc_publishedId,
                    'menu_order' => $lc_post->menu_order,
                    'comment_status' => ( $lc_post->comment_status == 'open' ? 'open' : 'closed' ),
                    'ping_status' => ( $lc_post->ping_status == 'open' ? 'open' : 'closed' ),
                    'post_author' => $lc_post->post_author,
                    'post_category' => ( isset( $lc_post->post_category ) ? $lc_post->post_category : array() ),
                    'tax_input'=> ( isset( $lc_post->tax_input ) ? $lc_post->tax_input : array() ),
                    'post_content' => $lc_post->post_content,
                    'post_excerpt' => $lc_post->excerpt,
                    'post_parent' => $lc_post->parent_id,
                    'post_password' => $lc_post->post_password,
                    'post_status' => 'publish',
                    'post_title' => $lc_post->post_title,
                    'post_type' => $lc_post->post_type,
                    'post_date'     => $lc_post->post_date,
                    'post_date_gmt' => $lc_post->post_date_gmt,
                    //'tags_input' => ( isset( $_REQUEST['tax_input']['post_tag'] ) ? $_REQUEST['tax_input']['post_tag'] : '' ),
                    'page_template' => $lc_post->page_template,
                    'thumbnail' => $lc_post->thumbnail   
                );

                // Insert Post into Database
                wp_update_post($lc_updatePost);

                //Clear existing Meta Data
                $lc_existing = get_post_custom($_lc_publishedId);
                foreach ($lc_existing as $ekey => $evalue) {
                    delete_post_meta($_lc_publishedId, $ekey);
                }

                // Add Post Meta from draft post
                $custom = get_post_custom($current_post_id);
                foreach ($custom as $ckey => $cvalue) {
                    if ( $ckey != '_edit_lock' && $ckey != '_edit_last' && $ckey != '_lc_publishedId' ) {
                        foreach ($cvalue as $mvalue) {
                            add_post_meta($_lc_publishedId, $ckey, $mvalue, true);
                        }
                    }
                }

                //Delete Draft Post, forcing delete since 2.9, no sending to trash_comment
                wp_delete_post($current_post_id, true);
    
                // Send user to list of posts to edit
                //wp_redirect( admin_url( 'edit.php?post_type=' . $lc_current_post_type ) );

                // Send Author notification that the post was approved.
                lc_notify_author( $lc_post );

                // Send user to published page editor
				wp_redirect( admin_url( 'post.php?action=edit&post=' . $_lc_publishedId ) );
                exit();

    }

}

function lc_notify_author( $lc_post ){
    $author_id = $lc_post->post_author;

    $author = get_user_by( 'id', $author_id );

    $site_title = get_bloginfo( 'name' );

    $to = $author->user_email;

    $subject = '[' . $site_title . '] Page Approved';

    $body = '<img src="https://cdn.lorainccc.edu/lccc-logo.png" style="width:285px; height:59px;"><br/><h1 style="font-size: 16pt;font-family:sans-serif;">Page Approval Notice</h1><p style="font-size: 12pt;font-family:sans-serif;">Your revision to, "' . $lc_post->post_title . '", has been approved.</p>';

    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail( $to, $subject, $body, $headers );
}