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

        +++ Visit http://phaziz.com +++
        +++ Visit http://blog.phaziz.com +++

    ***************************************************************************
    */

	/**/ 
	/*
	 * 
	 * App-Route's Definition's
	 * 
	 */
	/**/
	$ROUTES_ARRAY = array
	(
		array
		(
			'_WHAT' => 'Startseite',
			'_URL' => '/mini-cms-4/',
			'_TPL' => 'startseite.php'
		),
		array
		(
			'_WHAT' => 'Info',
			'_URL' => '/mini-cms-4/info/',
			'_TPL' => 'info.php'
		),
		array
		(
			'_WHAT' => 'Support',
			'_URL' => '/mini-cms-4/support/',
			'_TPL' => 'support.php'
		),
		'Projekte' => array
		(
			array
			(
				'_WHAT' => 'Consulting',
				'_URL' => '/mini-cms-4/projekte/consulting/',
				'_TPL' => 'projekte_consulting.php'
			),
			'Web' => array
			(
				array
				(
					'_WHAT' => 'HTML5',
					'_URL' => '/mini-cms-4/projekte/web/html5',
					'_TPL' => 'projekte_web_html5.php'
				),
				array
				(
					'_WHAT' => 'Online-Shops',
					'_URL' => '/mini-cms-4/projekte/web/online-shops/',
					'_TPL' => 'projekte_web_online_shops.php'
				),
			),
			array
			(
				'_WHAT' => 'Print',
				'_URL' => '/mini-cms-4/projekte/print/',
				'_TPL' => 'projekte_print.php'
			)
		),
		array
		(
			'_WHAT' => 'Support',
			'_URL' => '/mini-cms-4/support/',
			'_TPL' => 'support.php'
		),
		array
		(
			'_WHAT' => 'Kontakt',
			'_URL' => '/mini-cms-4/kontakt/',
			'_TPL' => 'kontakt.php'
		)
	);
	/**/ 
	/*
	 * 
	 * App-Route's Definition's
	 * 
	 */
	/**/