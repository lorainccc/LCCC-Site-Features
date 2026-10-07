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
	),
	'lc-post-categories-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'lccc-site-blocks/lc-post-categories',
		'version' => '0.1.0',
		'title' => 'LCCC Post Categories Block',
		'category' => 'widgets',
		'icon' => 'category',
		'description' => 'Displays the categories assigned to the current post with customizable layout and styling options.',
		'example' => array(
			'attributes' => array(
				'label' => '',
				'layout' => 'list',
				'showCount' => false
			)
		),
		'attributes' => array(
			'label' => array(
				'type' => 'string',
				'default' => ''
			),
			'layout' => array(
				'type' => 'string',
				'default' => 'list',
				'enum' => array(
					'inline',
					'list'
				)
			),
			'showCount' => array(
				'type' => 'boolean',
				'default' => false
			),
			'separator' => array(
				'type' => 'string',
				'default' => ', '
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => true,
				'link' => true
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true
			)
		),
		'textdomain' => 'lorainccc',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'lc-quote-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'lccc-site-blocks/lc-quote-block',
		'version' => '0.1.0',
		'title' => 'LCCC Quote Block',
		'category' => 'text',
		'icon' => 'format-quote',
		'description' => 'LCCC Custom Block for quotes with citation source.',
		'example' => array(
			'attributes' => array(
				'quoteText' => 'The only way to do great work is to love what you do.',
				'citation' => 'Steve Jobs',
				'textAlign' => 'center',
				'borderColor' => '#0055a5',
				'borderWidth' => 4
			)
		),
		'attributes' => array(
			'quoteText' => array(
				'type' => 'string',
				'default' => ''
			),
			'citation' => array(
				'type' => 'string',
				'default' => ''
			),
			'textAlign' => array(
				'type' => 'string',
				'default' => 'left'
			),
			'borderColor' => array(
				'type' => 'string',
				'default' => '#0055a5'
			),
			'borderWidth' => array(
				'type' => 'number',
				'default' => 4
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			)
		),
		'textdomain' => 'lorainccc',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js'
	)
);
