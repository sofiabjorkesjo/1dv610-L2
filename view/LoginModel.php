<?php

//gör en konstruktor
//lägg in alla regler osv här
//skicka med argument i konstruktorn

//kalla sedan på konstruktorn i loginView, och skapa en new
class LoginModel{

    
    public function __construct($message){
       // echo "aaa model test";
        $message = "";
        if($this->checkPasswordField()){
			$message = "Password is missing";
				
        // } else if($this->checkFields()){
        //     $message = "Username is missing";
        }
        

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
		if(isset($_POST['LoginView::Login'])){
			if($this->getUsername() == "Admin" && $this->getPassword() == ""){
				//$this->getRequestUserName();
				return true;
                
                //FIXA

			// } else if ($this->getUsername() == "a" && $this->getPassword() == "" || $this->getUsername() == "" && $this->getPassword() == "Password"){
            //     return true;
            }
		}
    }
    
    // public function checkFields(){
	// 	if(isset($_POST['LoginView::Login'])){
	// 		if($this->getUsername() == "" && $this->getPassword() == "" || $this->getUsername() == "" && $this->getPassword() == "Password"){
	// 			return true;
	// 		}
	// 	}
	// }
}



