ONFI<?php

	header("HTTP/1.0 404 Not Found");
	require_once'_CONFIG.php';

?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9 " lang="en"><![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10" lang="en"><![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo ucfirst(basename(__FILE__,'.php'));?></title>
		<link rel="stylesheet" href="<?php echo $CONFIG['_BASE_URL']; ?>assets/css/normalize.min.css">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $CONFIG['_BASE_URL']; ?>assets/css/app.css">
	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

					<div class="jumbotron">
						<?php createNav($CONFIG); ?>
						<?php echo ucfirst(basename(__FILE__,'.php'));?>
					</div>

				</div>
			</div>
		</div>

		<script src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<script>

			;$(function()
				{
					if(console && console.log)
					{
						console.log('jQuery ready...')
					}
				}
			);

		</script>
	</body>
</html>