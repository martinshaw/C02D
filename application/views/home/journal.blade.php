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




	
	<!-- Start of second page -->
	<div data-role="page" id="journal">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1>
		</div><!-- /header -->

		<div data-role="content" class="nopadding">
			

				<!-- <ul data-role="listview" data-inset="true" data-theme="a">
				    <li data-role="list-divider" data-theme="b">8:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday<!--  1<sup>st</sup> Jan 2013 --><!-- <span class="ui-li-count">2</span></li>
				    <li><a href="index.html">
				        <p class="ui-li-aside"><strong>8:24</strong>AM</p>
				        <h2>Train to Manchester</h2>
				        <p><strong>You've been invited to a meeting at Filament Group in Boston, MA</strong></p>
				        <p>Hey Stephen, if you're available at 10am tomorrow, we've got a meeting with the jQuery team.</p>
				    </a></li>
				    <li><a href="index.html">
				        <h2>jQuery Team</h2>
				        <p><strong>Boston Conference Planning</strong></p>
				        <p>In preparation for the upcoming conference in Boston, we need to start gathering a list of sponsors and speakers.</p>
				        <p class="ui-li-aside"><strong>9:18</strong>AM</p>
				    </a></li>
				    <li data-role="list-divider" data-theme="b">10:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday<!--  1<sup>st</sup> Jan 2013 --><!-- <span class="ui-li-count">1</span></li>
				    <li><a href="index.html">
				        <h2>Avery Walker</h2>
				        <p><strong>Re: Dinner Tonight</strong></p>
				        <p>Sure, let's plan on meeting at Highland Kitchen at 8:00 tonight. Can't wait! </p>
				        <p class="ui-li-aside"><strong>4:48</strong>PM</p>
				    </a></li>
				</ul> -->
	

				<ul style="margin-top:.1em;" data-role="listview" data-inset="true" data-theme="c">
				    <li data-role="list-divider" data-theme="a">8:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday<!--  1<sup>st</sup> Jan 2013 --> <span class="ui-li-count">2</span></li>
				    <li><a href="index.html">
				        <h2>Train</h2>
				        <p><strong>The morning train to work</strong></p>
				        <p><span>200 grams of CO<sub><sup>&nbsp;2</sup></sub></span></p>
				        <p class="ui-li-aside"><strong>8:12</strong>PM</p>
				    </a></li>
				    <li><a href="index.html">
				        <h2>Bus</h2>
				        <p><strong>From train station to office</strong></p>
				        <p>43 grams of CO</p>
				        <p class="ui-li-aside"><strong>8:50</strong>PM</p>
				    </a></li>
				    <li data-role="list-divider" data-theme="a">13:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday<!--  1<sup>st</sup> Jan 2013 --> <span class="ui-li-count">2</span></li>
				    <li><a href="index.html">
				        <h2>Bus</h2>
				        <p><strong>From shop</strong></p>
				        <p>13 grams of CO</p>
				        <p class="ui-li-aside"><strong>13:58</strong>PM</p>
				    </a></li>
				    <li><a href="index.html">
				        <h2>Taxi</h2>
				        <p><strong>To shop</strong></p>
				        <p>24 grams of CO</p>
				        <p class="ui-li-aside"><strong>13:33</strong>PM</p>
				    </a></li>
				    <li data-role="list-divider" data-theme="a">14:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday<!--  1<sup>st</sup> Jan 2013 --> <span class="ui-li-count">1</span></li>
				    <li><a href="index.html">
				        <h2>Plane</h2>
				        <p><strong>HOLIDAY!!</strong></p>
				        <p>1800 grams of CO</p>
				        <p class="ui-li-aside"><strong>14:10</strong>PM</p>
				    </a></li>
				</ul>



		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>

	</div><!-- /page -->



</body>
</html>
