<?php

	// remove first comma from each line and append to file
	//$file = fopen("data_notitle.csv","r");

	// while(! feof($file))
	//  {
	//   $myFile = "new_data_notitle.csv";
	//	$fh = fopen($myFile, 'a') or die("can't open file");
	//	$stringData = substr(fgets($file), 1);
	//	fwrite($fh, $stringData);
	//	fclose($fh);
	//   }

	// fclose($file);
	 
	 
	 
	$file = fopen("mini22.csv","r");

	 while(!feof($file))
	   {
		   
			$linefields= explode(",", fgets($file));
			$total= $linefields[3];
			$region= $linefields[0];
			$auth= $linefields[1];
			$lauth= $linefields[2];
			   
			$jsonurl = "http://maps.googleapis.com/maps/api/geocode/json?address=".$lauth.",".$auth.",".$region.",%20United%20Kingdom&sensor=true";
			$json = file_get_contents($jsonurl,0,null,null);
			print_r( $json );
			//$json_output = json_decode($json);

			//foreach ( $json_output->trends as $trend )
			//{
			//	echo "{$trend->name}\n";
			//}  
		
	   }

	 fclose($file);
?>
