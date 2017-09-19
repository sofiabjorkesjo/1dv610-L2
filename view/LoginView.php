<?php
	require_once('model/checkFieldsModel.php');
	require_once('model/loggedInModel.php');

class LoginView {

	



	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	

	
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */

	


	public function response() {
		$_SESSION['usernameValue'] = "";
		$message = "";
		
		$this->getCheckFieldsModel($message);
		$response = $this->generateLoginFormHTML($message);
		$this->getLoggedinModel($message);
		$response = $this->generateLogoutButtonHTML($message);

	/* 	if($this->submitForm()){
			if(!isset($_SESSION["loggedIn"])){
				$message = "Welcome";
				$_SESSION["loggedIn"] = $message;
				
			}	
			unset($_SESSION["loggedOut"]);
			$response = $this->generateLogoutButtonHTML($message);	
		} else  */
		// if($this->loggedIn()){
		// 	unset($_SESSION["loggedOut"]);
		// 	$response = $this->generateLogoutButtonHTML($message);	
		// }
		// else 
		if(isset($_POST['LoginView::Logout'])) {
			if(!isset($_SESSION["loggedOut"])){
				$message = "Bye bye!";
				$_SESSION["loggedOut"] = $message;	
			} 
			$response = $this->generateLoginFormHTML($message);		
		} else if (!isset($_SESSION["username"]) && !isset($_SESSION["password"]) && isset($_COOKIE["LoginView::CookieName"]) && isset($_COOKIE["LoginView::CookiePassword"])) {
			$message = $_SESSION["cookiesMessage"];
			$response = $this->generateLogoutButtonHTML($message);
		 }
		return $response;	
	}

	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		
		return '
			<form method="post"> 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $_SESSION['usernameValue'] . '" />
					

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	


	public function getCheckFieldsModel(&$message){
		if (isset($_POST['LoginView::Login'])){
			return new checkFieldsModel($message);
		}
	}

	public function getLoggedinModel(&$message){
		if (isset($_POST['LoginView::Login'])){
			return new loggedInModel($message);
		}
	}

	//sätter det rätta användarnamnet och sparar det i en session

	private function setCorrectUsername(){
		$username = $_SESSION["username"] = "Admin";
		return $username;
	}

	//sätter det rätta lösenordet och sparar det i en session

	private function setCorrectPassword(){
		$password = $_SESSION["password"] = "Password";
		return $password;
	}
	
	//hämtar det username som användaren skriver in
	private function getUsername() {
		$username = (isset($_POST[self::$name]) ? $_POST[self::$name] : null);
		return $username;
	}



	private function getPassword(){
		$password = $_POST[self::$password];
		return $password;
	}

	//när man klickar på submit, kollar username och password

	// public function submitForm(){
	// 	if(isset($_POST[self::$login])){
	// 		if($this->getUsername() == "Admin" && $this->getPassword() == "Password"){
	// 			$_SESSION["username"] = $this->getUsername();
	// 			$_SESSION["password"] = $this->getPassword();
	// 			$this->logInCookie();
	// 			return true;
	// 		}else{
	// 			return false;

	// 		}
	// 	} 
	// }

	//inloggad sålänge sessionen finns

	public function loggedIn(){
			if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
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


	}
	

