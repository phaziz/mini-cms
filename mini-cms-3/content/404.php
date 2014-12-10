<?php

	header("HTTP/1.0 404 Not Found");

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{@ printPageName @}</title>
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
		<link href="cover.css" rel="stylesheet">
		<style>
			.container{max-width:1200px;margin:25px auto;}
			*{-webkit-border-radius: 0px !important;-moz-border-radius: 0px !important;border-radius: 0px !important;	}
		</style>
	</head>
	<body>

		<div class="container">

			<nav class="navbar navbar-inverse" role="navigation"><div class="container-fluid"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="nav navbar-nav">
				{@ printNavigation @}
			</div></div></nav>

			<div class="jumbotron">
				<h5>{@ printPageName @}</h5>
			</div>

		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>