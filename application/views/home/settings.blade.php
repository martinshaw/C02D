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




	<!-- Start of first page -->
	<div data-role="page" id="intros">

		<div data-role="header" data-position="fixed" data-fullscreen="false">
			<h1>&nbsp;</h1>
		</div><!-- /header -->

		<div data-role="content">
			<p>


				<input class="autosave" type="text" name="first_name" placeholder="First Name" id="text-basic" data-theme="b" style="text-align:center;" value="{{Authen::user()->first_name}}"/>

				<input class="autosave" type="text" name="last_name" placeholder="Last Name" id="text-basic" data-theme="b" style="text-align:center;" value="{{Authen::user()->last_name}}"/>

				<select class="autosave" name="marker_icon" id="select-choice-a" data-native-menu="false" data-theme="c" value="{{Authen::user()->marker_icon}}">
				    <option>Location Marker</option>

				    <?php
				    	foreach (C02D::$markers as $var) {
				    		if(Authen::user()->marker_icon== $var[0]){
				    			echo '<option value="'. $var[0] .'" data-theme="c" selected>'. $var[1] .'</option>';
				    		}else{
				    			echo '<option value="'. $var[0] .'" data-theme="c">'. $var[1] .'</option>';
				    		}
				    	}
				    ?>

				</select>

				<br/><br/>


				<a href="/ualm/deauthen" data-role="button">Sign Out</a>

				<br/><br/>

				<select class="autosave" name="veh" id="select-choice-a" data-native-menu="false" data-theme="c">
				    <option>Type of Vehicle</option>

				    <?php

				    	foreach (Activitymethod::all() as $var) {
				    		echo '<option value="'. strtolower($var->Name) .'" data-theme="c">'. $var->Name .'</option>';
				    	}
				    ?>

				</select>


				<script>

					$(function(){
						//auto save stuff
						autosave= function(){
							objs= {};
							$(".autosave").each(function(){
								objs[$(this).attr("name")]=$(this).val().toString();
							});
							console.log(objs);
							$.post("/ualm/setSetting", objs, function(){
								console.log("Saved");
							});
						}	
						$(".autosave").keyup(autosave).change(autosave);
					});

				</script>




			</p>
		</div><!-- /content -->
		
		<?php

			include "/home/martin/webdev/yrs13/application/includes/footer.blade.php";
			include "/home/martin/webdev/yrs13/application/includes/sidebar_settings.blade.php";

		?>


	</div><!-- /page -->


</body>
</html>
