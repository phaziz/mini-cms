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

    /*namespacing*/
	namespace App;
	/*namespacing*/

	/*Defining the routes for your website*/
    require_once 'routes.php';
	/*Defining the routes for your website*/

	/*MrRender*/
	class MrRender
	{
		const _BASE_URL 		= 'http://demo.phaziz.com';
		const _BASE_TITLE 		= 'Welcome!';
		const _TPL_DIRECTORY 	= '/content';
		const _CACHE_DIRECTORY 	= '/cache/';
		const _CACHE_TIME 		= 86400;
		const _CACHE_FILEENDING = '.html';
		const _CACHE_DELETR     = 'ThisIsAFuckingUniqueAndAlsoTopSecretStringToCleanTheCacheDirectory';
		const _AFTER_CACHE_DEL	= 'http://demo.phaziz.com/mini-cms-4';
		const _CDN_LINK 		= 'http://demo.phaziz.com/mini-cms-4/content/';
		const _MAIN_TPL 		= 'startseite.php';
		const _404_TPL 			= '404.php';
		const _ERROR_TPL 		= 'error.php';

		function renderTPL($ROUTES_ARRAY)
		{
			if(isset($_GET['del-cache']) && $_GET['del-cache'] == self::_CACHE_DELETR)
			{
				self::cleanCacheDirectory();
				@header('Location: ' . self::_AFTER_CACHE_DEL);
			}

			$REQUEST = $_SERVER['REQUEST_URI'];
			$UNIQUE = __DIR__ . self::_CACHE_DIRECTORY . md5($REQUEST) . self::_CACHE_FILEENDING;

			if(file_exists($UNIQUE) && time() - filemtime($UNIQUE) <= self::_CACHE_TIME)
			{
				$TPL_STR = @file_get_contents(__DIR__ . self::_CACHE_DIRECTORY . md5($REQUEST) . self::_CACHE_FILEENDING);
				echo $TPL_STR;
				die();
			}
			else
			{
				$FLATTEN = self::flatten($ROUTES_ARRAY);

				if($REQUEST == '' || $REQUEST == '/')
				{
					$TPL_STR = @file_get_contents(__DIR__ . self::_TPL_DIRECTORY . DIRECTORY_SEPARATOR . self::_MAIN_TPL);
					$TPL_STR = str_replace('{@ printNavigation @}',self::recursiveNavigation($ROUTES_ARRAY,0),$TPL_STR);
					$TPL_STR = str_replace('{@ printPageName @}',self::_BASE_TITLE,$TPL_STR);
					$TPL_STR = str_replace('{@ printCDNLink @}',self::_CDN_LINK,$TPL_STR);
					$NEW_CACHE = $TPL_STR;
					@file_put_contents($UNIQUE,$NEW_CACHE . "\n" . '<!-- MrRender Cache ' . date('Y-m-d, H:i:s') . ' | http://phaziz.com | http://blog.phaziz.com -->');
					echo $NEW_CACHE;
					die();
				}
				else
				{
					if(array_search($REQUEST,$FLATTEN) != '')
					{
						$TPL_STR = @file_get_contents(__DIR__ . self::_TPL_DIRECTORY . DIRECTORY_SEPARATOR . $FLATTEN[(array_search($REQUEST,$FLATTEN) + 1)]);
						$TPL_STR = str_replace('{@ printNavigation @}',self::recursiveNavigation($ROUTES_ARRAY,0),$TPL_STR);
						$TPL_STR = str_replace('{@ printPageName @}',$FLATTEN[(array_search($REQUEST,$FLATTEN) - 1)],$TPL_STR);
						$TPL_STR = str_replace('{@ printCDNLink @}',self::_CDN_LINK,$TPL_STR);
						$NEW_CACHE = $TPL_STR;
						@file_put_contents($UNIQUE,$NEW_CACHE . "\n" . '<!-- MrRender Cache ' . date('Y-m-d, H:i:s') . ' | http://phaziz.com | http://blog.phaziz.com -->');
						echo $NEW_CACHE;
						die();
					}
					else
					{
						$TPL_STR = @file_get_contents(__DIR__ . self::_TPL_DIRECTORY . DIRECTORY_SEPARATOR . self::_404_TPL);
						$TPL_STR = str_replace('{@ printNavigation @}',self::recursiveNavigation($ROUTES_ARRAY,0),$TPL_STR);
						$TPL_STR = str_replace('{@ printPageName @}','404 - not found',$TPL_STR);
						$TPL_STR = str_replace('{@ printCDNLink @}',self::_CDN_LINK,$TPL_STR);
						echo $TPL_STR;
						die();
					}
				}
			}
		}

		private function cleanCacheDirectory()
		{
			$C_DIRECTORY = __DIR__ . self::_CACHE_DIRECTORY;

			if(@is_dir($C_DIRECTORY))
			{
				if ($H = @opendir($C_DIRECTORY))
				{
					while (($F = @readdir($H)) !== false)
					{
						if ($F != '.' && $F != '..')
						{
							@unlink($C_DIRECTORY . $F);
						}
					}

					@closedir($H);
				}
			}
		}

		private function flatten($ARRAY)
		{
		    if (!is_array($ARRAY))
		    {
		        return array($ARRAY);
		    }

		    $RESULT = array();

		    foreach ($ARRAY as $VALUE)
		    {
		        $RESULT = array_merge($RESULT, self::flatten($VALUE));
		    }

		    return $RESULT;
		}

		private function recursiveNavigation($ARRAY,$LEVEL)
		{
			if(!empty($ARRAY))
			{
				if ($LEVEL > 0)
				{
					$RET = '<ul class="dropdown-menu multi-level" role="menu">';
				}
				else
				{
					$RET = '<ul class="nav navbar-nav">';
				}

				foreach($ARRAY as $KEY => $VALUE)
				{
					if(!is_int($KEY))
					{
						$RET .=  '<li class="dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $KEY . '</a>';
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
	/*MrRender*/

	$APP = new \App\MrRender();
	echo $APP -> renderTPL($ROUTES_ARRAY);