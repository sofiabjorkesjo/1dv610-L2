<?php

//gör en konstruktor
//lägg in alla regler osv här

class checkFieldsModel{

  
    
    public function __construct(&$message){
            if($this->checkFields()){
                $message = "Username is missing";
                if (!isset($_SESSION["checkFields"])){ 
                   // unset($_SESSION["checkFields"]);     
                    $_SESSION["checkFields"] = $message;;
                }
              //  var_dump($_SESSION);
            }
        else if($this->checkPasswordField()){
            //echo "a";
            $message = "Password is missing";
            if (!isset($_SESSION["checkFields"])){  
               // unset($_SESSION["checkFields"]);
                $_SESSION["checkFields"] = $message;;
            }
           // var_dump($_POST);
        
        } else if ($this->checkUsernameAndPassword()){
            $message = "Wrong name or password"; 	
            if (!isset($_SESSION["checkFields"])){  
              //  unset($_SESSION["checkFields"]);  
                $_SESSION["checkFields"] = $message;
            }
          //  var_dump($_SESSION);
       
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
    
    //FIXA
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
    
    
    //FIXA
    public function checkUsernameAndPassword(){
        if (isset($_POST['LoginView::Login'])){
			 if(
            $this->getUsername() == "Admin" && $this->getPassword() !== "Password"||
			    $this->getUsername() !== "Admin" && $this->getPassword() == "Password"){
                $this->getRequestUserName();
				return true;
			}
    }
}
}



