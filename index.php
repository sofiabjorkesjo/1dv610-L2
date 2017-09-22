<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/loggedInModel.php');

//require_once('view/LoginModel.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');



//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();
//$a = new loggedInModel($message);



session_start();




if(isset($_POST['LoginView::Logout'])){
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    unset($_SESSION["loggedIn"]);
    unset($_SESSION["cookiesMessage"]); 
    unset($_SESSION["usernameValue"]);
    setcookie("LoginView::CookieName", "", time() - 12360, "/");
    setcookie("LoginView::CookiePassword", "", time() - 12360, "/");
}


   $lv->render(false, $v, $dtv);








