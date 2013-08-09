
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










	
	<div class="cloudspage">
		<style type="text/css">

			html,body{
				width:100% !important;
			}

			.cloudspage #container{
				width:100%;
			}

			body {
				background-color: #326696;
				margin: 0px;
				overflow: hidden;
				font-family:Monospace;
				font-size:13px;
				text-align:center;
				font-weight: bold;
				text-align:center;
			}

			.cloudspage a {
				color:#0078ff;
			}

			.cloudspage img{
				left:7%;
				position: absolute;
				top: 20px;
				background: 'transparent';
				width:85%;
			}
			.cloudspage .loadobj{
				top:0px;
				position: absolute;
				background: 'transparent';
				width:100%;
			}
			.cloudspage .loadbar{
				top:0px;
				position: absolute;
				float:left;
				width:0%;
				height:2px;
				background:black;
				font-size: 1px;
			}

			
			#map{
				z-index:-10; /*behind splash*/
			}

		</style>


		<div id="container" align="center">
			<center>
				<a href="#info" data-role="button" data-transition="flow" data-inline="true">page</a>
			</center>
		</div>


		<center>
			<div id="loading" class="loadobj">
				Loading Carbon Data... Please be patient<br/>
			</div>
			<div class="loadbarpadding">
				<div class="loadbar">&nbsp;</div>
			</div>
		</center>

		<script type="text/javascript" src="/js/three.min.js"></script>
		<script type="text/javascript" src="/js/Detector.js"></script>

		<script>

			$(function(){
				$(".loadobj").css("top", window.innerHeight-100);
				$(".loadbar").css("top", window.innerHeight-70);

				$(".loadbar").animate({
					width: "100%"
				}, 84000, function(){
					$(".loadbar").remove();
					$(".cloudspage").remove();
				});
			});

		</script>


		<script id="vs" type="x-shader/x-vertex">

			varying vec2 vUv;

			void main() {

				vUv = uv;
				gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );

			}

		</script>

		<script id="fs" type="x-shader/x-fragment">

			uniform sampler2D map;

			uniform vec3 fogColor;
			uniform float fogNear;
			uniform float fogFar;

			varying vec2 vUv;

			void main() {

				float depth = gl_FragCoord.z / gl_FragCoord.w;
				float fogFactor = smoothstep( fogNear, fogFar, depth );

				gl_FragColor = texture2D( map, vUv );
				gl_FragColor.w *= pow( gl_FragCoord.z, 20.0 );
				gl_FragColor = mix( gl_FragColor, vec4( fogColor, gl_FragColor.w ), fogFactor );

			}

		</script>

		<script type="text/javascript">

			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

			var container;
			var camera, scene, renderer;
			var mesh, geometry, material;

			var mouseX = 0, mouseY = 0;
			var start_time = Date.now();

			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;

			init();

			function init() {

				container = document.createElement( 'div' );
				document.body.appendChild( container );

				// Bg gradient

				var canvas = document.createElement( 'canvas' );
				canvas.width = 32;
				canvas.height = window.innerHeight;

				var context = canvas.getContext( '2d' );

				var gradient = context.createLinearGradient( 0, 0, 0, canvas.height );
				gradient.addColorStop(0, "#1e4877");
				gradient.addColorStop(0.5, "#4584b4");

				context.fillStyle = gradient;
				context.fillRect(0, 0, canvas.width, canvas.height);

				container.style.background = 'url(' + canvas.toDataURL('image/png') + ')';
				container.style.backgroundSize = '32px 100%';

				//

				camera = new THREE.PerspectiveCamera( 30, window.innerWidth / window.innerHeight, 1, 3000 );
				camera.position.z = 6000;

				scene = new THREE.Scene();

				geometry = new THREE.Geometry();

				var texture = THREE.ImageUtils.loadTexture( '/img/cloud10.png', null, animate );
				texture.magFilter = THREE.LinearMipMapLinearFilter;
				texture.minFilter = THREE.LinearMipMapLinearFilter;

				//var fog = new THREE.Fog( 0x000000, - 10000, 13000 ); ////////// pollution (lots)
				var fog = new THREE.Fog( 0x4584b4, - 100, 3000 ); // normal
				

				material = new THREE.ShaderMaterial( {

					uniforms: {

						"map": { type: "t", value: texture },
						"fogColor" : { type: "c", value: fog.color },
						"fogNear" : { type: "f", value: fog.near },
						"fogFar" : { type: "f", value: fog.far },

					},
					vertexShader: document.getElementById( 'vs' ).textContent,
					fragmentShader: document.getElementById( 'fs' ).textContent,
					depthWrite: false,
					depthTest: false,
					transparent: true

				} );

				var plane = new THREE.Mesh( new THREE.PlaneGeometry( 64, 64 ) );

				for ( var i = 0; i < 8000; i++ ) {

					plane.position.x = Math.random() * 1000 - 500;
					plane.position.y = - Math.random() * Math.random() * 200 - 15;
					plane.position.z = i;
					plane.rotation.z = Math.random() * Math.PI;
					plane.scale.x = plane.scale.y = Math.random() * Math.random() * 1.5 + 0.5;

					THREE.GeometryUtils.merge( geometry, plane );

				}

				mesh = new THREE.Mesh( geometry, material );
				scene.add( mesh );

				mesh = new THREE.Mesh( geometry, material );
				mesh.position.z = - 8000;
				scene.add( mesh );

				renderer = new THREE.WebGLRenderer( { antialias: false } );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );

				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onDocumentMouseMove( event ) {

				mouseX = ( event.clientX - windowHalfX ) * 0.25;
				mouseY = ( event.clientY - windowHalfY ) * .6;

			}

			function onWindowResize( event ) {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function animate() {

				requestAnimationFrame( animate );

				position = ( ( Date.now() - start_time ) * .1 ) % 8000;

				camera.position.x += ( mouseX - camera.position.x ) * 0.01;
				camera.position.y += ( - mouseY - camera.position.y ) * 0.01;
				camera.position.z = - position + 8000;

				renderer.render( scene, camera );

			}

		</script>


	</div>





	


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
			$(".cloudspage").show();
		  	$('#map div[data-role="header"] a').hide();
		  });

		  document.markerinfo= function(id){

		  	$.get("/ajax/placeinfo", {id: id}, function(data){
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
		  	})
		  	info= $("#info");
		  	info.find("");
			$("#map div[data-role='content']").append($("<a></a>").attr("href", "#info").attr("data-role", "button").attr("data-transition", "flow").attr("data-inline", "true").addClass("gotoinfo").hide()).click();

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
							$timerindex= $timerindex+1000;

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
				$(".cloudspage").remove();
				$("canvas").closest('div').fadeOut("fast", function(){
					$("canvas").closest('div').remove();
				});
				$("#map").show();
		  		$('#map div[data-role="header"] a').fadeIn("fast");
			};
			rsmt= setTimeout(reshowmap, 84100);
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
			<a href="#map" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-transition="flow" data-inline="true">&lt;&nbsp;Return to map</a>
		</div><!-- /header -->

		<div data-role="content">
			<!-- <p>I'm the second in the source order so I'm hidden when the page loads. I'm just shown if a link that references my id is beeing clicked.</p>
			<p><a href="#foo">Back to foo</a></p> -->
			<p><center>
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

			</center></p>

		</div><!-- /content -->

	</div><!-- /page -->




</body>
</html>
