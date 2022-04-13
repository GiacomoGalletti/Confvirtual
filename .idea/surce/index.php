<?php
include_once ('logic/Session.php');
Session::start();

if (isset($_GET['page'])){
    $requested_page = $_GET['page'];
}else{
    $requested_page = 'home';
}
echo include ('templates/head.html');
switch ($requested_page) {
    case "login":
        include ("pages/LoginPage.php");
        break;
    case "home":
        echo include ("pages/home.php");
        break;
    case "informazioni":
        include ("pages/Info.php");
        break;
    default:
        echo ('<h1>ERROR 404 not found</h1>');
        break;
}
?>
