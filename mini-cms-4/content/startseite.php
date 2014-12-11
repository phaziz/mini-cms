<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{@ printPageName @}</title>
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
		<link href="{@ printCDNLink @}style.css" rel="stylesheet">
	</head>
	<body>

		<div class="container">

			<nav class="navbar navbar-inverse" role="navigation"><div class="container-fluid"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="nav navbar-nav">
				{@ printNavigation @}
			</div></div></nav>

			<div class="jumbotron">
				<h5>{@ printPageName @}</h5>
				<p>Herzlich willkommen bei MrRender - einem Mini-CMS!</p>
				<ul>
					<li>Eine einzige Klasse.</li>
					<li>4 Funktionen - 160 Zeilen Code.</li>
					<li>Saubere URL's mit ModRewrite (.htaccess).</li>
					<li>Caching in reinen Text-Dateien.</li>
					<li>Routing über definiertes Array.</li>
					<li>Beliebige Verschachtelung von virtuellen Verzeichnissen.</li>
					<li>Jedes Template-Design ist möglich.</li>
					<li>Einfache Template-Funktionen: {@ Funktionsname @}.</li>
					<li>404 Fehlerseite (inkl. 404-notfound-Header).</li>
					<li>Installation in Unterverzeichnissen und Subdomains einfach möglich.</li>
				</ul>
				<p>Demo: <a href="http://demo.phaziz.com/mini-cms-4/">demo.phaziz.com/mini-cms-4/</a></p>
				<p>Download: <a href="https://github.com/phaziz/mini-cms">github.com/phaziz/mini-cms</a></p>
				
			</div>

		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>