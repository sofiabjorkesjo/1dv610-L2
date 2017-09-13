<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	public static $usernameValue = '';

	
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = "";
		$response = $this->generateLoginFormHTML($message);

		if($this->submitForm()){
			$message = "Welcome";
			$response = $this->generateLogoutButtonHTML($message);	
		} else if($this->loggedIn()){
			$response = $this->generateLogoutButtonHTML($message);	
		} else if($this->checkFields()){
			$message = "Username is missing";
			$response = $this->generateLoginFormHTML($message);
		} else if($this->checkPasswordField()){
			$message = "Password is missing";
			$response = $this->generateLoginFormHTML($message);	
		} else if($this->checkUsernameAndPassword()){
			$message = "Wrong name or password";
			$response = $this->generateLoginFormHTML($message);	
		} else if(isset($_POST['LoginView::Logout'])) {
			$message = "Bye bye!";
			$response = $this->generateLoginFormHTML($message);	
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
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . self::$usernameValue . '" />
					

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
		
		//echo $_POST[self::$name];
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

	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {	
		$value = $_POST[self::$name];
		return self::$usernameValue = $value;
	}

	private function getPassword(){
		$password = $_POST[self::$password];
		return $password;
	}

	//när man klickar på submit, kollar username och password

	public function submitForm(){
		if(isset($_POST[self::$login])){
			if($this->getUsername() == "Admin" && $this->getPassword() == "Password"){
				//var_dump($_SESSION);
				$_SESSION["username"] = $this->getUsername();
				$_SESSION["password"] = $this->getPassword();
				return true;
			}else{
				return false;

			}
		} 
	}

	//inloggad sålänge sessionen finns

	public function loggedIn(){
			if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
				return true;
			} else {
				return false;
			}		
	}	


	public function checkFields(){
		if(isset($_POST[self::$login])){
			if($this->getUsername() == "" && $this->getPassword() == "" || $this->getUsername() == "" && $this->getPassword() == "Password"){
				return true;
			}
		}
	}


	//Fixa så admin står kvar
	public function checkPasswordField() {
		if(isset($_POST[self::$login])){
			if($this->getUsername() == $this->setCorrectUsername() && $this->getPassword() == ""){
				//$a = $_POST[self::$usernameValue] = $_SESSION['username'];
				//$a = $_GET[self::$test] = $this->getRequestUserName();
				//echo "jajaja";
				$this->getRequestUserName();
				//echo $a;
				return true;
				
			}
		}
	}

	//fixa så admin står kvar
	public function checkUsernameAndPassword(){
		if(isset($_POST[self::$login])){
			if($this->getUsername() == $this->setCorrectUsername() && $this->getPassword() !== $this->setCorrectPassword()||
			$this->getUsername() !== $this->setCorrectUsername() && $this->getPassword() == $this->setCorrectPassword()){
				return true;
			}
		}
	}


	}
	

