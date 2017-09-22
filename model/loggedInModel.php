<?php

//class loggedInModel{
//     public function __construct(&$message){
//         if($this->submitForm()){
// 			unset($_SESSION["checkFields"]);
// 			unset($_SESSION["loggedOut"]);
//             if(!isset($_SESSION["loggedIn"]) && isset($_POST['LoginView::KeepMeLoggedIn']) ){
// 					$this->logInCookie();
// 					$message = "Welcome and you will be remembered";	
// 					$_SESSION["loggedIn"] = $message;		
// 			}	else if (!isset($_SESSION["loggedIn"]) && !isset($_POST['LoginView::KeepMeLoggedIn'])){
// 				$message = "Welcome";
// 				$_SESSION["loggedIn"] = $message;
// 			}else{
// 				$message = "ab";
// 			} 
// 		} else if($this->checkCookie()){
// 			//unset($_SESSION["loggedIn"]);
// 				echo "aajjaa";
// 				if (!isset($_SESSION["loggedIn"])){
// 					$message = "d";
// 					echo "iiii";
// 					$message = "Welcome back with cookie";
// 					$_SESSION["loggedIn"] = $message;
					
// 				} 
			
			
			
		
// 		} else if($this->loggedIn()){
// 			unset($_SESSION["loggedOut"]);
// 			unset($_SESSION["checkFields"]);
			
				
// 	if (!isset($_SESSION["loggedIn"])){
// 			   $message = "d";
// 			   echo "3";
// 			   $_SESSION["loggedIn"] = $message;
// 		   } 
		  
			   
	
// }
// }
	
	
    // private function getUsername() {
	// 	$username = (isset($_POST['LoginView::UserName']) ? $_POST['LoginView::UserName'] : null);
	// 	return $username;
	// }



	// private function getPassword(){
	// 	$password = $_POST['LoginView::Password'];
	// 	return $password;
	// }

//     public function submitForm(){
// 		if(isset($_POST['LoginView::Login'])){
// 			if($this->getUsername() == "Admin" && $this->getPassword() == "Password"){
// 				$_SESSION["username"] = $this->getUsername();
// 				$_SESSION["password"] = $this->getPassword();
				// if (isset($_POST['LoginView::KeepMeLoggedIn'])){
				// 	$this->logInCookie();
				// }
				//$this->checkCookieAndSession();
// 				return true;
// 			}else{
// 				return false;

// 			}
// 		} 
// 		return false;
//     }


// 	public function loggedIn(){
//         if(isset($_SESSION["username"]) && isset($_SESSION["password"]) && !$_COOKIE["LoginView::CookieName"]){
// 			echo"22";
//             return true;
//         } else {
//             return false;
//         }		
// }

// public function logInCookie(){
	
// 	if(!isset($_COOKIE["LoginView::CookieName"]) && !isset($_COOKIE["LoginView::CookiePassword"])){
// 		$cookie_name = "LoginView::CookieName";
// 		$cookie_value = "Admin";
// 		$name = "LoginView::CookiePassword";
// 		$value = hash('ripemd160', 'Password');
// 		setcookie($name, $value, time() + 12360, "/");
// 		setcookie($cookie_name, $cookie_value, time() + 12360, "/");
// 	} 
// }

// public function checkCookie(){

// 	if (!isset($_SESSION["username"]) && !isset($_SESSION["password"]) && isset($_COOKIE["LoginView::CookieName"])){
// 		//sätta sessionen igen

// 		if($_COOKIE["LoginView::CookieName"] == "Admin" && $_COOKIE["LoginView::CookiePassword"] == hash('ripemd160', 'Password')){

// 			$_SESSION["username"] = $_COOKIE["LoginView::CookieName"];
// 			$_SESSION["password"] = $_COOKIE["LoginView::CookiePassword"];
// 			$_SESSION["loggedIn"] = "he";
// 			echo "shhshhshhs";
			
		
// 		}
		
// 		return true;
// 	}
// }

// public function ea(){
// 	if($this->submitForm() || $this->loggedIn() || $this->checkCookie()){
// 		echo "yoyoy";
// 		var_dump($_SESSION);
// 		return true;
// 	}
// }


// }

class loggedInModel{
	public function __construct(){
		if($this->loggedIn() && isset($_POST['LoginView::KeepMeLoggedIn'])){
			$_SESSION["message"] = "Welcome and you will be remembered";
			$this->logInCookie();
		} else {
			$_SESSION["message"] = "Welcome";
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


	public function loggedIn(){
		if($this->logIn() || $this->checkIfLoggedIn()){
			return true;
		}
		
	}

	public function logIn(){
		
		if(isset($_POST['LoginView::Login'])){
			if($this->getUsername() == "Admin" && $this->getPassword() == "Password"){
				$_SESSION["username"] = $this->getUsername();
				$_SESSION["password"] = $this->getPassword();
			
				return true;
			}
		}
	}

	public function checkIfLoggedIn(){
		if (isset($_SESSION["username"]) && isset($_SESSION["password"])){
			$_SESSION["message"] = "";
			return true;
		}
	}

		//if(isset($_POST['LoginView::KeepMeLoggedIn') kalla på den 

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

	}



    
