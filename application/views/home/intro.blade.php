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


	<script>
		$(function(){
			// EASTER EGG
			eastereggindex= 0;
			$(".ui-header").click(function(){
				eastereggindex++;
				if(eastereggindex== 4){
					$(".ui-header").find("h1").html("Keep Clicking...");
				}
				if(eastereggindex== 20){
					$(".ui-header").find("h1").html("Half way there...");
				}
				if(eastereggindex== 40){
					$(".ui-header").find("h1").html("Two MORE!!!...");
				}
				if(eastereggindex== 42){
					window.location= "/jalapeno";
				}
			});
		});
	</script>

	<!-- Start of first page -->
	<div data-role="page" id="intro">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1>
		</div><!-- /header -->

		<div data-role="content" style="float:left;font-align:left;" align="left">
			{{C02D::$introtext}}
		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>


	</div><!-- /page -->


</body>
</html>
