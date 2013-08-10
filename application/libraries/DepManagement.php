<?php

class DepManagement{
	public static function getJQuery(){
		echo HTML::script("/vendors/jquery/jquery-2.0.3.min.js");
		echo HTML::script("/vendors/jquery/jquery-ui.js");
		echo HTML::style("/vendors/jquery/jquery-ui.css");
	}
	public static function getJQueryMobile(){
		echo HTML::script("/vendors/jquerymobile/jquery.mobile-1.3.2.min.js");
		echo HTML::style("/vendors/jquerymobile/jquery.mobile-1.3.2.min.css");
		echo HTML::style("/themes/C02D2013.min.css");
	}
	public static function getMapApi(){
		echo HTML::script("/vendors/mapbox/mapbox.js");
		echo HTML::style("/vendors/mapbox/mapbox.css");
		echo HTML::script("/js/maps.js");
		echo HTML::style("/css/maps.css");	
		echo HTML::style("/vendors/mapboxclusters/MarkerCluster.css");
		echo HTML::style("/vendors/mapboxclusters/MarkerCluster.Default.css");
		echo HTML::script("/vendors/mapboxclusters/leaflet.markercluster.js");
	}
	public static function getJS(){
		echo HTML::script("/js/common.js");
	}
	public static function getCoffee(){

	}
	public static function getCSS(){
		echo HTML::style("/vendors/transport/css/transport.css");
		echo HTML::style("/vendors/transport/css/animation.css");
		echo HTML::style("/vendors/iconlib/iconlib.css");
		echo HTML::style("http://fonts.googleapis.com/css?family=Droid+Sans");
	}
}