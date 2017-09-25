<?php 

class registerModel{
    public function __construct(&$message){
        if($this->registerFail()){
            $message = "Username has too few characters, at least 3 characters. <br> Password has too few characters, at least 6 characters.";
        } else if ($this->checkPasswordRegister()){
            $message =  "Password has too few characters, at least 6 characters.";  
        } else if ($this->checkUsernameRegister()){
            $message = "Username has too few characters, at least 3 characters.";
        } else if ($this->checkPasswordLength()){
            $message = "Password has too few characters, at least 6 characters.";
        } else if($this->checkPasswordRepeat()){
            $message = "Passwords do not match.";
        }
    }

    public function getUsernameLength(){
        $username = (isset($_POST["RegisterView::UserName"]) ? $_POST["RegisterView::UserName"] : null);
		return strlen($username);
    }

    public function getPasswordLength(){
        $password = (isset($_POST["RegisterView::Password"]) ? $_POST["RegisterView::Password"] : null);
		return strlen($password);
    }

    private function getUsernameRegister() {          
        return $_SESSION['usernameValueRegister'] = $_POST['RegisterView::UserName'];
    }
    
    private function getPasswordRegister(){
        $password = $_POST["RegisterView::Password"];
		return $password;
    }

    private function getPasswordRepeat(){
        $password = $_POST["RegisterView::PasswordRepeat"];
		return $password;
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

    public function checkUsernameRegister(){
        if (isset($_POST["RegisterView::Register"])){
            if($this->getUsernameLength() < 3 && $this->getPasswordRegister() ==
            $this->getPasswordRepeat()){
                    $this->getUsernameRegister();
                    return true;
                } 
        } else {
            return false;
        }
    }

    public function checkPasswordLength(){
        if (isset($_POST["RegisterView::Register"])){
            if ($this->getUsernameLength() >= 3 && $this->getPasswordLength() <= 6 
                && $this->getPasswordRegister() == $this->getPasswordRepeat()){
                    $this->getUsernameRegister();
                    return true;
                }
        } else {
            return false;
        }
    }

    public function checkPasswordRepeat(){
        if(isset($_POST["RegisterView::Register"])){
            if($this->getUsernameLength() >=3 && $this->getPasswordLength() >= 6 &&
                $this->getPasswordRegister() != $this->getPasswordRepeat()){
                    $this->getUsernameRegister();
                    return true;
                }
        } else {
            return false;
        }
    }


}