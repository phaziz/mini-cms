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

	namespace App;

	/**/ 
	/*
	 * 
	 * App-Route's Definition's
	 * 
	 */
	/**/
	$ROUTES_ARRAY = array(
		array(
			'_WHAT' => 'Startseite',
			'_URL' => '/mini-cms-3/',
			'_TPL' => 'startseite.php'
		),
		array(
			'_WHAT' => 'Info',
			'_URL' => '/mini-cms-3/info/',
			'_TPL' => 'info.php'
		),
		array(
			'_WHAT' => 'Support',
			'_URL' => '/mini-cms-3/support/',
			'_TPL' => 'support.php'
		),
		'Projekte' => array(
			array(
				'_WHAT' => 'Consulting',
				'_URL' => '/mini-cms-3/projekte/consulting/',
				'_TPL' => 'projekte_consulting.php'
			),
			array(
				'_WHAT' => 'Web',
				'_URL' => '/mini-cms-3/projekte/web/',
				'_TPL' => 'projekte_web.php'
			),
			array(
				'_WHAT' => 'Print',
				'_URL' => '/mini-cms-3/projekte/print/',
				'_TPL' => 'projekte_print.php'
			)
		),
		array(
			'_WHAT' => 'Support',
			'_URL' => '/mini-cms-3/support/',
			'_TPL' => 'support.php'
		),
		array(
			'_WHAT' => 'Kontakt',
			'_URL' => '/mini-cms-3/kontakt/',
			'_TPL' => 'kontakt.php'
		)
	);

	class MrRender
	{
		const _BASE_URL = 'http://demo.phaziz.com';
		const _BASE_TITLE = 'Welcome!';
		const _TPL_DIRECTORY = '/mini-cms-3/content';
		const _MAIN_TPL = 'startseite.php';
		const _404_TPL = '404.php';
		const _ERROR_TPL = 'error.php';

		public function flatten($array)
		{
		    if (!is_array($array))
		    {
		        return array($array);
		    }

		    $result = array();

		    foreach ($array as $value)
		    {
		        $result = array_merge($result, self::flatten($value));
		    }

		    return $result;
		}

		function renderTPL($ROUTES_ARRAY)
		{
			$FLATTEN = self::flatten($ROUTES_ARRAY);
			$REQUEST = $_SERVER['REQUEST_URI'];

			if($REQUEST == '' || $REQUEST == '/')
			{
				$TPL_STR = file_get_contents(self::_BASE_URL . DIRECTORY_SEPARATOR . self::_TPL_DIRECTORY . DIRECTORY_SEPARATOR . self::_MAIN_TPL);
				$TPL_STR = str_replace('{@ printNavigation @}',self::recursiveNavigation($ROUTES_ARRAY,0),$TPL_STR);
				$TPL_STR = str_replace('{@ printPageName @}',self::_BASE_TITLE,$TPL_STR);

				echo $TPL_STR;
				die();
			}
			else
			{
				if(array_search($REQUEST,$FLATTEN) != '')
				{
					$TPL_STR = file_get_contents(self::_BASE_URL . DIRECTORY_SEPARATOR . self::_TPL_DIRECTORY . DIRECTORY_SEPARATOR . $FLATTEN[(array_search($REQUEST,$FLATTEN) + 1)]);

					if($TPL_STR != '')
					{
						$TPL_STR = str_replace('{@ printNavigation @}',self::recursiveNavigation($ROUTES_ARRAY,0),$TPL_STR);
						$TPL_STR = str_replace('{@ printPageName @}',$FLATTEN[(array_search($REQUEST,$FLATTEN) - 1)],$TPL_STR);
						echo $TPL_STR;
						die();
					}
				}
				else
				{
					$TPL_STR = file_get_contents(self::_BASE_URL . DIRECTORY_SEPARATOR . self::_TPL_DIRECTORY . DIRECTORY_SEPARATOR . self::_404_TPL);

					if($TPL_STR != '')
					{
						$TPL_STR = str_replace('{@ printNavigation @}',self::recursiveNavigation($ROUTES_ARRAY,0),$TPL_STR);
						$TPL_STR = str_replace('{@ printPageName @}','404 - not found',$TPL_STR);
						echo $TPL_STR;
						die();
					}
				}
			}
		}

		function recursiveNavigation($ARRAY,$LEVEL)
		{
			if(!empty($ARRAY))
			{
				if ($LEVEL > 0)
				{
					$RET = '<ul class="dropdown-menu" role="menu">';
				}
				else
				{
					$RET = '<ul class="nav navbar-nav">';
				}

				foreach($ARRAY as $KEY => $VALUE)
				{
					if(!is_int($KEY))
					{
						$RET .=  '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $KEY . ' <span class="caret"></span></a>';
						$LEVEL++;
						$RET .= self::recursiveNavigation($VALUE,$LEVEL);
						$RET .=  '</li>';
					}
					else
					{
						$RET .= '<li><a href="' . self::_BASE_URL . $VALUE['_URL'] . '">' . $VALUE['_WHAT'] . '</a></li>';
					}
				}

				$RET .= '</ul>';

				return $RET;
			}
			else
			{
				return false;
			}
		}
	}

	$APP = new \App\MrRender();
	echo $APP -> renderTPL($ROUTES_ARRAY);