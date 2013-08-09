<?php
class Authen{
	public static function signedin(){
		if(Cookie::has("c_user")){
				return true;
		}else{
			return false;
		}
	}
	public static function signout(){
		if(Cookie::has("c_user")){
			Cookie::forget("c_user");
			return true;
		}else{
			return false;
		}
	}

	public static function signin($email, $pass){
		if(User::where("email","=", $_POST["email"])->first()){
			$usr= User::where("email","=", $_POST["email"])->first();
			if($usr->password= $_POST["pass"]){
				Cookie::forever("c_user", Crypter::encrypt($_POST["email"].".... ....".$_POST["pass"]));
				return "OK,". $usr->first_name;
			}else{
				return "ddd";
			}
		}else{
			return "dd";
		}
	}



	public static function user(){
		if(Cookie::has("c_user")){
			return User::where("email", "=", "carbondiary@gmail.com")->first();
		}
	}


}