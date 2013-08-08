<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Carbon Diary</title>
	<?php
		DepManagement::getJQuery();
		DepManagement::getJQueryMobile();
		DepManagement::getMapApi();
		DepManagement::getCSS();
		DepManagement::getJS();
	?>
</head>
<body>
	
<body>


	<!-- Start of first page -->
	<div data-role="page" id="intro">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1>
		</div><!-- /header -->

		<div data-role="content">
			{{C02D::$introtext}}
		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>


	</div><!-- /page -->


</body>
</html>
