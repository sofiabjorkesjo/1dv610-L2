<?php

class checkFieldsModel{

    /**
    * Construct call functions
    * Set $message
    */

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

    /**
    * Set value from 'LoginView::UserName' to session
	* Return session
	*/

    private function getRequestUserName() {          
		return $_SESSION['usernameValue'] = $_POST['LoginView::UserName'];
	}

    /**
	* Return value from 'LoginView::UserName'
    */
    
	private function getUsername() {
		$username = (isset($_POST['LoginView::UserName']) ? $_POST['LoginView::UserName'] : null);
		return $username;
    }

    /**
	* Return value from 'LoginView::Password'
    */
    
    private function getPassword(){
		$password = (isset($_POST['LoginView::Password']) ? $_POST['LoginView::Password'] : null);
		return $password;
    }

    /**
    * Check fields when log in
    * return true or false
    */
    
    public function checkFields(){
        if (isset($_POST['LoginView::Login'])){
            if($this->getUsername() == "" && $this->getPassword() == "" 
            || $this->getUsername() == "" && $this->getPassword() == "Password"){
                return true;       
            } else {
                return false;
            }
        }
    }

    /**
    * Check if Password field is empty
    * return true or false
    */

    public function checkPasswordField() {
        if (isset($_POST['LoginView::Login'])){
            if($this->getUsername() == "Admin" && $this->getPassword() == ""){
                $this->getRequestUserName();
				return true;
		    }
        }
    }

    /**
    * Check if value in username and password fields are right
    * return true or false
    */
    
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



