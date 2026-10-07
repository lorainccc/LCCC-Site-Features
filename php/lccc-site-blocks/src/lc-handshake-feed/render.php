<?php
/**
 * Server-side rendering for the Handshake Feed Block.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block default content.
 * @var WP_Block $block      Block instance.
 */

$feed_url			=	isset( $attributes['lcHandshakeFeedUrl'] ) ? esc_url( $attributes['feedUrl'] ) : '';
$feed_name			=	isset( $attributes['lcHandshakeFeedName'] ) ? sanitize_text_field( $attributes['feedName'] ) : '';
$number_of_items	=	isset( $attributes['lcNumberOfItems'] ) ? absint( $attributes['numberOfItems'] ) : 5;
$feed_category		=	isset( $attributes['lcFeedCategory'] ) ? sanitize_key( $attributes['feedCategory'] ) : 'events';

$allowed_categories = array( 'events', 'jobs', 'fairs' );
if ( ! in_array( $feed_category, $allowed_categories, true ) ) {
	$feed_category = 'events';
}

