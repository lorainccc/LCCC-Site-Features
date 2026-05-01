<?php
// This file is generated. Do not modify it manually.
return array(
	'lc-handshake-feed' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'lccc-site-blocks/lc-handshake-feed',
		'version' => '0.1.0',
		'title' => 'LCCC Handshake Feed',
		'category' => 'widgets',
		'icon' => 'rss',
		'description' => 'Block for displaying a feed from Handshake.',
		'example' => array(
			
		),
		'attributes' => array(
			'lcHandshakeFeedUrl' => array(
				'type' => 'string'
			),
			'lcNumberOfItems' => array(
				'type' => 'number'
			),
			'lcHandshakeFeedName' => array(
				'type' => 'string'
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'lccc-site-blocks',
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	)
);
