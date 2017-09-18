<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

//require_once('view/LoginModel.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();




session_start();

if (!isset($_SESSION["username"]) && !isset($_SESSION["password"]) && isset($_COOKIE["LoginView::CookieName"]) && isset($_COOKIE["LoginView::CookiePassword"])) {    
    $message = "Welcome back with cookie";
    $_SESSION["cookiesMessage"] = $message;
}

if(isset($_POST['LoginView::Logout'])){
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    unset($_SESSION["loggedIn"]);
    unset($_SESSION["cookiesMessage"]); 
}

if($v->submitForm()){
    $lv->render(true, $v, $dtv);
}else if($v->loggedIn()){
    $lv->render(true, $v, $dtv);
} else if(isset($_SESSION["cookiesMessage"]) && isset($_COOKIE["LoginView::CookieName"])){
    $lv->render(true, $v, $dtv);
}else{
    $lv->render(false, $v, $dtv);
}





