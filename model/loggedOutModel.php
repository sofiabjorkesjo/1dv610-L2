<?php

class loggedOutModel{
    public function __construct(&$message){
		if(isset($_POST['LoginView::Logout'])) {
			if(!isset($_SESSION["loggedOut"])){
				$message = "Bye bye!";
				$_SESSION["loggedOut"] = $message;	
			} else {
				$message = "";
			}		
        }
}
}