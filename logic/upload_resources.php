<?php
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
print_r($_POST);
header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/speaker/tutorialresources.php');

$index = $_POST['modificabtn'];
$codice_sessione = $_POST['codicesessione'][$index];
$codice_presentazione = $_POST['codicepresentazione'][$index];

if (isset($_POST['confirm_mod_btn'])) {
    $array_link_descrizione = [];
    for ($i = 0; $i<sizeof($_POST['link']); $i++) {
        $array_link_descrizione [] = $_POST['link'][$i] . '*' . $_POST['descrizione'][$i];
    }
    $array_link_descrizione = array_unique($array_link_descrizione);
    foreach ($array_link_descrizione as $a) {
        $singolo_link_descrizione = explode('*',$a);
        if ($singolo_link_descrizione[0] != '' AND $singolo_link_descrizione[1] != '') {
            if (isset($_POST['sostituisci_risorsa'])) {
                PresentationQueryController::deleteResources($codice_presentazione,$codice_sessione);
                unset($_POST['sostituisci_risorsa']);
            }
            if(!PresentationQueryController::addResources($codice_presentazione,$codice_sessione,$singolo_link_descrizione[0],$singolo_link_descrizione[1])) {
                Session::write('msg_tutorial_resources', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                    Fallito inserimento Risorsa: '.$singolo_link_descrizione[0].' '.$singolo_link_descrizione[1].'
                    </h4> </div>');
            }
        }
    }
}
