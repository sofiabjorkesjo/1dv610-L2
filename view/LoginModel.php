<?php

//gör en konstruktor
//lägg in alla regler osv här

class LoginModel{
    public static $usernameValue = '';

    
    public function __construct(&$message){
       
        if($this->checkPasswordField()){
            $message = "Password is missing";		
        } else if($this->checkFields()){
            $message = "Username is missing";
           
        } else if ($this->checkUsernameAndPassword()){
            $message = "Wrong name or password";
           
        }
        

    }

    private function getRequestUserName() {          
		return $_SESSION['usernameValue'] = $_POST['LoginView::UserName'];
	}

    //hämtar det username som användaren skriver in
	private function getUsername() {
		$username = (isset($_POST['LoginView::UserName']) ? $_POST['LoginView::UserName'] : null);
		return $username;
    }
    
    private function getPassword(){
		$password = $_POST['LoginView::Password'];
		return $password;
	}

    public function checkPasswordField() {
			if($this->getUsername() == "Admin" && $this->getPassword() == ""){
                $this->getRequestUserName();
				return true;
		}
    }
    
    public function checkFields(){
		
            if($this->getUsername() == "" && $this->getPassword() == "" || $this->getUsername() == "" && $this->getPassword() == "Password"
            ){
				return true;
            
		}
    }
    
    public function checkUsernameAndPassword(){
			 if($this->getUsername() == "Admin" && $this->getPassword() !== "Password"||
			    $this->getUsername() !== "Admin" && $this->getPassword() == "Password"){
                $this->getRequestUserName();
    
                
			
				return true;
			}
	}
}



