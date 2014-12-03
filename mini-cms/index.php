<?php

	namespace RENDER;

	session_start();
	session_regenerate_id(true);

	class Render
	{		
		const _INSTALL_DIRECTORY = 'mini-cms';
		const _TPL_DIRECTORY = 'content/';
		const _MAIN_TPL = '0-startseite.php';
		const _404_TPL = '404.php';
		const _ERROR_TPL = 'error.php';
		const _TPL_FILE_ENDING = '.php';
		const _PROTO = true;

		function __construct()
		{
			$_SESSION['randomInt'] = self::randomString();
			$REQUEST_VARS = array_filter(explode('/',$_SERVER['REQUEST_URI']),'strlen');
			unset($REQUEST_VARS[array_search(self::_INSTALL_DIRECTORY,$REQUEST_VARS)]);
			$REQUEST_VARS = array_values($REQUEST_VARS);

			if($_SESSION['randomInt'] == '' || !$_SESSION['randomInt'])
			{
				require_once self::_TPL_DIRECTORY . self::_ERROR_TPL;
				self::Log('Session randomInt missing | ' . __FILE__);
				self::dumpParams();
				die();
			}

			if(count($REQUEST_VARS) == 0)
			{
				require_once self::_TPL_DIRECTORY . self::_MAIN_TPL;
				self::Log('RENDERING _MAIN_TPL | ' . __FILE__);
				self::dumpParams();
				die();
			}
			else
			{
				foreach($REQUEST_VARS AS $REQUEST_VAR)
				{
					if(is_file(self::_TPL_DIRECTORY . $REQUEST_VAR . self::_TPL_FILE_ENDING) == true)
					{
						require_once self::_TPL_DIRECTORY . $REQUEST_VAR . self::_TPL_FILE_ENDING;
						self::Log('RENDERING ' . self::_TPL_DIRECTORY . $REQUEST_VAR . self::_TPL_FILE_ENDING . ' | ' . __FILE__);
						self::dumpParams();
						die();
					}
					else if(is_file(self::_TPL_DIRECTORY . $REQUEST_VAR . self::_TPL_FILE_ENDING) == false)
					{
						require_once self::_TPL_DIRECTORY . self::_404_TPL;
						self::Log('RENDERING ' . self::_TPL_DIRECTORY . self::_404_TPL . ' | 404 not found: ' . self::_TPL_DIRECTORY . $REQUEST_VAR . self::_TPL_FILE_ENDING . ' | ' . __FILE__);
						self::dumpParams();
						die();
					}
				}
			}
		}

		private function initLogger()
		{
			chmod('./assets/logfiles/' . date('Y-m-d') . '-router-info.txt',0777);
		}

		private function Log($M) 
		{
			self::initLogger();
			$this -> LOG = date('Y-m-d H:i:s') . ' | ' . $M . "\n";
			error_log($this -> LOG, 3,'./assets/logfiles/' . date('Y-m-d') . '-app-info.txt');
		}

		private function randomString()
		{
			return md5(mt_rand() . time());
		}

		private function dumpParams()
		{
			if(self::_PROTO == true)
			{
				echo '<div class="container"><div class="jumbotron"><h5>_PROTO:</h5><pre>';
				var_dump($_REQUEST,$_SESSION);
				echo '</pre></div></div>';
			}
		}
	}

	$APP = new \RENDER\Render();