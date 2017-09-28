<?php 
require_once('view/RegisterView.php');

class registerModel{

    /**
    * Construct call functions
    * Set $message
    */

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

    /**
    * returns length of username
    */

    public function getUsernameLength(){
        $username = (isset($_POST["RegisterView::UserName"]) ? $_POST["RegisterView::UserName"] : null);
		return strlen($username);
    }

    /**
    * returns length of password
    */

    public function getPasswordLength(){
        $password = (isset($_POST["RegisterView::Password"]) ? $_POST["RegisterView::Password"] : null);
		return strlen($password);
    }

    /**
    * returns username
    */

    public function getUsernameRegister(){
        return (isset($_POST["RegisterView::UserName"]) ? $_POST["RegisterView::UserName"] : null);	
    }

    /**
    * returns length of password
    */
    
    private function getPasswordRegister(){
        $password = $_POST["RegisterView::Password"];
		return $password;
    }

    /**
    * returns length of password repeat
    */

    private function getPasswordRepeat(){
        $password = $_POST["RegisterView::PasswordRepeat"];
		return $password;
    }

    /**
    * check if register fails
    * return true or false
    */

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

    /**
    * check if register password fails
    * return true or false
    */

    public function checkPasswordRegister(){
        if(isset($_POST["RegisterView::Register"])){
           if ($this->getUsernameLength() >= 3 && $_POST["RegisterView::Password"] == ""){
                return true;
           } else {
                return false;
           }
        }
    }

    /**
    * check if register username fails
    * return true or false
    */

    public function checkUsernameRegister(){
        if (isset($_POST["RegisterView::Register"])){
            if($this->getUsernameLength() < 3 && $this->getPasswordRegister() == $this->getPasswordRepeat()){
                return true;
            } else {
                return false;
            }
        } 
    }

    /**
    * check password length
    * return true or false
    */

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

    /**
    * check password repeat
    * return true or false
    */

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

    /**
    * check if user exist
    * return true or false
    */

    public function chechIfUserExist(){
        if(isset($_POST["RegisterView::Register"])){
            if ($this->getUsernameRegister() == "Admin"){
                return true;
            } else {
                return false;
            }
        } 
    }

    /**
    * check for html tags
    * return true or false
    */

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