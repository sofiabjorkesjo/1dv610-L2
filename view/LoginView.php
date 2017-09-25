<?php
	require_once('model/checkFieldsModel.php');
	require_once('model/loggedInModel.php');
	require_once('model/loggedOutModel.php');
	require_once('view/RegisterView.php');
	require_once('model/registerModel.php');
class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $link = 'LoginView::Link';
	public static $linkName = 'Register a new user';
	
	
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	
	public function response() {
		$_SESSION['usernameValue'] = "";
		$_SESSION['usernameValueRegister'] = "";
		$message = "";
		$response = $this->generateLoginFormHTML($message);
		new checkFieldsModel($message);
		new loggedInModel($message);
		new loggedOutModel($message);
		$registerView = new RegisterView();
		
		 if (isset($_SESSION["checkFields"])){
			$response = $this->generateLoginFormHTML($message);
		}  
		
		if (isset($_SESSION["loggedIn"])){
			$response = $this->generateLogoutButtonHTML($message);
		} 
		if (isset($_SESSION["loggedOut"])){
			$response = $this->generateLoginFormHTML($message);
		}

		
	
		if(isset($_GET['register'])){
			$message = "";
			$response = $registerView->generateRegisterForm($message);
			if (new registerModel($message)){
				$response = $registerView->generateRegisterForm($message);
			}
			
		} 
		

		//$RegisterModel = new RegisterModel($message);
		//$RegisterModel->register();
		return $response;	
	}

	public function showLink(){
		if (!isset($_SESSION["username"])){
		if (isset($_GET['register'])){
			$registerView = new RegisterView();
			return $registerView->showLinkBack();			
		} else {	
		return $this->showLinkRegister();
	}
}
}

public function showLinkRegister()
{
	return '
	<a href="?register">' . self::$linkName . '</a>
	';
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



	}