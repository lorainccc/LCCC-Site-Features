<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
*/

global $lc_handshake_feed_name, $lc_num_of_posts, $lc_handshake_feed_url, $lc_item_output, $lc_item_count;

if ( ! empty( $attributes['lcHandshakeFeedName'] ) ){
	$lc_handshake_feed_name = $attributes['lcHandshakeFeedName'];
}

if ( ! empty( $attributes['lcNumberOfItems'] ) ){
	$lc_num_of_posts = $attributes['lcNumberOfItems'] - 1;
}

if ( ! empty( $attributes['lcHandshakeFeedUrl'] ) ){
	$lc_handshake_feed_url = $attributes['lcHandshakeFeedUrl'];

	$lc_handshake_curl = curl_init();

    curl_setopt($lc_handshake_curl, CURLOPT_URL, $lc_handshake_feed_url);
    curl_setopt($lc_handshake_curl, CURLOPT_HEADER, 0);
    curl_setopt($lc_handshake_curl, CURLOPT_RETURNTRANSFER, 1);

	$lc_item_output = curl_exec($lc_handshake_curl);

    curl_close($lc_handshake_curl);

    $lc_item_output = simplexml_load_string($lc_item_output);

    if( is_countable( $lc_item_output->channel->item ) && count($lc_item_output->channel->item) > 0 ) {
		$lc_item_count = count($lc_item_output->channel->item);
	} else {
		$lc_item_count = 0;
	}

}

if($lc_item_count > 0){
?>
<div id="<?php echo strtolower( str_replace( ' ', '-', $lc_handshake_feed_name ) ); ?>" <?php echo get_block_wrapper_attributes(); ?>>
	<?php
		for( $i=0; $i<=$lc_num_of_posts; $i++)
			{
				$lc_item_title = $lc_item_output->channel->item[$i]->title;
				$lc_item_descr = nl2br($lc_item_output->channel->item[$i]->description);
				$lc_item_link = $lc_item_output->channel->item[$i]->link;

				$lc_item_descr = str_replace("When:", "<b>When:</b>", $lc_item_descr);

				echo '<div class="lc-handshake-feed-item">';
				echo '  <h2><a href="' . $lc_item_link . '" title="Click to view ' . $lc_item_title  . ' on Handshake" target="_blank">' . $lc_item_title . '</a></h2>';
				echo '  <p>' . $lc_item_descr . '</p>';
				echo '</div>';
			}
	?>
</div>
<?php
}else{
	?>
	<div <?php echo get_block_wrapper_attributes(); ?>>
		<p>No events are currently scheduled.</p>
	</div>
	<?php
}