<?php 
require_once('view/RegisterView.php');
class registerModel{

    
    public function __construct(&$message){
        $registerView = new RegisterView();
        if($this->registerFail()){
            $message = "Username has too few characters, at least 3 characters. <br> Password has too few characters, at least 6 characters.";
        } else if ($this->checkPasswordRegister()){
            $message =  "Password has too few characters, at least 6 characters.";  
        } else if ($this->checkUsernameRegister()){
            $registerView->setValue();
            $message = "Username has too few characters, at least 3 characters.";
        } else if ($this->checkPasswordLength()){
            $registerView->setValue();
            $message = "Password has too few characters, at least 6 characters.";
        } else if($this->checkPasswordRepeat()){
            $registerView->setValue();
            $message = "Passwords do not match.";
        } else if($this->chechIfUserExist()){
            $registerView->setValue();
            $message = "User exists, pick another username.";
        } else if($this->checkForTags()){
            $registerView->setValue();
            $message = "Username contains invalid characters.";
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

    public function getUsernameRegister(){
        return (isset($_POST["RegisterView::UserName"]) ? $_POST["RegisterView::UserName"] : null);
		
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
            }  else {
                return false;
            } 
        } 
    }

    public function checkPasswordRegister(){
        if(isset($_POST["RegisterView::Register"])){
           if ($this->getUsernameLength() >= 3 && $_POST["RegisterView::Password"] == ""){
                return true;
           } else {
                return false;
           }
        }
    }

    public function checkUsernameRegister(){
        if (isset($_POST["RegisterView::Register"])){
            if($this->getUsernameLength() < 3 && $this->getPasswordRegister() == $this->getPasswordRepeat()){
                return true;
            } else {
                return false;
            }
        } 
    }

    public function checkPasswordLength(){
        if (isset($_POST["RegisterView::Register"])){
            if ($this->getUsernameLength() >= 3 && $this->getPasswordLength() <= 6 
            && $this->getPasswordRegister() == $this->getPasswordRepeat()){
                return true;
                } else {
                    return false;
        } 
        }
    }

    public function checkPasswordRepeat(){
        if(isset($_POST["RegisterView::Register"])){
            if($this->getUsernameLength() >=3 && $this->getPasswordLength() >= 6 &&
                $this->getPasswordRegister() != $this->getPasswordRepeat()){
                    return true;
                } else {
                    return false;
                }
        } 
    }

    public function chechIfUserExist(){
        if(isset($_POST["RegisterView::Register"])){
            if ($this->getUsernameRegister() == "Admin"){
                return true;
            } else {
                return false;
            }
        } 
    }

    public function checkForTags(){
        if(isset($_POST["RegisterView::Register"])){
            if($this->getUsernameRegister() != strip_tags($this->getUsernameRegister())){
                return true;
            } else {
                return false;
            }
        } 
    }


}