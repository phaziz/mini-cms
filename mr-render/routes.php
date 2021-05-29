<?php

	/*
	***************************************************************************

	DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
	Version 1, 2014/15
	Copyright (C) 2014 Christian Becher | phaziz.com <phaziz@gmail.com>

	Everyone is permitted to copy and distribute verbatim or modified
	copies of this license document, and changing it is allowed as long
	as the name is changed.

	DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
	TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
	0. YOU JUST DO WHAT THE FUCK YOU WANT TO!

	+++ Visit https://github.com/phaziz +++

	***************************************************************************
	*/

	/*
	* App-Route's Definition's
	* 
	*/

	$ROUTES_ARRAY = [
		[
			'_WHAT' => 'Startseite',
			'_URL' => '/mr-render/',
			'_TPL' => 'startseite.php'
		],
		[
			'_WHAT' => 'Info',
			'_URL' => '/mr-render/info/',
			'_TPL' => 'info.php'
		],
		[
			'_WHAT' => 'Support',
			'_URL' => '/mr-render/support/',
			'_TPL' => 'support.php'
		],
		'Projekte' => [
			[
				'_WHAT' => 'Consulting',
				'_URL' => '/mr-render/projekte/consulting/',
				'_TPL' => 'projekte_consulting.php'
			],
			[
				'_WHAT' => 'Print',
				'_URL' => '/mr-render/projekte/print/',
				'_TPL' => 'projekte_print.php'
			]
		],
		[
			'_WHAT' => 'Support',
			'_URL' => '/mr-render/support/',
			'_TPL' => 'support.php'
		],
		[
			'_WHAT' => 'Kontakt',
			'_URL' => '/mr-render/kontakt/',
			'_TPL' => 'kontakt.php'
		]
	];
