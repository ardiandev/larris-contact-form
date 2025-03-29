<?php
// This file is generated. Do not modify it manually.
return array(
	'larris-contact-form' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/larris-contact-form',
		'version' => '0.1.0',
		'title' => 'Larris Contact Form',
		'category' => 'widgets',
		'icon' => 'email',
		'description' => 'A simple and customizable contact form block, scaffolded with the Create Block tool for easy integration into WordPress.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'larris-contact-form',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js',
		'attributes' => array(
			'emailRecipent' => array(
				'type' => 'string',
				'default' => 'admin@your-blog.com'
			)
		)
	)
);
