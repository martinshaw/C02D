<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Clouds</title>
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
		<style type="text/css">

			html,body{
				width:100% !important;
			}

			#container{
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

			a {
				color:#0078ff;
			}

			img{
				left:7%;
				position: absolute;
				top: 20px;
				background: 'transparent';
				width:85%;
			}
			.loadobj{
				top:0px;
				position: absolute;
				background: 'transparent';
				width:100%;
			}
			.loadbar{
				top:0px;
				position: absolute;
				float:left;
				width:0%;
				height:2px;
				background:black;
				font-size: 1px;
			}

			a{
				color: black !important;
			}

		</style>
	</head>
	<body>

		<div id="container" align="center">
			<center>
				<img src="/img/splash/logo.png"/>
			</center>
		</div>


		<center>
			<div id="loading" class="loadobj">
				Loading...<br/>
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
				}, 3000, function(){
					$(".loadbar").remove();
					$(".loadobj").html($("<a></a>").text("Finished playing with clouds?").attr("data-prefetch","true").attr("href","http://yrs13/intro"));
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
	</body>
</html>




























