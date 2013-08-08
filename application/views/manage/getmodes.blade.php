<?php

	if(isset($_GET["csv"])){

		$con=mysqli_connect("127.0.0.1","root","mondriot","yrs13");

		// Check connection
		 if (mysqli_connect_errno($con)){
		   echo "Failed to connect to MySQL: " . mysqli_connect_error();
		 }

		 $i= 1;

		 	foreach ($_GET as $key => $value) {
		 		if($key== "csv"){
		 			echo "CSV: ".$value;
		 		}elseif($key== "table"){
		 			echo "Table: ".$value;
		 		}else{
		 			mysqli_query($con, "INSERT INTO ".$_GET["table"]." (FirstName, LastName, Age) VALUES ('Peter', 'Griffin',35)");
		 		}
		 	}


		 mysqli_close($con);

	}


?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Carbon Diary</title>
	<?php
		DepManagement::getJQuery();
	?>

<form action="" method="get">

	<input type="text" placeholder="CSV File" name="csv"/>
	<input type="text" placeholder="Table Name" name="table"/>
	<div class="fields">
	<fieldset>

		<legend>
			<b>Column 1</b>
		</legend>

		<input type="text" placeholder="from" name="f1"/> -
		>
		<input type="text" placeholder="to" name="t1"/>
	
	</fieldset>
	<fieldset>

		<legend>
			<b>Column 2</b>
		</legend>

		<input type="text" placeholder="from" name="f2"/> -
		>
		<input type="text" placeholder="to" name="t2"/>
	
	</fieldset>
	<fieldset>

		<legend>
			<b>Column 3</b>
		</legend>

		<input type="text" placeholder="from" name="f3"/> -
		>
		<input type="text" placeholder="to" name="t3"/>
	
	</fieldset>
	<fieldset>

		<legend>
			<b>Column 4</b>
		</legend>

		<input type="text" placeholder="from" name="f4"/> -
		>
		<input type="text" placeholder="to" name="t4"/>
	
	</fieldset>
	</div>
	<div class="add">Add Columns</div>
	<script>
		$(function(){
			i= 5;
			$(".add").click(function(){
				$(".fields").append($('<fieldset><legend><b>Column '+i+'</b></legend><input type="text" placeholder="from" name="f'+i+'"/> -> <input type="text" placeholder="to" name="t'+i+'"/>'));
				i++;
			});
		});
	</script>


	<button type="submit">Submit</button>



</form>