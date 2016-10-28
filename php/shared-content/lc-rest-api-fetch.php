<?php
/*
Adapted From Plugin Name: Carleton REST Fetcher
Adapted From Author: Mike Corkum

Customized for Shared Content
*/

class lcEndPoints {

 protected $url;

 protected $posts = [];

 public function __construct( $url ){
  $this->url = $url;
  $this->lc_get_shared_content_cache();
 }

 public function lc_get_posts( $page = 1 ){
  if ( isset( $this->posts[ $page ] ) ) {
   return $this->posts[ $page ];
  } else {
   $this->lc_make_request( $page );
   if ( isset( $this->posts[ $page ] ) ) {
    return $this->posts[ $page ];
   }
  }
  return [];
 }

 protected function lc_make_request( $page ){
  $request = wp_remote_get( add_query_arg( 'page', (int) $page, $this->url ) );

 if ( ! is_wp_error( $request ) && 200 === wp_remote_retrieve_response_code( $request ) ) {
  $this->posts[ $page ] = json_decode( wp_remote_retrieve_body( $request ) );
  $this->lc_set_shared_content_cache();
  }
 }

 protected function lc_set_shared_content_cache(){
  if ( ! empty( $this->posts ) ) {
   set_transient( $this->lc_shared_content_cache_key(), $this->posts, 86400 );
  }
 }

 protected function lc_get_shared_content_cache() {
  if ( is_array( $posts = get_transient( $this->lc_shared_content_cache_key() ) ) ) {
   $this->posts = $posts;
  }
 }

 protected function lc_shared_content_cache_key() {
  return 'LC_Shared_Content_' . md5( preg_replace( '(^https?://)', '', $this->url ) );
 }

}

class lcContent {
 protected $posts = [];

 protected $endpoints = [];

 protected $page;


 public function __construct( $page = 1 ){
  $this->page = 1;
 }

 public function lc_add_endpoint( lcEndPoints $endpoint ) {
  $this->endpoints[] = $endpoint;
 }

 public function lc_get_posts( $page = 1 ){
  if ( isset( $this->posts[ $page ] ) ) {
   return $this->posts[ $page ];
  } else {
   $this->lc_retrieve_content();
   if ( ! empty( $this->posts ) ) {
    return $this->posts;
   }
  }
  return array();
 }

 protected function lc_retrieve_content() {
  if ( ! empty( $this->endpoints ) ) {

   foreach ( $this->endpoints as $endpoint ) {
    $this->posts[] = $endpoint->lc_get_posts( $this->page );
   }

   $new_post_array = array();

			foreach ( $this->posts as $key => $value ) {
				foreach ( $value as $post ) {
     $new_post_array[] = $post;
    }
   }
   $this->posts = $new_post_array;
  }
 }

}
?>