
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
		  <div id='mapbox' class='dark'></div>
		  <script type='text/javascript'>
		  $(function(){
		  	$('#map div[data-role="header"] a').hide();
		  });

		  document.markerinfo= function(id){
		  	console.log("marker triggered");

		  	console.log(id);

		  	$.get("/ajax/placeinfo", {id: id}, function(data){
		  		console.log("flag 1");
		  		info= $("#info");
		  		xmlDoc = $.parseXML(data);
				$xml = $( xmlDoc );

		  		info.find(".placename").text($xml.find("localregion").text());
		  		info.find(".thumb").attr("src", $xml.find("image").text());
		  		info.find(".onfoot").text($xml.find("amount").text());

		  		c= ["Green", "green"];
		  		if(parseInt($xml.find("amount").text()) > 200){
		  			c= ["Amber", "amber"];
		  		}
		  		if(parseInt($xml.find("amount").text()) > 500){
		  			c= ["Red", "red"];
		  		}
		  		info.find(".foot").attr("src", "/img/feet/1/"+ c[1]+ ".png");
		  		info.find(".foot").attr("alt", c[0]);
				
				console.log("flag 2");
		  		$(".postget").show();
		  		$(".preget-loading").hide();
		  		console.log("flag 3");

		  	})
		  	info= $("#info");
		  	info.find("");
			$("#map div[data-role='content']").append($("<a></a>").attr("href", "#info").attr("data-role", "button").attr("data-transition", "flow").attr("data-inline", "true").addClass("gotoinfo").hide())
			$(".gotoinfo").click();

		  }


		  renderMap= function(){
			  $(function(){


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
					<?php
						$markers = Carbonmarker::all();
 
 						$timerindex= 0;
						foreach ($markers as $marker)
						{			
							$timerindex= $timerindex+10;

							if($marker->amount > 500){
								$color= "ff0000";
							}
							elseif($marker->amount > 200){
								$color= "ff9200";
							}else{
								$color= "00bd00";
							}

							$function= "function(err, data){
								if(data){

								marker= L.marker(data.latlng, {
						            icon: L.mapbox.marker.icon({'marker-symbol': 'circle-stroked', 'marker-color': '".$color."'}), 'title': '".$marker->local_region_name."'
						        })

								marker.on('click', function(e) {
								    document.markerinfo(".$marker->id.");
								});

						        markers.addLayer(marker);
						    	}
						    }";
						     echo "a= setTimeout(function(){geocoder.query('". $marker->local_region_name .", United Kingdom', ".$function.")},".$timerindex.");\n";
						}
					?>

					map.addLayer(markers);


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

			reshowmap= function(){
				$("#map").show();
		  		$('#map div[data-role="header"] a').fadeIn("fast");
			};
			rsmt= setTimeout(reshowmap, 2000);
			document.skipload= reshowmap;


			st= setTimeout(renderMap, 2000);
		  </script>
		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>

	</div><!-- /page -->






	

		
	<!-- Start of second page -->
	<div data-role="page" id="info">

		<div data-role="header">
			<h1>&nbsp;</h1>
			<a href="#map" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-inline="true">&lt;&nbsp;Return to map</a>
		</div><!-- /header -->

		<div data-role="content">
			<!-- <p>I'm the second in the source order so I'm hidden when the page loads. I'm just shown if a link that references my id is beeing clicked.</p>
			<p><a href="#foo">Back to foo</a></p> -->
			<p><center>


				<div class="preget-loading">
					
					<br/><br/>

					<h2>Loading info...</h2>

				</div>
				
	
				<div class="postget" style="display:none;">

					<img class="thumb" src="http://dsphotographic.com/blog/wp-content/uploads/2011/08/manchester.jpg" width="80%"/>
					<b><h2 class="placename"></h2></b>

					<hr width="100%" style="
						border-top-style:solid;
						border-top-color:#bbb;
						border-left-style:none;
						border-left-width:0px;
					"/>

					<br/>

					<img class="foot" src="/img/feet/1/green.png" width="60%" alt="Green">

					<h2 class="onfoot" style="position:relative; top:-150px; left:-6px; color:white; text-shadow:0 0 0 !important;">999</h2>
					<small class="onfootunit" style="position:relative; top:-175px; left:-4px; color:white; text-shadow:0 0 0 !important;"><sub>g of CO<sub>2</sub></sub></small>
		
				</div>

	
			</center></p>

		</div><!-- /content -->

	</div><!-- /page -->




</body>
</html>
