<?php
class LoggedInModel{

    public function __construct(&$message){
        if($this->submitForm()){
			unset($_SESSION["checkFields"]);
			unset($_SESSION["loggedOut"]);
            if(!isset($_SESSION["loggedIn"]) && isset($_POST['LoginView::KeepMeLoggedIn']) ){
				$this->logInCookie();
				$message = "Welcome and you will be remembered";	
				$_SESSION["loggedIn"] = $message;		
			} else if (!isset($_SESSION["loggedIn"]) && !isset($_POST['LoginView::KeepMeLoggedIn'])){
				$message = "Welcome";
				$_SESSION["loggedIn"] = $message;
			} else {
				$message = "";
			}
        } else if($this->loggedIn()){
			 if (!$_SESSION["loggedIn"]){
				$message = "";
                $_SESSION["loggedIn"] = $message;
			} 
		} else if($this->checkCookie()){
			if (!isset($_SESSION["loggedIn"])){
				$message = "Welcome back with cookie";
				$_SESSION["loggedIn"] = $message;
				$_SESSION["username"] = $_COOKIE["LoginView::CookieName"];
				$_SESSION["password"] = $_COOKIE["LoginView::CookiePassword"];				
			} 
		}	
	}

    private function getUsername() {
		$username = (isset($_POST['LoginView::UserName']) ? $_POST['LoginView::UserName'] : null);
		return $username;
	}

	private function getPassword(){
		$password = $_POST['LoginView::Password'];
		return $password;
	}

    public function submitForm(){
		if(isset($_POST['LoginView::Login'])){
			if($this->getUsername() == "Admin" && $this->getPassword() == "Password"){
				$_SESSION["username"] = $this->getUsername();
				$_SESSION["password"] = $this->getPassword();
				return true;
			} else {
				return false;
			}
		} 
	}
	
	public function loggedIn(){
        if(isset($_SESSION["username"]) && isset($_SESSION["password"]) ){
			return true;
        } else {
            return false;
        }		
	}

	public function logInCookie(){
		if(!isset($_COOKIE["LoginView::CookieName"]) && !isset($_COOKIE["LoginView::CookiePassword"])){
			$cookie_name = "LoginView::CookieName";
			$cookie_value = "Admin";
			$name = "LoginView::CookiePassword";
			$value = hash('ripemd160', 'Password');
			setcookie($name, $value, time() + 12360, "/");
			setcookie($cookie_name, $cookie_value, time() + 12360, "/");
		} 
	}

	public function checkCookie(){
		if (!isset($_SESSION["username"]) && !isset($_SESSION["password"]) 
			&& isset($_COOKIE["LoginView::CookieName"])){
			return true;
		} else {
			return false;
		}
	}
}
