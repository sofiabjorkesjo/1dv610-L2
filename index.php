<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();


    session_start();
if(isset($_POST['LoginView::Logout'])){
    session_unset();
}


if($v->submitForm()){
    $lv->render(true, $v, $dtv);
}else if($v->loggedIn() == true){
    $lv->render(true, $v, $dtv);
}else{
    $lv->render(false, $v, $dtv);
}

// $lv->render(false, $v, $dtv);

