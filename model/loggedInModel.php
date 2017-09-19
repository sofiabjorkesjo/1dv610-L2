<?php

class loggedInModel{
    public function __construct(&$message){
        if($this->submitForm()){
            if(!isset($_SESSION["loggedIn"])){
				$message = "Welcome";
				$_SESSION["loggedIn"] = $message;	
			}	
			unset($_SESSION["loggedOut"]);
        } else if($this->loggedIn()){
			unset($_SESSION["loggedOut"]);
			$message = "";
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
            return true;
        } else {
            return false;
        }		
}	
    
    
}