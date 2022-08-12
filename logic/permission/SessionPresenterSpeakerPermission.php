<?php
ob_start();
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
Session::start();

if(!Session::isSet('userName') || (Session::read('type')!='presenter' AND Session::read('type') != 'speaker')){
    header('Location: /pages/login.php');
    exit();
}