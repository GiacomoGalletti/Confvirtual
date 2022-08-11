<?php
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
print_r($_POST);
header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/authorkeywords.php');

$index = $_POST['article_tutorial_btn'];
$codice_sessione = $_POST['codice_sessione'][$_POST['presentationbtn']];
$codice_presentazione = $_POST['codice_presentazione'][$index];

if (isset($_POST['auth_keywords_btn'])) {
    $array_nome_cognome = [];
    for ($i = 0; $i<sizeof($_POST['nome']); $i++) {
        $array_nome_cognome [] = $_POST['nome'][$i] . '*' . $_POST['cognome'][$i];
    }
    $array_nome_cognome = array_unique($array_nome_cognome);
    foreach ($array_nome_cognome as $a) {
        $singolo_nome_cognome = explode('*',$a);
        if ($singolo_nome_cognome[0] != '' AND $singolo_nome_cognome[1] != '') {
            if (isset($_POST['sostituisci_autori'])) {
                PresentationQueryController::deleteAuthors($codice_presentazione,$codice_sessione);
                unset($_POST['sostituisci_autori']);
            }
            if(!PresentationQueryController::addAuthor($codice_presentazione,$codice_sessione,$singolo_nome_cognome[0],$singolo_nome_cognome[1])) {
                Session::write('msg_presentazione_1', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                    Fallito inserimento Autore: '.$singolo_nome_cognome[0].' '.$singolo_nome_cognome[1].'
                    </h4> </div>');
            }
        }
    }


    $array_paroleChiave = explode(',',$_POST['paroleChiave']);

    foreach ($array_paroleChiave as $a) {
        if ($a != '') {
            if (isset($_POST['sostituisci_parolechiave'])) {
                PresentationQueryController::deleteKeyWords($codice_presentazione,$codice_sessione);
                unset($_POST['sostituisci_parolechiave']);
            }
            if(!PresentationQueryController::addKeyWord($codice_presentazione,$codice_sessione,$a)) {
                Session::write('msg_presentazione_2', '<div class="container" style="background-color: red;opacity: 50"> <h4>Fallito inserimento Parola Chiave: '.$a.'</h4> </div>');
            }
        }
    }

}
