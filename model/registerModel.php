<?php 

class registerModel{
    public function __construct(&$message){
        if($this->registerFail()){
            $message = "Username has too few characters, at least 3 characters. <br> Password has too few characters, at least 6 characters.";
        } else if ($this->checkPasswordRegister()){
            $message =  "Password has too few characters, at least 6 characters.";  
        }     
    }

    public function getUsernameLength(){
        $username = (isset($_POST["RegisterView::UserName"]) ? $_POST["RegisterView::UserName"] : null);
		return strlen($username);
    }

    private function getUsernameRegister() {          
        return $_SESSION['usernameValueRegister'] = $_POST['RegisterView::UserName'];
	}

    public function registerFail(){
        if (isset($_POST["RegisterView::Register"])){
            if($_POST["RegisterView::UserName"] == "" && $_POST["RegisterView::Password"] == "" 
                && $_POST["RegisterView::PasswordRepeat"] == ""){
                return true;
            }   
        } else {
            return false;
        }
    }

    public function checkPasswordRegister(){
        if(isset($_POST["RegisterView::Register"])){
           if ($this->getUsernameLength() >= 3 && $_POST["RegisterView::Password"] == ""){
            $this->getUsernameRegister();
               return true;
           } else {
               return false;
           }
        }
    }


}