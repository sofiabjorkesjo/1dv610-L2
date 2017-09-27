<?php

class checkFieldsModel{

    public function __construct(&$message){
        if($this->checkFields()){
            $message = "Username is missing";
            if (!isset($_SESSION["checkFields"])){ 
                 $_SESSION["checkFields"] = $message;;
            }
         
        } else if($this->checkPasswordField()){
            $message = "Password is missing";
            if (!isset($_SESSION["checkFields"])){  
                $_SESSION["checkFields"] = $message;;
            }     
        } else if ($this->checkUsernameAndPassword()){
            $message = "Wrong name or password"; 	
            if (!isset($_SESSION["checkFields"])){  
                $_SESSION["checkFields"] = $message;
            }
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
		$password = (isset($_POST['LoginView::Password']) ? $_POST['LoginView::Password'] : null);
		return $password;
    }
    
    public function checkFields(){
        if (isset($_POST['LoginView::Login'])){
            if($this->getUsername() == "" && $this->getPassword() == "" 
            || $this->getUsername() == "" && $this->getPassword() == "Password"){
                return true;       
            }
        }
    }

    public function checkPasswordField() {
        if (isset($_POST['LoginView::Login'])){
            if($this->getUsername() == "Admin" && $this->getPassword() == ""){
                $this->getRequestUserName();
				return true;
		    }
        }
    }
    
    public function checkUsernameAndPassword(){
        if (isset($_POST['LoginView::Login'])){
			if($this->getUsername() == "Admin" && $this->getPassword() !== "Password"||
			$this->getUsername() !== "Admin" && $this->getPassword() == "Password"){
                $this->getRequestUserName();
				return true;
			}
        }
    }   
}



