<?php
include_once ('../Session.php');
Session::start();
if(!Session::isSet('userName') || Session::read('type')!='presenter'){
    header('Location:../pages/LoginPage.php');
    exit();
}