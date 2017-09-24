<?php 

class registerModel{
    public function __construct(&$message){
        if($this->registerFail()){
            $message = "Username has too few characters, at least 3 characters. Password has too few characters, at least 6 characters.";
        }
        
    }

    public function registerFail(){
        if (isset($_POST["DoRegistration"])){
            if($_POST["RegisterView::UserName"] == "" && $_POST["RegisterView::Password"] == "" && $_POST["RegisterView::PasswordRepeat"] == ""){
                return true;
            }   
        } else {
            return false;
        }
    }

    


}