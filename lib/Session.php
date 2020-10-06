<?php
   class Session{
	 public static function init(){
		if (version_compare(phpversion(), '5.4.0' , '<')) {  //if phpversion is less than 5.4.0 then start the session.
			if (session_id() == '') {
				session_start();
			}
		}else{
			if (session_status() == PHP_SESSION_NONE) { // PHP_SESSION_NONE: if sessions are enabled, but none exists.
				session_start();
			}
		}

	  }

	 public static function set($key,$val){
		   $_SESSION[$key] = $val;
	  }
	 public static function get($key){
		  
		   if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			}else{
				return false;
			}
	  }
	
     public static function checkSession(){
		 if(self::get("login") == false){
			 Session::destroy();
			 header("Location: login.php");
			}
	 }
     public static function checkLogin(){
		 if(self::get("login") == true){
			 header("Location:index.php");
			}
	 }

	  
	  
	 public static function destroy(){
		 session_destroy();
		 session_unset();
		 header("location:index.php");
	 }
   }
?>




 