<?php

class loggedInModel{
    public function __construct(&$message){
       // if (isset($_POST['LoginView::Login'])){
        if($this->submitForm()){
            if(!isset($_SESSION["loggedIn"])){
				$message = "Welcome";		
			}	
			if (!$_SESSION["test"]){
                echo "mnm,,2";
                $_SESSION["test"] = "hej";
            }
			unset($_SESSION["loggedOut"]);
			//unset($_SESSION["checkFields"]);
		//}
        } else if($this->loggedIn()){
			 unset($_SESSION["loggedOut"]);
			 if (!$_SESSION["test"]){
                echo "mnm,,2adadada";
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
			echo "joojo";
            return true;
        } else {
            return false;
        }		
}	
    
    
}