<?php
class loggedOutModel{
    public function __construct(&$message){
		if($this->loggOut()){
			if(!isset($_SESSION["loggedOut"])){		
				$message = "Bye bye!";
				$_SESSION["loggedOut"] = "uytre";
			} else {
				$message = "";
			}	
		}
	}

	public function loggOut(){
			unset($_SESSION["username"]);
			unset($_SESSION["password"]);
			unset($_SESSION["loggedIn"]);
			unset($_SESSION["cookiesMessage"]); 
			$_SESSION['usernameValue'] = "";
			unset($_SESSION["usernameValueRegister"]);
			if(isset($_COOKIE["LoginView::CookieName"]) && isset($_COOKIE["LoginView::CookiePassword"])){
				setcookie("LoginView::CookiePassword", hash('ripemd160', 'Password'), time() - 12360, "/");
				setcookie("LoginView::CookieName", "Admin", time() - 12360, "/");
			}
			return true;	
		} 
	//}
}

