<?php

	$CONFIG = array
	(
		'_BASE_URL' => 'http://demo.phaziz.com/mini-cms/',
		'_MAIN_TPL' => '0-startseite.php',
		'_404_TPL' => '404.php',
		'_CONTENT_DIR' => './content',
		'_CACHE_DIR' => './cache'
 	);

	function array_orderby()
	{
		$args = func_get_args();
		$data = array_shift($args);
		foreach ($args as $n => $field)
		{
			if (is_string($field))
			{
				$tmp = array();
				foreach ($data as $key => $row)
				{
					$tmp[$key] = $row[$field];
					$args[$n] = $tmp;
				}
			}
		}

		$args[] = &$data;call_user_func_array('array_multisort', $args);return array_pop($args);
	}

	function buildName($NAME)
	{
		$NAME = trim($NAME);
		$NAME = str_replace('_',' ',$NAME);
		$NAME = str_replace('ae','ä',$NAME);
		$NAME = str_replace('ue','ü',$NAME);
		$NAME = str_replace('oe','ö',$NAME);
		$NAME = str_replace('Ae','Ä',$NAME);
		$NAME = str_replace('Ue','Ü',$NAME);
		$NAME = str_replace('Oe','Ö',$NAME);

		return $NAME;
	}

	function getPageName($NAME)
	{
		$NAME = explode('-',$NAME);
		$NEW_NAME = '';

		if(count($NAME) > 2)
		{
			for($i = 1; $i <= count($NAME); $i++)
			{
				$NEW_NAME .= ucfirst($NAME[$i]) . ' ';
			}

			$NAME = buildName($NEW_NAME);
		}
		else
		{
			$NAME = buildName(ucfirst($NAME[1]));
		}

		echo $NAME;
	}

	function createNav($CONFIG)
	{
		$H = opendir ($CONFIG['_CONTENT_DIR']);
		$SITES = array();

		while($F = readdir($H))
		{
			if($F != '.' && $F != '..' && $F != 'config.php' && is_numeric(substr($F,0,1)) && $F != $CONFIG['_404_TPL'])
			{
				if($F == $CONFIG['_MAIN_TPL'])
				{
					$ACT_URL = $CONFIG['_BASE_URL'];
					$NAME = explode('-',$F);
					$ORDER = $NAME[0];
					$NAME = explode('.',$NAME[1]);
					$NAME = ucfirst($NAME[0]);
					$SITES[$F] = array(
						'name' => buildName($NAME),
						'file' => $F,
						'url' => $ACT_URL,
						'order' => $ORDER
					);
				}
				else
				{
					$F = explode('.',$F);
					$NAME = explode('-',$F[0]);
					$ORDER = $NAME[0];
					$NEW_NAME = '';

					if(count($NAME) > 2)
					{
						for($i = 1; $i <= count($NAME); $i++)
						{
							$NEW_NAME .= ucfirst($NAME[$i]) . ' ';
						}

						$NAME = trim($NEW_NAME);
					}
					else
					{
						$NAME = ucfirst($NAME[1]);
					}

					$FILE = $F[0] . '.' . $F[1];
					$ACT_URL = $CONFIG['_BASE_URL'] . str_replace('.php','',$FILE);
					$SITES[$FILE] = array(
						'name' => buildName($NAME),
						'file' => $FILE,
						'url' => $ACT_URL,
						'order' => $ORDER
					);
				}
			}
		}

		$SITES = array_orderby($SITES, 'order', SORT_ASC);
		$NAVIGATION_STRING = '<nav><ol class="breadcrumb">';

		foreach($SITES AS $SITE)
		{
			$NAVIGATION_STRING .= '<li><a href="' . $SITE['url'] . '"><small>' . $SITE['name'] . '</small></a></li>';
		}

		$NAVIGATION_STRING .= '</ol></nav>';

		echo $NAVIGATION_STRING;

		closedir($H);
	}