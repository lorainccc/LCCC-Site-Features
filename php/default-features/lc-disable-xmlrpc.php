<?php

// Disables the XML RPC pingback URLs

add_filter('xmlrpc_enabled', '__return_false');

?>