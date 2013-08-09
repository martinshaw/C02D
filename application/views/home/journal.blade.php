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
	<div data-role="page" id="list">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1>
			<a href="#calculatrice" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-transition="turn">Calculate</a>

			<a href="#graph" class="ui-btn-right" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-transition="flow">Graph View</a>

		</div><!-- /header -->

		<div data-role="content" class="nopadding">

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






	
	<!-- Start of second page -->
	<div data-role="page" id="graph">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1>
			<a href="#calculatrice" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-transition="turn">Calculate</a>

			<a href="#list" class="ui-btn-right" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-transition="flow">List View</a>
		</div><!-- /header -->

		<div data-role="content" class="nopadding">

			<style>

			.lgraph { /*body*/
			  font: 10px sans-serif;
			}

			.axis path,
			.axis line {
			  fill: none;
			  stroke: #000;
			  shape-rendering: crispEdges;
			}

			.bar {
			  fill: steelblue;
			}

			.x.axis path {
			  display: none;
			}

			</style>


			<script src="http://d3js.org/d3.v3.min.js"></script>
			<script>

			var margin = {top: 20, right: 20, bottom: 30, left: 40},
			    width = 960 - margin.left - margin.right,
			    height = 500 - margin.top - margin.bottom;

			var formatPercent = d3.format(".0%");

			var x = d3.scale.ordinal()
			    .rangeRoundBands([0, width], .1);

			var y = d3.scale.linear()
			    .range([height, 0]);

			var xAxis = d3.svg.axis()
			    .scale(x)
			    .orient("bottom");

			var yAxis = d3.svg.axis()
			    .scale(y)
			    .orient("left")
			    .tickFormat(formatPercent);

			var svg = d3.select("body").append("svg")
			    .attr("width", width + margin.left + margin.right)
			    .attr("height", height + margin.top + margin.bottom)
			  .append("g")
			    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

			d3.tsv("/ajax/bar.tsv", type, function(error, data) {
			  x.domain(data.map(function(d) { return d.letter; }));
			  y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

			  svg.append("g")
			      .attr("class", "x axis")
			      .attr("transform", "translate(0," + height + ")")
			      .call(xAxis);

			  svg.append("g")
			      .attr("class", "y axis")
			      .call(yAxis)
			    .append("text")
			      .attr("transform", "rotate(-90)")
			      .attr("y", 6)
			      .attr("dy", ".71em")
			      .style("text-anchor", "end")
			      .text("Frequency");

			  svg.selectAll(".bar")
			      .data(data)
			    .enter().append("rect")
			      .attr("class", "bar")
			      .attr("x", function(d) { return x(d.letter); })
			      .attr("width", x.rangeBand())
			      .attr("y", function(d) { return y(d.frequency); })
			      .attr("height", function(d) { return height - y(d.frequency); });

			});

			function type(d) {
			  d.frequency = +d.frequency;
			  return d;
			}

			</script>










		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>

	</div><!-- /page -->
	
	<!-- Start of second page -->
	<div data-role="page" id="calculatrice">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1>
			<a href="#list" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-transition="turn">&larr;&nbsp;Return</a>

			<a href="#list" class="ui-btn-right" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-transition="flow">List View</a>
			<a href="#graph" class="ui-btn-right" data-corners="false" data-shadow="false" data-theme="a" data-role="button" data-transition="flow">Graph View</a>
		</div><!-- /header -->

		<div data-role="content">

			<center>

			<br/><br/>



					<div align="left" style="text-align:left;">
						<legend>1. Select Vehicle</legend>
						<div class="boxes">
							
	
							<select name="name" id="name" data-native-menu="false">
								<option>Vehicle Type</option>
								<option>Car</option>
								<option>Bus</option>
								<option>Taxi</option>
								<option>Train</option>
								<option>Tram</option>
							</select>
							
							<select name="size" id="size" data-native-menu="false">
								<option>Vehicle Size</option>
								<option>Car</option>
								<option>Bus</option>
								<option>Taxi</option>
								<option>Train</option>
								<option>Tram</option>
							</select>

							<select name="fuel" id="fuel" data-native-menu="false">
							</select>

							<script>
								$(function(){
									$(".ui-select").hide();
									$(".ui-select").first().show();
								});
							</script>


						</div>
						<br/><br/>
						<legend>2. Enter Kilometers Traveled</legend>
						<div class="kmin">
							<input type="text" id="kminin" placeholder="kilometers travelled"/>
						</div>
					</div>


					<script>

						$.get("http://yrs13/ajax/calcboxes", {}, function(d){
						  document.d= $(d);
						});

					</script>




			</center>

		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>

	</div><!-- /page -->




</body>
</html>
