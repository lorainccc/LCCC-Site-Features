<?php
function lc_search_form( $form ) {
	
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >';
 $form .= '   <div><label>';
	$form .= '        <span class="screen-reader-text" for="s">' . __( 'Search for:' ) .'</span>';
 $form .= '   <input type="text" value="' . get_search_query() . '" name="s" id="s" />';
	$form .= '   </label>';
	$form .= '			<input type="hidden" name="searchblogs" value="1,2,3,4,5,7,8,9,10,12,13,14,16,17,18,19,20,21,22,23,24,25,26,28,29,30,31,32,33,34,35,37,38,39,40,41,42,44,45,46,47,48,49,50,51,52,54,55,56,57,57,58,59,60,60,61,62,63,64,65,67,68,69,70,71,72,73,74,76" />';
	$form .= '    <input type="submit" class="search-submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />';
	$form .= '				</div>';
	$form .= '</form>';
	
	return $form;
}

add_filter( 'get_search_form', 'lc_search_form', 100 );

?>