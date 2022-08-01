<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ChatQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
if (isset($_POST['submit']) AND $_POST['messaggio'] != '') {
    if(ChatQueryController::sendMessage($_POST['chatbtn'],Session::read('userName'),$_POST['messaggio'],date('Y-m-d'))) {
        Session::write('server_message','<p style="background-color: lime; max-width: 25%"> invio messaggio riuscito</p>');

    } else {
        Session::write('server_message','<p style="background-color: red; max-width: 25%"> errore invio messaggio </p>');
    }
    unset($_POST['submit']);
}

header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/chat.php');