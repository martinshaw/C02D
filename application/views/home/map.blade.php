
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
	<div data-role="page" id="map">

		<div data-role="header">
			<h1>&nbsp;</h1>
			<a href="#" class="getGeoLoc ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button">Your Location</a>
			<a href="#" class="ui-btn-right" data-corners="false" data-shadow="false" data-theme="a" data-role="button">Search</a>
		</div><!-- /header -->



		<div data-role="content">

		  
		  <div id="loading">
		  	<br/><br/>
		  	<br/><br/>
		  	<center>
				<h2 align="center">Loading Map...</h2>
			</center>
		  </div>

		  <div id='mapbox' class='dark'></div>
		  <script type='text/javascript'>
		  $(function(){
		  	$('div[data-role="header"] a').hide();
			$("#loading").show();
		  });


		  renderMap= function(){
			  $(function(){

			  		$("#loading").fadeOut("fast");
			  		$('div[data-role="header"] a').fadeIn("fast");

					var map = L.mapbox.map('map', 'c02d.map-flyqmsmf')
						.setView([<?php
							if(isset($_GET["lat"])){
								echo $_GET["lat"];
							}else{
								echo "45";
							}
						?>, <?php
							if(isset($_GET["lon"])){
								echo $_GET["lon"];
							}else{
								echo "-1";
							}
						?>], 4);

			     	$(".getGeoLoc").click(function(e){

			     		if (!navigator.geolocation) {
						    alert("Geolocation is not supported in your browser");
						}else{
					        e.preventDefault();
					        e.stopPropagation();
					        map.locate();
					    }
			     	});  

					map.on('locationfound', function(e) {
					    map.fitBounds(e.bounds);

					    L.mapbox.circle([50.5, 30.5], 200).addTo(map);

					    map.markerLayer.setGeoJSON({
					        type: "Feature",
					        geometry: {
					            type: "Point",
					            coordinates: [e.latlng.lng, e.latlng.lat]
					        },
					        properties: {
						        title: 'Your Location',
					            'marker-color': '#000',
					            'marker-symbol': '<?php 

					            	if(Authen::signedin()== true){
					            		echo Authen::user()->marker_icon;
					            	}else{
					            		echo "pitch";
					            	}

					            ?>'
					        }
					    });
					});

					map.on('locationerror', function() {

					});



			  })
			};


			st= setTimeout(renderMap, 2000);
		  </script>
		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>

	</div><!-- /page -->



</body>
</html>
