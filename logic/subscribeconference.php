<?php
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
if(isset($_POST['conferencebtn'])) {
    $index = $_POST['conferencebtn'];
    if (ConferenceQueryController::subscribeToConference($_POST['acronimo'][$index],$_POST['annoEdizione'][$index])) {
        try {
            Session::write('msg_subscription', '<div class="container" style="background-color: green;opacity: 50"> <h4>Iscrizione avvenuta con successo.</h4> </div>');
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
    } else {
        try {
            Session::write('msg_subscription', '<div class="container" style="background-color: red;opacity: 50"> <h4>Iscrizione fallita.</h4> </div>');
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
    }
    header('Location: /pages/futureconferences.php');
}