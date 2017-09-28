<?php
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/LoggedInModel.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();
$a = new LoggedInModel($message);

session_start();

if(isset($_POST['LoginView::Logout'])) {
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    unset($_SESSION["loggedIn"]);
}

if($a->submitForm() || $a->checkCookie() || $a->loggedIn()){   
    $lv->render(true, $v, $dtv);
}else {
    $lv->render(false, $v, $dtv);
}

