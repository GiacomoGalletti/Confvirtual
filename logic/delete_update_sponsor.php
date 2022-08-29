<?php
include_once (sprintf("%s/logic/SponsorQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));

print_r($_POST);
$index = $_POST['sponsor_btn'];
if (isset($_POST['confirm_mod_btn'])) {
    if (isset($_POST['dati_conferenza']) && $_POST['dati_conferenza'] != 'Scegli conferenza' && isset($_POST['importo']) && $_POST['importo'] != '') {
        $data_conference = explode(',',$_POST['dati_conferenza']);
        if (SponsorQueryController::createSponsorization($_POST['importo'],$data_conference[1],$data_conference[0],$_POST['nome'][0]))
        {
            Session::write('msg_sessione', '
                        <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                            Sponsorizzazione inserita con successo.
                        </h4> </div>');

        } else {
            Session::write('msg_sessione', '
                        <div class="container" style="background-color: red;opacity: 50"> <h4>
                            sponsorizzazione già inserita per questo sponsor in questa conferenza.
                        </h4> </div>');

        }
    }else {
        Session::write('msg_sessione', '
                        <div class="container" style="background-color: red;opacity: 50"> <h4>
                            Campi inseriti non validi o mancanti.
                        </h4> </div>');
    }
}

if (isset($_POST['delete_btn']) and isset($_POST['check'])) {

        if (SponsorQueryController::deleteSponsor($_POST['nome'][0]))
        {
            Session::write('msg_sessione', '
                        <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                            Sponsor eliminato.
                        </h4> </div>');

        } else {
            Session::write('msg_sessione', '
                        <div class="container" style="background-color: red;opacity: 50"> <h4>
                            eliminazione sponsor fallita.
                        </h4> </div>');

        }
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: /pages/admin/managesponsor.php');
}

header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/managesponsor.php');
