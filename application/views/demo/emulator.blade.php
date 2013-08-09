<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Demo - Carbon Diary</title>
	<?php
		DepManagement::getJQuery();

		// reset php session data
		Cookie::forget("c_user");
		Cookie::forget("c_donesplash");
	?>
</head>
	
<body>


	<style>

		.iframeborder{
			background-image: url(/img/iphone5.png);
			background-size: contain;
			height:700px;
			background-position: center center;
			background-repeat: no-repeat;
			overflow: hidden;
		}

		/* OPERA */
		iframe{
			/*height: 480px;
			left: 3px;
			position: relative;
			top: 126px;
			width: 280px;
			overflow: hidden;*/
		}

		/* CHROME */
		iframe{
			height: 480px;
			left: 2px;
			position: relative;
			top: 121px;
			width: 280px;
			overflow: hidden;
		}



	</style>



	<center>
		<div class="iframeborder" align="center">
			<iframe src="<?php

				if(isset($_GET['url'])){
					echo $_GET["url"];
				}else{
					echo "/";
				}

			?>" frameborder="0"></iframe>
		</div>
	</center>



</body>
</html>
