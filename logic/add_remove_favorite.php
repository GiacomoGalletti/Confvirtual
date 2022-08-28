<?php
print_r($_POST);
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/debug.php", $_SERVER["DOCUMENT_ROOT"]));
if(isset($_POST["fav_btn_remove"])) {
    $sessione_presentazione = explode(',',$_POST["fav_btn_remove"]);
    $codice_sessione = $_POST["codice_sessione"][$sessione_presentazione[0]];
    $codice_presentazione = $_POST["codice_presentazione"][$sessione_presentazione[1]];
    if (PresentationQueryController::removeFavorite(Session::read('userName'),$codice_sessione,$codice_presentazione)) {
        try {
            Session::write('msg_fav', '
                            <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                                rimosso dai preferiti.
                            </h4> </div>');
        } catch (Exception $e) {
            echo $e;
        }
    } else {
        try {
            Session::write('msg_fav', '<div class="container" style="background-color: red;opacity: 50"> <h4>rimozione preferiti fallita.</h4> </div>');
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
    }
}

if(isset($_POST["fav_btn_add"])) {
    $sessione_presentazione = explode(',',$_POST["fav_btn_add"]);
    $codice_sessione = $_POST["codice_sessione"][$sessione_presentazione[0]];
    $codice_presentazione = $_POST["codice_presentazione"][$sessione_presentazione[1]];
    if (PresentationQueryController::addFavorite(Session::read('userName'),$codice_sessione,$codice_presentazione)) {
        try {
            Session::write('msg_fav', '
                            <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                                aggiunto ai preferiti.
                            </h4> </div>');
        } catch (Exception $e) {
            echo $e;
        }
    } else {
        try {
            Session::write('msg_fav', '<div class="container" style="background-color: red;opacity: 50"> <h4>aggiunta ai preferiti fallita.</h4> </div>');
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
    }
}
header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/conferenceinfo.php');
