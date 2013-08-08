<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::get('/', function()
{

	// debug
	// return View::make("splashscreen");

	if(Cookie::has("c_donesplash")){
		return Redirect::to("/intro", 200);
	}else{
		Cookie::forever("c_donesplash", "true");
		return View::make("splashscreen");
	}

});

Route::get("/intro", function(){
	return View::make('home.intro');
});


Route::get('/journal', function()
{
	return View::make('home.journal');
});

Route::get('/map', function()
{
	return View::make('home.map');
});

Route::get('/settings', function()
{
	return View::make('home.settings');
});


/////////////////////////////////////////////////////////

Route::post("/ualm/authen", function(){
	return Authen::signin($_POST["email"], $_POST["pass"]);
});

Route::get("/ualm/deauthen", function(){
	Authen::signout();
	return Redirect::to("/", 200);
});


/////////////////////////////////////////////////////////

// EASTER EGGS


Route::get("/jalapeno", function(){
	return View::make('easteregg');
});


////////////////////////////////////////////////////////


Route::get("/demo/iphone.php", function(){
	return View::make("demo.emulator");
});



//////////////////////////

// Settings
Route::post("/ualm/setSetting", function(){

	$usr= Authen::user(); 

		if(isset($_POST["first_name"])){
			$usr->first_name= $_POST["first_name"];
		}
		if(isset($_POST["last_name"])){
			$usr->last_name= $_POST["last_name"];
		}
		if(isset($_POST["password"])){
			$usr->password= $_POST["password"];
		}
		if(isset($_POST["email"])){
			$usr->email= $_POST["email"];
		}
		if(isset($_POST["marker_icon"])){
			$usr->marker_icon= $_POST["marker_icon"];
		}

	$usr->save();

	return ":)";

});


/////////////////////////////////////////////////////

// AJAX

// -- Calc

Route::get("/ajax/calc/name=(:any)/size=(:any)/fuel=(:any)/km=(:num)", function($a, $b, $c, $d){
	///ajax/calc/name=Car/size=Small/fuel=Petrol/km=300
	$obj= Activitymethod::where("Name", "=", $a);
	if($b!="na"){
		$obj= $obj->where("Size", "=", $b);
	}
	if($c!="na"){
		$obj= $obj->where("Fuel", "=", $c);
	}
	$obj= $obj->first();
	$result= "<trash>";
	$result.= $obj->cotg_perkg;
	$result.= " CO2 grams per kilometre  x  ". $d ." kilometres  = ". ($obj->cotg_perkg*$d);
	$result.= " CO2 grams";
	$result.= "</trash>";
	$result.= "\n<result>".($obj->cotg_perkg*$d)."</result>";
	return $result;
	
});




/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});