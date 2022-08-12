<?php
ob_start();
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
Session::start();
if(!Session::isSet('userName') AND !Session::isSet('type')){
    header('Location: /pages/login.php');
    exit();
}