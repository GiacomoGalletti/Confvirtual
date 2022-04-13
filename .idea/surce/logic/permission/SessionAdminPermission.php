<?php
include_once ('../Session.php');
Session::start();
if(!Session::isSet('userName') || Session::read('type')!='amministratore'){
header('Location:../pages/LoginPage.php');
exit();
}
