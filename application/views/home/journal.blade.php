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



	<style>
	
		.ui-li-divider{
			z-index:100 !important;
		}
		
	</style>



	
	<!-- Start of second page -->
	<div data-role="page" id="list">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1><a href="#calc" data-transition="slide" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button">Calculate</a>
			<a href="#graph" data-transition="slide" class="ui-btn-right" data-corners="false" data-shadow="false" data-theme="a" data-role="button">Graph View</a>
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
	



				<ul style="margin-top:.1em;" data-role="listview" data-inset="true" data-theme="c" class="wqein">
				    <li data-role="list-divider" data-theme="a">8:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday<!--  1<sup>st</sup> Jan 2013 --> <span class="ui-li-count">2</span></li>
				    <li><a href="#detail" data-transition="slide">
				        <h2>Train</h2>
				        <p><strong>The morning train to work</strong></p>
				        <p><span>200 grams of CO<sub><sup>&nbsp;2</sup></sub></span></p>
				        <p class="ui-li-aside"><strong>8:12</strong>PM</p>
				    </a></li>
				    <li><a href="index.html">
				        <h2>Bus</h2>
				        <p><strong>From train station to office</strong></p>
				        <p>43 grams of CO<sub><sup>&nbsp;2</sup></sub></p>
				        <p class="ui-li-aside"><strong>8:50</strong>PM</p>
				    </a></li>
				    <li data-role="list-divider" data-theme="a">13:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday<!--  1<sup>st</sup> Jan 2013 --> <span class="ui-li-count">2</span></li>
				    <li><a href="index.html">
				        <h2>Bus</h2>
				        <p><strong>From shop</strong></p>
				        <p>13 grams of CO<sub><sup>&nbsp;2</sup></sub></p>
				        <p class="ui-li-aside"><strong>13:58</strong>PM</p>
				    </a></li>
				    <li><a href="index.html">
				        <h2>Taxi</h2>
				        <p><strong>To shop</strong></p>
				        <p>24 grams of CO<sub><sup>&nbsp;2</sup></sub></p>
				        <p class="ui-li-aside"><strong>13:33</strong>PM</p>
				    </a></li>
				    <li data-role="list-divider" data-theme="a">14:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday<!--  1<sup>st</sup> Jan 2013 --> <span class="ui-li-count">1</span></li>
				    <li><a href="index.html">
				        <h2>Plane</h2>
				        <p><strong>HOLIDAY!!</strong></p>
				        <p>1800 grams of CO<sub><sup>&nbsp;2</sup></sub></p>
				        <p class="ui-li-aside"><strong>14:10</strong>PM</p>
				    </a></li>
				    
				    <li data-role="list-divider" data-theme="c"><!--14:00&nbsp;&nbsp;-&nbsp;&nbsp;Monday--><!--  1<sup>st</sup> Jan 2013 -->&nbsp;<!--<span class="ui-li-count">1</span>--></li>
				    <li><a href="#">
				        <h2>Add Activity</h2>
				        <!--<p><strong>HOLIDAY!!</strong></p>
				        <p>1800 grams of CO<sub><sup>&nbsp;2</sup></sub></p>
				        <p class="ui-li-aside"><strong>14:10</strong>PM</p>-->
				    </a></li>
				    <li><a href="#">
				        <h2>Create today's report</h2>
				        <!--<p><strong>HOLIDAY!!</strong></p>
				        <p>1800 grams of CO<sub><sup>&nbsp;2</sup></sub></p>
				        <p class="ui-li-aside"><strong>14:10</strong>PM</p>-->
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
			<h1>&nbsp;</h1><a href="#calc" data-transition="slide" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button">Calculate</a>
			<a href="#list" data-transition="slide" class="ui-btn-right" data-corners="false" data-shadow="false" data-theme="a" data-role="button">List View</a>
		</div><!-- /header -->

		<div data-role="content" class="nopadding">
			
				












			<style>
			#bara{
				font-size: 10px;
				height:50%;
				overflow-x: visible !important;
				cursor:crosshair !important;
			}
			.axis path, .axis line {
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



			<div id="bara"></div>


			<script src="http://d3js.org/d3.v3.min.js"></script>
			<script>

			var margin = {top: 20, right: 20, bottom: 110, left: 40},
			    width = (window.innerWidth*3) - margin.left - margin.right,
			    height = (window.innerHeight) - margin.top - margin.bottom;

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

			var svg = d3.select("#bara").append("svg")
			    .attr("width", width + margin.left + margin.right)
			    .attr("height", "100%")
			  .append("g")
			    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

			d3.tsv("bar_dummydata.tsv", type, function(error, data) {
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
			      .text("CO₂ used");

			  svg.selectAll(".bar")
			      .data(data)
			    .enter().append("rect")
			      .attr("class", "bar")
			      .attr("x", function(d) { return x(d.letter); })
			      .attr("width", x.rangeBand())
			      .attr("y", function(d) { console.log(d.frequency);return y(d.frequency); })
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
	<div data-role="page" id="detail">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1><a href="#list" data-transition="slide" data-direction="reverse" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button">&larr;&nbsp;Back</a>
			
		</div><!-- /header -->

		<div data-role="content" class="nopadding">
			

				<style>
					.topareas, .middleareas, .bottomareas{
						padding-left:20px;
						padding-right:20px;
					}
					.icon{
						font-family: 'GlyphyxOneNF';
						font-size:60px;
					}
					hr{
						border-style:none;
						border-top:1px solid #aaa;
					}
					.float{
						color:white;
						position:relative;
					}
					.co{
						top:-125px;
						left:-4px;
					}
					.counit{
						top:-120px;
						left:-4px;
						font-size: 9px;
					}
					blockquote{
						margin-top:0;
						padding-top: 0;
					}
				</style>
				
				<div class="topareas">

					<center>

						<br/>

						<span class="icon">$</span>

					</center>

					<h2>The morning train to work</h2>

					<hr/>
				</div>
				
				<div class="middleareas">
					<center>

						<br/>

						<img src="/img/feet/1/amber.png" height="170px"/>
						<div class="float co">200</div>
						<div class="float counit">grams of CO<sub>2</sub></div>

					</center>
					<br/>
					<hr/>

				</div>

				
				<div class="bottomareas">

					<h3>Alternative Route:</h3>
					<blockquote>
						We recommend travelling by a small hybrid car on this route.<br/><br/>
						This would reduce your carbon emissions by 18 grams

					</blockquote>	<br/>
				</div>


		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>

	</div><!-- /page -->























	
	<!-- Start of second page -->
	<div data-role="page" id="calc">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1><a href="#list" data-transition="slide" data-direction="reverse" class="ui-btn-left" data-corners="false" data-shadow="false" data-theme="a" data-role="button">&larr;&nbsp;Back</a>
			
		</div><!-- /header -->

		<div data-role="content" class="nopadding">
			

				<style>
					.topareas, .middleareas, .bottomareas{
						padding-left:20px;
						padding-right:20px;
					}
					.icon{
						font-family: 'GlyphyxOneNF';
						font-size:60px;
					}
					hr{
						border-style:none;
						border-top:1px solid #aaa;
					}
					.float{
						color:white;
						position:relative;
					}
					.co{
						top:-125px;
						left:-4px;
					}
					.counit{
						top:-120px;
						left:-4px;
						font-size: 9px;
					}
					blockquote{
						margin-top:0;
						padding-top: 0;
					}
				</style>
				
				<div class="topareas">

					<center>

					<h4 id="capt">Small Petrol Car</h4>
<br/>
					<a href="#popupNested" class="wienfwef" data-rel="popup" data-role="button" data-inline="true" data-icon="bars" data-theme="b" data-transition="pop">Choose a Vehicle...</a>
					<div data-role="popup" id="popupNested" data-theme="none">
					    <div data-role="collapsible-set" data-theme="b" data-content-theme="c" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d" style="margin:0; width:250px;">
					        <div data-role="collapsible" data-inset="false">
					            <h2>Car</h2>
					            <ul data-role="listview">

					            	<script>
					            		$(function(){
					            			$(".middleareas").hide();
					            			$("#capt").hide();
					            			$(".showremainder").click(function(){
					            				$(".middleareas").show();
					            				$("#popupNested").hide();
					            				$("#capt").show();
					            				$(".wienfwef").hide();

					            			});	


					            		});
					            	</script>

					                
						            <div data-role="collapsible" data-inset="false" data-theme="c">
							            <h2 data-theme="c">Small</h2>
							            <ul data-role="listview">
								            <ul data-role="listview">
								                <li><a href="#" data-rel="dialog" class="showremainder">Petrol</a></li>
								                <li><a href="#" data-rel="dialog">Diesel</a></li>
								                <li><a href="#" data-rel="dialog">Hybrid</a></li>
								                <li><a href="#" data-rel="dialog">Electric</a></li>
								                <li><a href="#" data-rel="dialog">Unknown</a></li>
								            </ul>
							            </ul>
							        </div><!-- /collapsible -->
					                
						            <div data-role="collapsible" data-inset="false" data-theme="c">
							            <h2 data-theme="c">Normal</h2>
							            <ul data-role="listview">
								            <ul data-role="listview">
								                <li><a href="#" data-rel="dialog">Small</a></li>
								                <li><a href="#" data-rel="dialog">Normal</a></li>
								                <li><a href="#" data-rel="dialog">Large</a></li>
								            </ul>
							            </ul>
							        </div><!-- /collapsible -->
					                
						            <div data-role="collapsible" data-inset="false" data-theme="c">
							            <h2 data-theme="c">Large</h2>
							            <ul data-role="listview">
								            <ul data-role="listview">
								                <li><a href="#" data-rel="dialog">Small</a></li>
								                <li><a href="#" data-rel="dialog">Normal</a></li>
								                <li><a href="#" data-rel="dialog">Large</a></li>
								            </ul>
							            </ul>
							        </div><!-- /collapsible -->

					            </ul>
					        </div><!-- /collapsible -->
					        <div data-role="collapsible" data-inset="false">
					            <h2>Bus</h2>
					            <ul data-role="listview">
					                <li><a href="#" data-rel="dialog">Cat</a></li>
					                <li><a href="#" data-rel="dialog">Dog</a></li>
					                <li><a href="#" data-rel="dialog">Iguana</a></li>
					                <li><a href="#" data-rel="dialog">Mouse</a></li>
					            </ul>
					        </div><!-- /collapsible -->
					        <div data-role="collapsible" data-inset="false">
					            <h2>Taxi</h2>
					            <ul data-role="listview">
					                <li><a href="#" data-rel="dialog">Fish</a></li>
					                <li><a href="#" data-rel="dialog">Octopus</a></li>
					                <li><a href="#" data-rel="dialog">Shark</a></li>
					                <li><a href="#" data-rel="dialog">Starfish</a></li>
					            </ul>
					        </div><!-- /collapsible -->
					        <div data-role="collapsible" data-inset="false">
					            <h2>Train</h2>
					            <ul data-role="listview">
					                <li><a href="#" data-rel="dialog">Lion</a></li>
					                <li><a href="#" data-rel="dialog">Monkey</a></li>
					                <li><a href="#" data-rel="dialog">Tiger</a></li>
					                <li><a href="#" data-rel="dialog">Zebra</a></li>
					            </ul>
					        </div><!-- /collapsible -->
					        <div data-role="collapsible" data-inset="false">
					            <h2>Tram</h2>
					            <ul data-role="listview">
					                <li><a href="#" data-rel="dialog">Lion</a></li>
					                <li><a href="#" data-rel="dialog">Monkey</a></li>
					                <li><a href="#" data-rel="dialog">Tiger</a></li>
					                <li><a href="#" data-rel="dialog">Zebra</a></li>
					            </ul>
					        </div><!-- /collapsible -->
					    </div><!-- /collapsible set -->
					</div><!-- /popup -->

</center>


















					<hr/>
				</div>
				
				<div class="middleareas">

						<br/>

<center>
						<input type="text" class="km" placeholder="Enter Kilometres Travelled"/>
</center>





					<br/>
					<hr/>

				</div> 

				


		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>

	</div><!-- /page -->





































</body>
</html>
