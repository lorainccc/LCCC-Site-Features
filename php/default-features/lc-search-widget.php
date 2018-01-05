<?php
function lc_search_form( $form ) {
	
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
				<input type="hidden" name="searchblogs" value="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
				</div>
</form>';
	
	return $form;
}

add_filter( 'get_search_form', 'lc_search_form', 100 );

?>