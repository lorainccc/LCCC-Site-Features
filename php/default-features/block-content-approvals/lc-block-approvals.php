<?php

class lcBlockRevisions {
    var $lcblockrevisions;
    var $lcblockoptions = [];


    function __construct( $args = [] ){
        if (!empty($args) && is_array($args) && !empty($args['lcblockrevisions'])){
            $this->lcblockrevisions = $args['lcblockrevisions'];
        }
    }
}

function lc_modify_list_row_actions( $actions, $post ) {

    if( current_user_can( 'administrator' ) != true ){
        if( current_user_can_for_blog( get_current_blog_id(), 'lccc_edit' ) == true || current_user_can_for_blog( get_current_blog_id(), 'lccc_adv_edit' ) == true ){
            if ( !lc_is_plugin_active( 'classic-editor/classic-editor.php' ) )  {
                if ( in_array( $post->post_type, array( 'post', 'page' ) ) ){

                    if ( $post->post_status == "publish" ){
                        $url = 'admin.php?page=lc_content_revisions&lc_draft_post=true&lcpostID=' . $post->ID;
                        $actions['edit'] = '<a href="' . $url . '" title="Revise Page" rel="permalink">Revise</a>';
                    }
                }
            }
        }
    }
    return $actions;
}
add_filter( 'page_row_actions', 'lc_modify_list_row_actions', 10, 2 );
add_filter( 'post_row_actions', 'lc_modify_list_row_actions', 10, 2 );

function lc_change_row_title( $link, $post_id, $context ){

    if( current_user_can('administrator' ) != true ){
        if( current_user_can_for_blog( get_current_blog_id(), 'lccc_edit') == true || current_user_can_for_blog( get_current_blog_id(), 'lccc_adv_edit' ) == true ){
            if ( !lc_is_plugin_active( 'classic-editor/classic-editor.php' ) )  {
                global $post;
                $post = get_post( $post_id );
                if ( in_array( $post->post_type, array( 'post', 'page' ) ) ){
                    if ( $post->post_status == "publish" ){
                        //
                        $link = site_url() . '/wp-admin/admin.php?page=lc_content_revisions&lc_draft_post=true&lcpostID=' . $post_id;
                    }
                }
            }
        }
    }
    return $link;
}
add_filter( 'get_edit_post_link', 'lc_change_row_title', 10, 3 );

/*
 * 6-2023 Notes
 * is_plugin_active only exists on Admin Dashboard side of WP.  
 * Recreate the function for the front-end editor, prefacing with lc_to avoid conflicts
 * Reference: https://wordpress.stackexchange.com/questions/9345/is-plugin-active-function-doesnt-exist
 * 
 */ 

    function lc_is_plugin_active( $plugin ) {
        return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
    }