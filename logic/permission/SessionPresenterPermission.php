<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
Session::start();
if(!Session::isSet('userName') || Session::read('type')!='presenter'){
    header('Location: /pages/login.php');
    exit();
}