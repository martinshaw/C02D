
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

					document.map= map;



					var markers = new L.MarkerClusterGroup();
					var geocoder = L.mapbox.geocoder('c02d.map-flyqmsmf');


					//var geocoder = L.mapbox.geocoder('c02d.map-flyqmsmf');
					geocoder.query('Birmingham, West Midlands', function(err, data){
								if(data){
						        markers.addLayer(L.marker(data.latlng, {
						            icon: L.mapbox.marker.icon({'marker-symbol': 'post', 'marker-color': '0044FF'})
						        }))}});
					<?php
						$markers = Carbonmarker::all();
 
 						$timerindex= 0;
						foreach ($markers as $marker)
						{
							$timerindex= $timerindex+1000;
							$function= "function(err, data){
								if(data){
						        markers.addLayer(L.marker(data.latlng, {
						            icon: L.mapbox.marker.icon({'marker-symbol': 'post', 'marker-color': '0044FF'})
						        }))}}";
						     echo "a= setTimeout(function(){geocoder.query('". $marker->local_region_name .", United Kingdom', ".$function.")},".$timerindex.");\n";
						}
					?>

					mapmarkerpush= setTimeout(function(){
						map.addLayer(markers);
					}, 20000);


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
