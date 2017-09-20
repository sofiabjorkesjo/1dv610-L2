<?php

class loggedInModel{
    public function __construct(&$message){
       // if (isset($_POST['LoginView::Login'])){
        if($this->submitForm()){
			unset($_SESSION["checkFields"]);
			unset($_SESSION["a"]);
            if(!$_SESSION["loggedIn"]){
				echo "jo  ";
				$message = "Welcome";		
			}	else {
				echo "m";
			}
			var_dump($_SESSION);
			if (!$_SESSION["test"]){
                $_SESSION["test"] = "hej";
            }
			unset($_SESSION["loggedOut"]);
			//unset($_SESSION["checkFields"]);
		//}
        } else if($this->loggedIn()){
			 unset($_SESSION["loggedOut"]);
			 unset($_SESSION["checkFields"]);
			 if (!$_SESSION["test"]){
                $_SESSION["test"] = "hej";
            }
			// //unset($_SESSION["checkFields"]);
			// echo "jjjj ";
			// $message = "";
			// if($_SESSION["loggedInSession"]){
            //     echo "ja2";
            //     unset($_SESSION["loggedInSession"]);
            // }
       
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
				//$this->logInCookie();
				return true;
			}else{
				return false;

			}
		} 
    }


	public function loggedIn(){
        if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
			echo "loggedIn!";
            return true;
        } else {
            return false;
        }		
}	
    
    
}