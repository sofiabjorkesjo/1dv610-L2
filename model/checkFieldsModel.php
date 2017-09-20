<?php

//gör en konstruktor
//lägg in alla regler osv här

class checkFieldsModel{

  
    
    public function __construct(&$message){
        if (isset($_POST['LoginView::Login'])){
        if($this->checkPasswordField()){
            $message = "Password is missing";
            if (!$_SESSION["checkFields"]){
                echo "ja1";
                $_SESSION["checkFields"] = "hej";
            }
            // if($_SESSION["checkFields"]){
            //     echo "ja1";
            //     unset($_SESSION["checkFields"]);
            // }
        } else if($this->checkFields()){
            $message = "Username is missing";
            if (!$_SESSION["checkFields"]){
                echo "ja2";
                $_SESSION["checkFields"] = "hej";
            }
           // $_SESSION["checkFields"] = $message;
        //    if($_SESSION["checkFields"]){
        //     echo "ja2";
        //     unset($_SESSION["checkFields"]);
        // }
       //$_SESSION["checkFields"] = $message;
        } else if ($this->checkUsernameAndPassword()){
            $message = "Wrong name or password22";
            echo "hej";	
            if (!$_SESSION["checkFields"]){
                echo "ja3";
                $_SESSION["checkFields"] = "hej";
            }
            // if($_SESSION["checkFields"]){
            //     echo "ja2";
            //     unset($_SESSION["checkFields"]);
            // } else {
            //     $_SESSION["checkFields"] = "message";
            // }
            
        }
        return true;
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
		$password = isset($_POST['LoginView::Password']);
		return $password;
	}

    public function checkPasswordField() {
			if($this->getUsername() == "Admin" && $this->getPassword() == ""){
                $this->getRequestUserName();
                echo "heh";
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
    
    // public function test(){
    //     if()
    // }
}



